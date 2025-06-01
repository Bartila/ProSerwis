<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CycleSyncHubController extends Controller
{
    // Wyświetlanie listy rowerów z wyszukiwaniem
    public function index(Request $request)
    {
        $user = Auth::user();
        $q = $request->input('q');

        $bikesQuery = Bike::query();
        if ($user->role !== 'admin' && $user->role !== 'owner') {
            $bikesQuery->where('user_id', $user->id);
        }
        if ($q) {
            $bikesQuery->where('name', 'like', "%{$q}%");
        }
        $bikes = $bikesQuery->get();

        return view('bikes.index', compact('bikes', 'q'));
    }

    // Formularz dodawania roweru (opcjonalnie – jeśli chcesz osobny widok)
    public function create()
    {
        return view('bikes.create');
    }

    // Dodanie nowego roweru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'components'  => 'nullable|string|max:255',
            'weight'      => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        Bike::create([
            'name'        => $request->name,
            'type'        => $request->type,
            'user_id'     => Auth::id(),
            'components'  => $request->components,
            'weight'      => $request->weight,
            'description' => $request->description,
        ]);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower dodany!');
    }

    // Szczegóły roweru
    public function show($id)
    {
        $bike = Bike::findOrFail($id);

        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'owner' && $bike->user_id !== $user->id) {
            abort(403, 'Brak dostępu do tego roweru');
        }

        return view('bikes.show', compact('bike'));
    }

    // Formularz edycji roweru
    public function edit($id)
    {
        $bike = Bike::findOrFail($id);

        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'owner' && $bike->user_id !== $user->id) {
            abort(403, 'Brak dostępu do edycji tego roweru');
        }

        return view('bikes.edit', compact('bike'));
    }

    // Zaktualizuj rower
    public function update(Request $request, $id)
    {
        $bike = Bike::findOrFail($id);

        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'owner' && $bike->user_id !== $user->id) {
            abort(403, 'Brak dostępu do edycji tego roweru');
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|string|max:255',
            'components'  => 'nullable|string|max:255',
            'weight'      => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        $bike->update([
            'name'        => $request->name,
            'type'        => $request->type,
            'components'  => $request->components,
            'weight'      => $request->weight,
            'description' => $request->description,
        ]);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower zaktualizowany!');
    }

    // Usuwanie roweru
    public function destroy($id)
    {
        $bike = Bike::findOrFail($id);

        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'owner' && $bike->user_id !== $user->id) {
            abort(403, 'Brak dostępu do usuwania tego roweru');
        }

        $bike->delete();

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower usunięty!');
    }
}
