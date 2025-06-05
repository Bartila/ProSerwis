@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:15px; font-size:22px;">Dodaj nowego użytkownika</h1>

    @if($errors->any())
        <div style="color:#b32a2a; background:#ffe9e9; border-radius:5px; padding:6px 12px; margin-bottom:12px; text-align:center;">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}" style="max-width:400px; margin:0 auto; display:flex; flex-direction:column; gap:10px;">
        @csrf

        <div>
            <label for="name">Nazwa:</label><br>
            <input type="text" name="name" id="name" required
                   style="width:100%; padding:6px; border:1px solid #aaa; border-radius:4px;">
        </div>

        <div>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required
                   style="width:100%; padding:6px; border:1px solid #aaa; border-radius:4px;">
        </div>

        <div>
            <label for="password">Hasło:</label><br>
            <input type="password" name="password" id="password" required
                   style="width:100%; padding:6px; border:1px solid #aaa; border-radius:4px;">
        </div>

        <div>
            <label for="password_confirmation">Powtórz hasło:</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   style="width:100%; padding:6px; border:1px solid #aaa; border-radius:4px;">
        </div>

        <div>
            <label for="role">Rola:</label><br>
            <select name="role" id="role" required
                    style="width:100%; padding:6px; border:1px solid #aaa; border-radius:4px;">
                <option value="user">User</option>
                @if(auth()->user()->role === 'admin')
                    <option value="admin">Admin</option>
                    <option value="owner">Owner</option>
                @elseif(auth()->user()->role === 'owner')
                    <option value="owner">Owner</option>
                @endif
            </select>
        </div>

        <div style="text-align:center;">
            <input type="submit" value="Dodaj użytkownika"
                   style="padding:6px 18px; background:#eaeaea; color:#222; border:2px outset #b3b3b3; border-radius:0; font-size:15px; cursor:pointer; font-family:inherit; min-width:130px;">
        </div>
    </form>
@endsection
