@extends('layouts.app')

@section('content')
    <h1>Użytkownicy</h1>
    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color: red">{{ session('error') }}</div>
    @endif

    <a href="{{ route('users.create') }}">Dodaj nowego użytkownika</a>

    <table border="1" cellpadding="5" style="margin-top:10px;">
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Email</th>
            <th>Rola</th>
            <th>Akcje</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if(auth()->id() != $user->id && $user->role != 'owner')
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Na pewno usunąć użytkownika?')">Usuń</button>
                        </form>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
