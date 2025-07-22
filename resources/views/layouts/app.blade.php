<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="CycleSyncHub – zarządzanie naprawami rowerów">

    <title>{{ config('app.name', 'CycleSyncHub') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        aside {
            width: 220px;
            background: #e0e0e0;
            height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 8px #ccc;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        aside a, aside form button {
            display: block;
            padding: 8px 12px;
            margin-bottom: 10px;
            color: #000;
            text-decoration: none;
            border-radius: 4px;
        }

        aside a:hover, aside form button:hover {
            background: #d0d0d0;
        }

        main {
            margin-left: 220px;
            padding: 40px;
            background: #fff;
            flex: 1;
            position: relative;
        }

        .user-info {
            font-size: 0.9rem;
            margin-bottom: 20px;
            color: #444;
        }

        footer {
            background: #eee;
            text-align: center;
            padding: 10px;
            font-size: 13px;
            color: #444;
            margin-top: auto;
        }

        .bike-counter-wrapper {
            position: absolute;
            top: 20px;
            right: 30px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #222;
        }

        .red-dot-button {
            width: 12px;
            height: 12px;
            background-color: red;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .red-dot-button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

@auth
    <aside>
        <div class="user-info">
            <strong>{{ auth()->user()->name }}</strong><br>
        </div>

        <a href="{{ route('home.index') }}">Strona główna</a>
        <a href="{{ route('cyclesynchub.index') }}">Rowery</a>

        @if(auth()->user()->role === 'owner')
            <a href="{{ route('owner.panel') }}">Panel właściciela</a>
        @endif

        @if(auth()->user()->isAdmin() || auth()->user()->isOwner())
            <a href="{{ route('users.index') }}">Użytkownicy</a>
        @endif

        @if(auth()->user()->isAdmin())
            <a href="{{ route('activity_logs.index') }}">Historia operacji</a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none; border:none; cursor:pointer;">Wyloguj</button>
        </form>
    </aside>
@endauth

<main>
    {{-- 🚲 Licznik i 🔴 przycisk resetu --}}
    @isset($totalAdded)
        <div class="bike-counter-wrapper">
            🚲 {{ $totalAdded }}

            @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isOwner()))
                <form method="POST" action="{{ route('messages.resetCounter') }}"
                      onsubmit="return confirm('Na pewno zresetować licznik rowerów?')"
                      style="display:inline;">
                    @csrf
                    <button type="submit" class="red-dot-button" title="Zresetuj licznik"></button>
                </form>
            @endif
        </div>
    @endisset

    @yield('content')
</main>

<footer>
    &copy; {{ date('Y') }} ProSerwis
</footer>

</body>
</html>
