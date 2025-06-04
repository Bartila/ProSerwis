<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CycleSyncHubController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $bikesQuery = Bike::query();

        if ($q) {
            $bikesQuery->where('name', 'like', "%{$q}%");
        }

        $bikes = $bikesQuery->with('user')->get();

        return view('bikes.index', compact('bikes', 'q'));
    }

    public function create()
    {
        return view('bikes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'components'  => 'nullable|string|max:255',
            'weight'      => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'phone'       => ['required', 'regex:/^\+48\d{9}$/'],
            'status'      => 'required|string|max:30',
            'deadline'    => 'nullable|date',
        ]);

        $bike = Bike::create([
            'name'        => $request->name,
            'type'        => $request->type,
            'user_id'     => Auth::id(),
            'components'  => $request->components,
            'weight'      => $request->weight,
            'description' => $request->description,
            'phone'       => $request->phone,
            'status'      => $request->status,
            'deadline'    => $request->deadline,
        ]);

        // Logowanie operacji
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
            'components'  => 'nullable|string|max:255',
            'weight'      => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'phone'       => ['required', 'regex:/^\+48\d{9}$/'],
            'status'      => 'required|string|max:30',
            'deadline'    => 'nullable|date',
        ]);

        $bike->update([
            'name'        => $request->name,
            'type'        => $request->type,
            'components'  => $request->components,
            'weight'      => $request->weight,
            'description' => $request->description,
            'phone'       => $request->phone,
            'status'      => $request->status,
            'deadline'    => $request->deadline,
        ]);

        // Logowanie operacji
        log_activity('edit', 'Bike', $bike->id, 'Edytowano rower: ' . $bike->name);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower zaktualizowany!');
    }

    public function complete($id)
    {
        $bike = Bike::findOrFail($id);
        $bike->update(['status' => 'gotowy']);

        // Logowanie operacji
        log_activity('status_change', 'Bike', $id, 'Oznaczono rower jako gotowy');

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower oznaczony jako gotowy!');
    }

    public function markAsCollected($id)
    {
        $bike = Bike::findOrFail($id);
        $bike->update(['status' => 'odebrany']);

        // Logowanie operacji
        log_activity('status_change', 'Bike', $id, 'Oznaczono rower jako odebrany');

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower oznaczony jako odebrany!');
    }

    public function destroy($id)
    {
        $bike = Bike::findOrFail($id);

        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'owner') {
            abort(403, 'Brak dostępu do usuwania roweru');
        }

        $bike->delete();

        // Logowanie operacji
        log_activity('delete', 'Bike', $id, 'Usunięto rower: ' . $bike->name);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower usunięty!');
    }

    //  Usuwanie wszystkich odebranych rowerów
    public function destroyCollected()
    {
        $user = Auth::user();

        if ($user->role !== 'owner') {
            abort(403, 'Tylko właściciel może usunąć rowery odebrane.');
        }

        $deleted = Bike::where('status', 'odebrany')->delete();

        // Logowanie operacji
        log_activity('delete_many', 'Bike', null, "Usunięto $deleted rower(ów) o statusie 'odebrany'");

        return redirect()->route('owner.panel')->with('success', "$deleted rower(ów) odebranych usunięto.");
    }
}
