<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller; // <-- DODAJ TO!

class UserController extends Controller // <-- ZMIEN TO!
{
    // Tylko admin/owner mogą korzystać z tego kontrolera
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,owner']);
    }

    // Lista wszystkich użytkowników
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Formularz dodawania użytkownika
    public function create()
    {
        return view('users.create');
    }

    // Zapisz nowego użytkownika
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:user,admin,owner',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Użytkownik dodany!');
    }

    // Usuwanie użytkownika
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Nie pozwól usunąć samego siebie lub ownera (opcjonalnie)
        if (auth() == $user->id || $user->role == 'owner') {
            return redirect()->route('users.index')->with('error', 'Nie można usunąć tego użytkownika!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Użytkownik usunięty!');
    }
}
