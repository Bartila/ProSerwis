@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #eeeeee;
        margin: 0;
        font-family: sans-serif;
    }

    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
        padding: 20px;
    }

    .login-container {
        display: flex;
        width: 700px;
        background-color: #f8f8f8;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px #aaa;
    }

    .login-left {
        width: 40%;
        background-image: url('/images/subiekt-left.png'); /* opcjonalnie dodaj obrazek tła */
        background-size: cover;
        background-position: center;
        border-right: 1px solid #ccc;
        padding: 20px;
        text-align: center;
    }

    .login-left h1 {
        font-size: 24px;
        margin-top: 50px;
        color: #003366;
    }

    .login-right {
        width: 60%;
        padding: 30px;
    }

    .login-right h2 {
        margin-bottom: 20px;
        font-size: 20px;
        color: #222;
    }

    .login-right label {
        display: block;
        margin-bottom: 4px;
        margin-top: 16px;
        font-size: 14px;
        color: #444;
    }

    .login-right input {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #aaa;
        background-color: #fff;
    }

    .login-right button {
        margin-top: 20px;
        background: #d83030;
        color: white;
        padding: 10px 30px;
        border: 1px solid #900;
        font-size: 14px;
        cursor: pointer;
    }

    .login-right .note {
        margin-top: 10px;
        font-size: 13px;
        color: #666;
        text-align: right;
    }
</style>

<div class="login-wrapper">
    <div class="login-container">
        <div class="login-left">
            <h1>CycleSyncHub</h1>
            {{-- opcjonalnie logo lub obrazek --}}
        </div>
        <div class="login-right">
            <h2>Logowanie</h2>

            @if($errors->any())
                <div style="color: red;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if(session('status'))
                <div style="color: green;">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label for="email">Użytkownik</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

                <label for="password">Hasło</label>
                <input id="password" type="password" name="password" required>

                <button type="submit">OK</button>
            </form>

            @if (Route::has('password.request'))
                <div class="note">
                    <a href="{{ route('password.request') }}"></a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
