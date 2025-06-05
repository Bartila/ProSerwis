<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

/**
 * Kontroler do zarządzania użytkownikami systemu (admin/owner).
 */
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,owner'])->only('index');
        $this->middleware(['auth', 'role:admin'])->except('index');
    }


    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    /**
     * Zapisuje nowego użytkownika do bazy (tylko admin).
     */
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

    /**
     * Formularz edycji wybranego użytkownika (tylko admin).
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Zapisuje zmiany w danych użytkownika (tylko admin).
     */
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

    /**
     * Usuwa wybranego użytkownika z bazy (tylko admin).
     * Admin nie może usunąć samego siebie
     */
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
