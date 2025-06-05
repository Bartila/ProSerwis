@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:15px; font-size:22px;">Użytkownicy</h1>

    @if(session('success'))
        <div style="color:#207227; background:#e9fbe5; border-radius:5px; padding:5px 12px; margin-bottom:12px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color:#b32a2a; background:#ffe9e9; border-radius:5px; padding:5px 12px; margin-bottom:12px; text-align:center;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tylko admin widzi przycisk dodawania --}}
    @if(auth()->user()->role === 'admin')
        <div style="margin-bottom:14px; text-align:center;">
            {{-- OLD SCHOOL BUTTON "Dodaj nowego użytkownika" --}}
            <a href="{{ route('users.create') }}"
               style="display:inline-block; padding:6px 20px; background:#eaeaea; color:#222; border:2px outset #b3b3b3; border-radius:0; font-size:15px; cursor:pointer; font-family:inherit; min-width:170px; text-align:center; text-decoration:none;">
                Dodaj nowego użytkownika
            </a>
        </div>
    @endif

    <div style="overflow-x:auto;">
        <table style="margin:0 auto; border-collapse:collapse; width:auto; min-width:100%; font-size:14px;">
            <tr style="background:#e3e3e3;">
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">ID</th>
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Nazwa</th>
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Email</th>
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Rola</th>
                {{-- Tylko admin widzi akcje --}}
                @if(auth()->user()->role === 'admin')
                    <th style="padding:5px 8px; border:1px solid #bdbdbd;">Akcje</th>
                @endif
            </tr>
            @foreach($users as $user)
                <tr>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">{{ $user->id }}</td>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">{{ $user->name }}</td>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">{{ $user->email }}</td>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">{{ ucfirst($user->role) }}</td>
                    {{-- Akcje tylko dla admina --}}
                    @if(auth()->user()->role === 'admin')
                        <td style="padding:4px 6px; border:1px solid #d0d0d0;">
                            <a href="{{ route('users.edit', $user->id) }}" style="color:#1581e0; text-decoration:underline; margin-right:6px;">Edytuj</a>
                            @if(auth()->user()->id !== $user->id)
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Usunąć użytkownika?')" style="color:#b32a2a; background:none; border:none; text-decoration:underline; cursor:pointer; font-size:13px;">
                                        Usuń
                                    </button>
                                </form>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
@endsection
