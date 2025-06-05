<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        }
        aside {
            width: 220px;
            background: #e0e0e0;
            height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 8px #ccc;
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
            flex: 1;
            padding: 40px;
            background: #fff;
            min-height: 100vh;
        }
        .user-info {
            font-size: 0.9rem;
            margin-bottom: 20px;
            color: #444;
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
    @yield('content')
</main>

</body>
</html>
