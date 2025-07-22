<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\SmsService;
use App\Models\BikeStat;

class CycleSyncHubController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $bikesQuery = Bike::query();

        if ($q) {
            $bikesQuery->where('name', 'like', "%{$q}%");
        }

        $bikes = $bikesQuery->with('user')->orderBy('deadline', 'asc')->paginate(10);

        return view('bikes.index', compact('bikes', 'q'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'info'        => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'phone'       => ['required', 'regex:/^\d{9}$/'],
            'status'      => 'required|string|max:30',
            'deadline'    => 'nullable|date',
            'qr_code'     => 'nullable|string|unique:bikes,qr_code',
        ]);

        $phone = '+48' . preg_replace('/\D/', '', $request->phone);

        $bike = Bike::create([
            'name'        => $request->name,
            'type'        => $request->type,
            'user_id'     => Auth::id(),
            'info'        => $request->info,
            'description' => $request->description,
            'phone'       => $phone,
            'status'      => $request->status,
            'deadline'    => $request->deadline,
            'qr_code'     => $request->input('qr_code'),
        ]);

        BikeStat::first()->increment('total_added');

        log_activity('add', 'Bike', $bike->id, 'Dodano rower: ' . $bike->name);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower dodany!');
    }

    public function show($id)
    {
        $bike = Bike::findOrFail($id);
        return view('bikes.show', compact('bike'));
    }

    public function edit($id)
    {
        $bike = Bike::findOrFail($id);
        return view('bikes.edit', compact('bike'));
    }

    public function update(Request $request, $id)
    {
        $bike = Bike::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'info'        => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'phone'       => ['required', 'regex:/^\d{9}$/'],
            'status'      => 'required|string|max:30',
            'deadline'    => 'nullable|date',
            'qr_code'     => 'nullable|string|unique:bikes,qr_code,' . $bike->id,
        ]);

        $phone = '+48' . preg_replace('/\D/', '', $request->phone);

        $bike->update([
            'name'        => $request->name,
            'type'        => $request->type,
            'info'        => $request->info,
            'description' => $request->description,
            'phone'       => $phone,
            'status'      => $request->status,
            'deadline'    => $request->deadline,
            'qr_code'     => $request->input('qr_code'),
        ]);

        log_activity('edit', 'Bike', $bike->id, 'Edytowano rower: ' . $bike->name);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower zaktualizowany!');
    }

    public function complete($id)
    {
        $bike = Bike::findOrFail($id);
        $bike->update(['status' => 'gotowy']);

        log_activity('status_change', 'Bike', $id, 'Oznaczono rower jako gotowy');

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower oznaczony jako gotowy! Możesz teraz wysłać SMS.');
    }

    public function sendSms($id)
    {
        $bike = Bike::findOrFail($id);

        if ($bike->status !== 'gotowy') {
            return redirect()->back()->with('error', 'SMS można wysłać tylko gdy rower jest oznaczony jako gotowy.');
        }

        $userPhone = $bike->phone;
        $smsMessage = "Twój rower \"{$bike->name}\" jest gotowy do odbioru. Dziękujemy – Salon Rowerowy Piątek.";

        try {
            (new SmsService())->send($userPhone, $smsMessage);
            log_activity('sms_sent', 'Bike', $bike->id, 'Wysłano SMS do klienta.');
            return redirect()->back()->with('success', 'SMS został wysłany!');
        } catch (\Exception $e) {
            logger()->error('Błąd wysyłki SMS: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Nie udało się wysłać SMS-a.');
        }
    }

    public function markAsCollected($id)
    {
        $bike = Bike::findOrFail($id);
        $bike->update(['status' => 'odebrany']);

        log_activity('status_change', 'Bike', $id, 'Oznaczono rower jako odebrany');

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower oznaczony jako odebrany!');
    }

    public function destroy($id)
    {
        $bike = Bike::findOrFail($id);

        $user = Auth::user();
        if (!in_array($user->role, ['admin', 'owner'])) {
            abort(403, 'Brak dostępu do usuwania roweru');
        }

        $bike->delete();

        log_activity('delete', 'Bike', $id, 'Usunięto rower: ' . $bike->name);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower usunięty!');
    }

    public function destroyCollected()
    {
        $user = Auth::user();

        if ($user->role !== 'owner') {
            abort(403, 'Tylko właściciel może usunąć rowery odebrane.');
        }

        $deleted = Bike::where('status', 'odebrany')->delete();

        log_activity('delete_many', 'Bike', null, "Usunięto $deleted rower(ów) o statusie 'odebrany'");

        return redirect()->route('owner.panel')->with('success', "$deleted rower(ów) odebranych usunięto.");
    }

    public function findByQr(Request $request)
    {
        $code = $request->input('code');
        $bike = Bike::where('qr_code', $code)->firstOrFail();

        return redirect()->route('cyclesynchub.show', $bike->id);
    }

    public function ajaxMarkReady($id)
    {
        $bike = Bike::findOrFail($id);
        $bike->update(['status' => 'gotowy']);

        log_activity('status_change', 'Bike', $id, 'Oznaczono rower jako gotowy');

        return response()->json([
            'success' => true,
            'message' => 'Rower oznaczony jako gotowy!',
            'id' => $id
        ]);
    }
}
