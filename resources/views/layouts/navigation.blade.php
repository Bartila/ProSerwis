<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <!-- MENU NA GÓRZE -->
            <nav style="background: #fff; border-bottom: 1px solid #eee; padding: 15px; margin-bottom: 20px;">
                <a href="{{ route('cyclesynchub.index') }}" style="margin-right: 16px; font-weight: bold;">Rowery</a>
                <a href="{{ route('home.index') }}" style="margin-right: 16px;">Strona główna</a>
                @auth
                    {{-- LINK WIDOCZNY TYLKO DLA ADMINA I OWNERA --}}
                    @if(auth()->user()->isAdmin() || auth()->user()->isOwner())
                        <a href="{{ route('users.index') }}" style="margin-right: 16px;">Użytkownicy</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none; border:none; color:#1d4ed8; cursor:pointer;">Wyloguj</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="margin-right: 16px;">Logowanie</a>
                    <a href="{{ route('register') }}">Rejestracja</a>
                @endauth
            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
