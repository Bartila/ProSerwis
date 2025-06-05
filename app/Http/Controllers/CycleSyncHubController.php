<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Kontroler obsługujący zarządzanie rowerami w CycleSyncHub.
 */
class CycleSyncHubController extends Controller
{
    /**
     * Wyświetla listę rowerów, z opcją filtrowania po nazwie i sortowaniem po dacie przyjęcia.
     */
    public function index(Request $request)
    {
        $q = $request->input('q');

        $bikesQuery = Bike::query();

        if ($q) {
            $bikesQuery->where('name', 'like', "%{$q}%");
        }

        $bikes = $bikesQuery->with('user')->orderBy('deadline', 'asc')->get();

        return view('bikes.index', compact('bikes', 'q'));
    }

    /**
     * Obsługuje dodawanie nowego roweru.
     */
    public function store(Request $request)
    {
        // Walidacja danych z formularza
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'components'  => 'nullable|string|max:255',
            'info'        => 'nullable|string|max:100',
            'weight'      => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'phone'       => ['required', 'regex:/^\+48\d{9}$/'],
            'status'      => 'required|string|max:30',
            'deadline'    => 'nullable|date',
        ]);

        // Tworzenie nowego rekordu Bike w bazie
        $bike = Bike::create([
            'name'        => $request->name,
            'type'        => $request->type,
            'user_id'     => Auth::id(),
            'components'  => $request->components,
            'info'        => $request->info,
            'weight'      => $request->weight,
            'description' => $request->description,
            'phone'       => $request->phone,
            'status'      => $request->status,
            'deadline'    => $request->deadline,
        ]);

        // Zapis aktywności w logach (funkcja pomocnicza)
        log_activity('add', 'Bike', $bike->id, 'Dodano rower: ' . $bike->name);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower dodany!');
    }

    /**
     * Wyświetla szczegóły wybranego roweru.
     */
    public function show($id)
    {
        $bike = Bike::findOrFail($id);
        return view('bikes.show', compact('bike'));
    }

    /**
     * Wyświetla formularz edycji roweru.
     */
    public function edit($id)
    {
        $bike = Bike::findOrFail($id);
        return view('bikes.edit', compact('bike'));
    }

    /**
     * Aktualizuje dane wybranego roweru.
     */
    public function update(Request $request, $id)
    {
        $bike = Bike::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'components'  => 'nullable|string|max:255',
            'info'        => 'nullable|string|max:100',
            'weight'      => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'phone'       => ['required', 'regex:/^\+48\d{9}$/'],
            'status'      => 'required|string|max:30',
            'deadline'    => 'nullable|date',
        ]);

        // Aktualizacja danych roweru
        $bike->update([
            'name'        => $request->name,
            'type'        => $request->type,
            'components'  => $request->components,
            'info'        => $request->info,
            'weight'      => $request->weight,
            'description' => $request->description,
            'phone'       => $request->phone,
            'status'      => $request->status,
            'deadline'    => $request->deadline,
        ]);

        // Zapis aktywności w logach
        log_activity('edit', 'Bike', $bike->id, 'Edytowano rower: ' . $bike->name);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower zaktualizowany!');
    }

    /**
     * Oznacza rower jako gotowy do odbioru (zmiana statusu).
     */
    public function complete($id)
    {
        $bike = Bike::findOrFail($id);
        $bike->update(['status' => 'gotowy']);

        log_activity('status_change', 'Bike', $id, 'Oznaczono rower jako gotowy');

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower oznaczony jako gotowy!');
    }

    /**
     * Oznacza rower jako odebrany przez właściciela (zmiana statusu).
     */
    public function markAsCollected($id)
    {
        $bike = Bike::findOrFail($id);
        $bike->update(['status' => 'odebrany']);

        log_activity('status_change', 'Bike', $id, 'Oznaczono rower jako odebrany');

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower oznaczony jako odebrany!');
    }

    /**
     * Usuwa wybrany rower z bazy, tylko dla admina lub ownera.
     */
    public function destroy($id)
    {
        $bike = Bike::findOrFail($id);

        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'owner') {
            abort(403, 'Brak dostępu do usuwania roweru');
        }

        $bike->delete();

        log_activity('delete', 'Bike', $id, 'Usunięto rower: ' . $bike->name);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower usunięty!');
    }

    /**
     * Usuwa wszystkie rowery o statusie 'odebrany'.
     * Tylko właściciel (owner) ma do tego dostęp.
     */
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
}
