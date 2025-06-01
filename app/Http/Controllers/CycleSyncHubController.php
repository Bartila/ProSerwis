<?php

namespace App\Http\Controllers;

use App\Models\Bike; // <-- lub Bicycle, jeśli tak się nazywa model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CycleSyncHubController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'owner') {
            // Admin i właściciel widzą wszystkie rowery
            $bikes = Bike::all();
        } else {
            // Zwykły użytkownik widzi tylko swoje rowery
            $bikes = Bike::where('user_id', $user->id)->get();
        }

        return view('bikes.index', compact('bikes'));
    }

    public function create()
    {
        return view('bikes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
        ]);

        Bike::create([
            'name' => $request->name,
            'type' => $request->type,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower dodany!');
    }

    public function edit($id)
    {
        $bike = Bike::findOrFail($id);

        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'owner' && $bike->user_id !== $user->id) {
            abort(403, 'Brak dostępu');
        }

        return view('cyclesynchub.edit', compact('bike'));
    }

    public function update(Request $request, $id)
    {
        $bike = Bike::findOrFail($id);
   
        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'owner' && $bike->user_id !== $user->id) {
            abort(403, 'Brak dostępu');
        }

        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
        ]);

        $bike->update($request->only('name', 'type'));

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower zaktualizowany!');
    }

    public function destroy($id)
    {
        $bike = Bike::findOrFail($id);

        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'owner' && $bike->user_id !== $user->id) {
            abort(403, 'Brak dostępu');
        }

        $bike->delete();

        return redirect()->route('cyclesynchub.index')->with('success', 'Rower usunięty!');
    }
}
