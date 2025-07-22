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
        $this->middleware(['auth', 'role:admin,owner'])->only('index');
        $this->middleware(['auth', 'role:admin'])->except('index');
    }

    public function index()
    {
        $users = User::orderBy('name')->paginate(5);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

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

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ];

        // Jeśli zalogowany użytkownik to admin, może zmieniać e-mail
        if (auth()->user()->isAdmin()) {
            $rules['email'] = 'required|email|unique:users,email,' . $user->id;
        }

        $validated = $request->validate($rules);

        $user->name = $validated['name'];

        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
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

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Użytkownik usunięty!');
    }
}
