@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:15px; font-size:22px;">Edytuj użytkownika</h1>

    @if ($errors->any())
        <div style="color:#b32a2a; background:#ffe9e9; border-radius:5px; padding:6px 12px; margin-bottom:12px; text-align:center;">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}"
          style="max-width:400px; margin:0 auto; display:flex; flex-direction:column; gap:10px;">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nazwa:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                   style="width:100%; padding:6px; border:1px solid #aaa; border-radius:4px;">
        </div>

        @if(auth()->user()->isAdmin())
            <div>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                       style="width:100%; padding:6px; border:1px solid #aaa; border-radius:4px;">
            </div>
        @endif

        <div>
            <label for="password">Nowe hasło (opcjonalnie):</label><br>
            <input type="password" name="password" id="password"
                   style="width:100%; padding:6px; border:1px solid #aaa; border-radius:4px;">
        </div>

        <div>
            <label for="password_confirmation">Powtórz hasło:</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   style="width:100%; padding:6px; border:1px solid #aaa; border-radius:4px;">
        </div>

        <div style="text-align:center;">
            <button type="submit"
                    style="padding:6px 18px; background:#eaeaea; color:#222; border:2px outset #b3b3b3; border-radius:0; font-size:15px; cursor:pointer; font-family:inherit; min-width:100px;">
                Zapisz zmiany
            </button>
        </div>
    </form>
@endsection
