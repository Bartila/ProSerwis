<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>CycleSyncHub</title>
</head>
<body>
    <h1>Witaj w CycleSyncHub!</h1>
    <nav>
        <a href="{{ route('cyclesynchub.index') }}">Rowery</a>
        <a href="/blog">Blog</a>

        @auth
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:none;border:none;color:blue;cursor:pointer;">Wyloguj</button>
            </form>
        @else
            <a href="{{ route('login') }}">Logowanie</a>
            <a href="{{ route('register') }}">Rejestracja</a>
        @endauth
    </nav>
</body>
</html>
