@extends('layouts.app')

@section('content')
    <h1>Dodaj nowego użytkownika</h1>
    @if($errors->any())
        <div style="color:red">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div>
            <label>Nazwa:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Hasło:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Powtórz hasło:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <div>
            <label>Rola:</label>
            <select name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="owner">Owner</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Dodaj użytkownika">
        </div>
    </form>
@endsection
