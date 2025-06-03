@extends('layouts.app')

@section('content')
    <h2 style="text-align:center; color:#0a4fa3; margin-bottom:20px;">Logowanie</h2>

    @if(session('status'))
        <div style="color: green; margin-bottom: 10px; text-align: center;">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color: red; margin-bottom: 10px; text-align: center;">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" style="max-width:300px; margin:0 auto;">
        @csrf

        <div style="margin-bottom: 12px;">
            <label for="email" style="display:block; margin-bottom:4px;">Email:</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   style="width:100%; padding:6px; border:1px solid #ccc;">
        </div>

        <div style="margin-bottom: 12px;">
            <label for="password" style="display:block; margin-bottom:4px;">Hasło:</label>
            <input id="password" type="password" name="password" required
                   style="width:100%; padding:6px; border:1px solid #ccc;">
        </div>

        <div style="margin-bottom: 16px;">
            <label>
                <input type="checkbox" name="remember"> Zapamiętaj mnie
            </label>
        </div>

        <div style="text-align:center;">
            <button type="submit"
                    style="background:#1581e0; color:white; padding:6px 16px; border:none; cursor:pointer;">
                Zaloguj się
            </button>
        </div>

        <div style="text-align:center; margin-top:14px;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size:0.9rem; color:#555;">
                    Zapomniałeś hasła?
                </a>
            @endif
        </div>
    </form>
@endsection
