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
        $this->middleware(['auth', 'role:admin,owner']);
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

    public function store(Request $request)
    {
        // Owner nie może tworzyć admina
        if (auth()->user()->role === 'owner' && $request->role === 'admin') {
            return redirect()->route('users.index')->with('error', 'Owner nie może tworzyć użytkownika z rolą admin.');
        }

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

    public function edit(User $user)
    {
        // Owner nie może edytować admina
        if (auth()->user()->role === 'owner' && $user->role === 'admin') {
            return redirect()->route('users.index')->with('error', 'Owner nie może edytować administratora!');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Owner nie może aktualizować admina
        if (auth()->user()->role === 'owner' && $user->role === 'admin') {
            return redirect()->route('users.index')->with('error', 'Brak uprawnień do edycji tego użytkownika!');
        }

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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();

        if ($authUser->id === $user->id) {
            return redirect()->route('users.index')->with('error', 'Nie możesz usunąć samego siebie!');
        }

        // Owner nie może usuwać adminów ani innych ownerów
        if ($authUser->role === 'owner' && in_array($user->role, ['admin', 'owner'])) {
            return redirect()->route('users.index')->with('error', 'Owner nie może usuwać tego użytkownika!');
        }

        // Admin może usuwać każdego
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Użytkownik usunięty!');
    }
}
