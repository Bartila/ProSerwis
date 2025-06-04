<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        // Każdy admin i owner może zobaczyć listę użytkowników
        $this->middleware(['auth', 'role:admin,owner'])->only('index');
        // Pozostałe akcje tylko dla admina
        $this->middleware(['auth', 'role:admin'])->except('index');
    }

    // Widok listy użytkowników (admin i owner)
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Tworzenie nowego użytkownika (tylko admin)
    public function create()
    {
        return view('users.create');
    }

    // Zapis nowego użytkownika (tylko admin)
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:user,admin,owner',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Użytkownik dodany!');
    }

    // Edycja użytkownika (tylko admin)
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Zapis edycji użytkownika (tylko admin)
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Użytkownik zaktualizowany!');
    }

    // Usuwanie użytkownika (tylko admin)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();

        if ($authUser->id === $user->id) {
            return redirect()->route('users.index')->with('error', 'Nie możesz usunąć samego siebie!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Użytkownik usunięty!');
    }
}
