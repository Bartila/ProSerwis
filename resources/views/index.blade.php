@extends('layouts.app')

@section('no_nav')
@endsection

@section('content')
    <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:300px;">
        <h1 style="color:#0a4fa3; font-size:2.5rem; margin-bottom:18px; text-align:center;">
            Witaj w <span style="font-weight:bold;">CycleSyncHub</span>!
        </h1>
        <p style="font-size:1.1rem; color:#333; max-width:480px; text-align:center; margin-bottom:28px;">
            Twoja platforma do zarządzania rowerami i podzespołami.<br>
            Dodawaj, edytuj i przeglądaj rowery oraz ich detale!<br>
            Dołącz do społeczności lub zarządzaj jako admin/owner.
        </p>

        <nav style="display:flex; gap:18px; margin-bottom:20px;">

            @auth
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:#b32a2a; cursor:pointer; font-weight:500;">

                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color:#1581e0; text-decoration:underline; font-weight:500;">
                    Logowanie
                </a>
                <a href="{{ route('register') }}" style="color:#1581e0; text-decoration:underline; font-weight:500;">

                </a>
            @endauth
        </nav>

        @guest
            <div style="margin-top:18px; color:#888; text-align:center;">
                Zaloguj się, aby korzystać z pełni funkcjonalności aplikacji.
            </div>
        @endguest
    </div>
@endsection
