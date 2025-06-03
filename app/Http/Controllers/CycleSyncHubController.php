<?php

namespace App\Http\Controllers;


use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CycleSyncHubController extends Controller
{
    // Wyświetlanie listy rowerów z opcją wyszukiwania
    public function index(Request $request)
    {
        $q = $request->input('q');

        $bikesQuery = Bike::query();

        if ($q) {
            $bikesQuery->where('name', 'like', "%{$q}%");
        }

        // Załaduj relację 'user' dla każdego roweru
        $bikes = $bikesQuery->with('user')->get();

        return view('bikes.index', compact('bikes', 'q'));
    }

    // Formularz dodawania roweru
    public function create()
    {
        return view('bikes.create');
    }

    // Dodawanie nowego roweru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'components'  => 'nullable|string|max:255',
            'weight'      => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'status'      => 'required|string|max:30',
            'deadline'    => 'nullable|date',
        ]);

        Bike::create([
            'name'        => $request->name,
            'type'        => $request->type,
            'user_id'     => Auth::id(),
            'components'  => $request->components,
            'weight'      => $request->weight,
            'description' => $request->description,
            'status'      => $request->status,
            'deadline'    => $request->deadline,
        ]);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower dodany!');
    }

    // Szczegóły roweru – widoczne dla każdego zalogowanego
    public function show($id)
    {
        /** @var \App\Models\Bike $bike */
        $bike = Bike::findOrFail($id);
        return view('bikes.show', compact('bike'));
    }

    // Formularz edycji roweru – dostępny dla każdego zalogowanego
    public function edit($id)
    {
        /** @var \App\Models\Bike $bike */
        $bike = Bike::findOrFail($id);
        return view('bikes.edit', compact('bike'));
    }

    // Aktualizacja roweru – dostępna dla każdego zalogowanego
    public function update(Request $request, $id)
    {
        /** @var \App\Models\Bike $bike */
        $bike = Bike::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'components'  => 'nullable|string|max:255',
            'weight'      => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'status'      => 'required|string|max:30',
            'deadline'    => 'nullable|date',
        ]);

        $bike->update([
            'name'        => $request->name,
            'type'        => $request->type,
            'components'  => $request->components,
            'weight'      => $request->weight,
            'description' => $request->description,
            'status'      => $request->status,
            'deadline'    => $request->deadline,
        ]);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower zaktualizowany!');
    }

    // Oznacz rower jako "gotowy" – dostępne dla każdego
    public function complete($id)
    {
        /** @var \App\Models\Bike $bike */
        $bike = Bike::findOrFail($id);
        $bike->update(['status' => 'gotowy']);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower oznaczony jako gotowy!');
    }

    // Oznacz rower jako "odebrany" – dostępne dla każdego
    public function markAsCollected($id)
    {
        /** @var \App\Models\Bike $bike */
        $bike = Bike::findOrFail($id);
        $bike->update(['status' => 'odebrany']);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower oznaczony jako odebrany!');
    }

    // Usuwanie roweru – tylko dla admina lub ownera
    public function destroy($id)
    {
        /** @var \App\Models\Bike $bike */
        $bike = Bike::findOrFail($id);

        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'owner') {
            abort(403, 'Brak dostępu do usuwania roweru');
        }

        $bike->delete();

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower usunięty!');
    }


}
