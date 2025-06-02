<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CycleSyncHub') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #f7fafc;
            color: #232323;
        }
        .center-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        nav {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 2px 8px #0001;
            padding: 16px 32px;
            margin: 32px 0 24px 0;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        nav a {
            color: #0a4fa3;
            font-weight: 500;
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 8px;
            transition: background .2s;
        }
        nav a:hover {
            background: #e7f1fb;
        }
        .user-info {
            margin-bottom: 20px;
            background: #e7f1fb;
            color: #0a4fa3;
            border-radius: 12px;
            padding: 10px 28px;
            font-size: 1.07rem;
            box-shadow: 0 2px 8px #0001;
            text-align: center;
        }
        main {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 2px 12px #0001;
            padding: 32px 40px;
            margin: 0 0 32px 0;
            min-width: 340px;
            max-width: 650px;
        }
        @media (max-width: 700px) {
            main {
                padding: 18px 6px;
                min-width: unset;
                max-width: 98vw;
            }
            nav {
                flex-direction: column;
                gap: 6px;
                padding: 12px 6px;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="center-container">

        {{-- Pasek z informacją o użytkowniku --}}
        @if (!View::hasSection('no_nav'))
        <div class="user-info">
            @if(auth()->check())
                Zalogowany jako: <strong>{{ auth()->user()->name }}</strong> &bull; {{ auth()->user()->email }} &bull; rola: <b>{{ auth()->user()->role }}</b>
            @else
                Nie jesteś zalogowany
            @endif
        </div>
        @endif

        {{-- Nawigacja --}}
        @if (!View::hasSection('no_nav'))
        <nav>
            <a href="{{ route('cyclesynchub.index') }}">Rowery</a>
            <a href="{{ route('home.index') }}">Strona główna</a>
            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isOwner())
                    <a href="{{ route('users.index') }}">Użytkownicy</a>
                @endif

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:#1d4ed8; cursor:pointer; font-weight:500; padding:6px 14px; border-radius:8px;">Wyloguj</button>
                </form>
            @else
                <a href="{{ route('login') }}">Logowanie</a>
                <a href="{{ route('register') }}">Rejestracja</a>
            @endauth
        </nav>
        @endif

        {{-- Nagłówek strony jeśli istnieje --}}
        @isset($header)
            <header style="margin-bottom:24px; text-align:center;">
                <h2 style="font-size:2rem; color:#0a4fa3;">{{ $header }}</h2>
            </header>
        @endisset

        {{-- Główna treść --}}
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
