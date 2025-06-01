@extends('layouts.app')

@section('content')
    <h1>Rowery</h1>

    <!-- Komunikaty o sukcesie/błędach -->
    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div style="color: red">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <!-- Formularz dodawania roweru -->
    <form method="POST" action="{{ route('cyclesynchub.store') }}">
        @csrf
        <div>
            <input type="text" name="name" placeholder="Nazwa roweru" required>
            <input type="text" name="type" placeholder="Typ roweru" required>
            <input type="submit" value="Dodaj">
        </div>
    </form>

    <!-- Lista rowerów -->
    <table border="1" cellpadding="5">
        <tr>
            <th>Nazwa</th>
            <th>Typ</th>
            @if(auth()->user()->isAdmin() || auth()->user()->isOwner())
                <th>Właściciel</th>
            @endif
            <th>Akcje</th>
        </tr>
        @forelse($bikes as $bike)
            <tr>
                <td>{{ $bike->name }}</td>
                <td>{{ $bike->type }}</td>
                @if(auth()->user()->isAdmin() || auth()->user()->isOwner())
                    <td>{{ $bike->user->name ?? '-' }}</td>
                @endif
                <td>
                    {{-- Edycja --}}
                    <a href="{{ route('cyclesynchub.edit', $bike->id) }}">Edytuj</a>
                    {{-- Usuwanie --}}
                    <form action="{{ route('cyclesynchub.destroy', $bike->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Usunąć rower?')">Usuń</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Brak rowerów</td>
            </tr>
        @endforelse
    </table>

    <br>
    <a href="{{ route('home.index') }}">Home</a>
@endsecti
