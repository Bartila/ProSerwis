@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:22px;">Rowery</h1>

    {{-- Komunikaty o sukcesie/błędach --}}
    @if(session('success'))
        <div style="color: #207227; background:#e9fbe5; border-radius:8px; padding:9px 18px; margin-bottom:18px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div style="color: #b32a2a; background:#ffe9e9; border-radius:8px; padding:9px 18px; margin-bottom:18px; text-align:center;">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    {{-- Formularz dodawania roweru --}}
    <form method="POST" action="{{ route('cyclesynchub.store') }}" style="margin-bottom: 28px; display:flex; gap:10px; flex-wrap:wrap; justify-content:center;">
        @csrf
        <input type="text" name="name" placeholder="Nazwa roweru" required style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3; min-width:140px;">
        <input type="text" name="type" placeholder="Typ roweru" required style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3; min-width:120px;">
        <input type="text" name="components" placeholder="Podzespoły" style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3; min-width:120px;">
        <input type="number" step="0.1" name="weight" placeholder="Waga (kg)" style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3; min-width:100px;">
        <input type="text" name="description" placeholder="Opis" style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3; min-width:140px;">
        <select name="status" required style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3;">
            <option value="oczekuje">Oczekuje</option>
            <option value="w naprawie">W naprawie</option>
            <option value="gotowy">Gotowy</option>
            <option value="odebrany">Odebrany</option>
        </select>
        <input type="date" name="deadline" placeholder="Termin" style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3;">
        <input type="submit" value="Dodaj" style="padding:8px 24px; background:#1581e0; color:#fff; border:none; border-radius:8px; font-weight:500; cursor:pointer;">
    </form>

    {{-- Wyszukiwarka rowerów --}}
    <form method="GET" action="{{ route('cyclesynchub.index') }}" style="margin-bottom:24px; text-align:center;">
        <input type="text" name="q" placeholder="Wyszukaj rower po nazwie..." value="{{ request('q') }}"
               style="padding:8px 16px; border-radius:8px; border:1px solid #c6daf3; width:260px;">
        <button type="submit"
                style="padding:8px 22px; background:#1581e0; color:#fff; border:none; border-radius:8px; font-weight:500; cursor:pointer;">
            Szukaj
        </button>
    </form>

    {{-- Lista rowerów --}}
    <div style="overflow-x:auto;">
        <table style="margin:0 auto; border-collapse: collapse; width:100%; background:#f7faff; box-shadow:0 1px 4px #0001; border-radius:14px; overflow:hidden;">
            <tr style="background:#eaf2fa;">
                <th style="padding:10px 14px;">Nazwa</th>
                <th style="padding:10px 14px;">Typ</th>
                <th style="padding:10px 14px;">Podzespoły</th>
                <th style="padding:10px 14px;">Waga</th>
                <th style="padding:10px 14px;">Opis</th>
                <th style="padding:10px 14px;">Status</th>
                <th style="padding:10px 14px;">Termin</th>
                @if(auth()->user()->isAdmin() || auth()->user()->isOwner())
                    <th style="padding:10px 14px;">Właściciel</th>
                @endif
                <th style="padding:10px 14px;">Akcje</th>
            </tr>
            @forelse($bikes as $bike)
                <tr>
                    <td style="padding:8px 12px; border-top:1px solid #e3e3e3;">{{ $bike->name }}</td>
                    <td style="padding:8px 12px; border-top:1px solid #e3e3e3;">{{ $bike->type }}</td>
                    <td style="padding:8px 12px; border-top:1px solid #e3e3e3;">{{ $bike->components ?? '-' }}</td>
                    <td style="padding:8px 12px; border-top:1px solid #e3e3e3;">
                        {{ $bike->weight ? $bike->weight.' kg' : '-' }}
                    </td>
                    <td style="padding:8px 12px; border-top:1px solid #e3e3e3; max-width:180px; word-break:break-word;">
                        {{ $bike->description ?? '-' }}
                    </td>
                    <td style="padding:8px 12px; border-top:1px solid #e3e3e3;">
                        {{ ucfirst($bike->status) }}
                        @if($bike->status === 'gotowy')
                            <span style="color:#14b830; font-weight:bold;">✔</span>
                        @elseif($bike->status === 'w naprawie')
                            <span style="color:#f39c12;">&#9888;</span>
                        @elseif($bike->status === 'odebrany')
                            <span style="color:#1267e0;">&#128692;</span>
                        @endif
                    </td>
                    <td style="padding:8px 12px; border-top:1px solid #e3e3e3;">
                        @if($bike->deadline)
                            {{ \Carbon\Carbon::parse($bike->deadline)->format('d.m.Y') }}
                            @if(\Carbon\Carbon::parse($bike->deadline)->isPast() && $bike->status != 'gotowy')
                                <span style="color:red;">(po terminie!)</span>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    @if(auth()->user()->isAdmin() || auth()->user()->isOwner())
                        <td style="padding:8px 12px; border-top:1px solid #e3e3e3;">{{ $bike->user->name ?? '-' }}</td>
                    @endif
                    <td style="padding:8px 12px; border-top:1px solid #e3e3e3;">
                        <a href="{{ route('cyclesynchub.show', $bike->id) }}" style="color:#15912a; text-decoration:underline; margin-right:7px;">Szczegóły</a>
                        <a href="{{ route('cyclesynchub.edit', $bike->id) }}" style="color:#1581e0; text-decoration:underline; margin-right:7px;">Edytuj</a>
                        {{-- Odhacz jako gotowy (tylko admin/owner, jeśli NIE gotowy i NIE odebrany) --}}
                        @if((auth()->user()->isOwner() || auth()->user()->isAdmin()) && !in_array($bike->status, ['gotowy','odebrany']))
                            <form method="POST" action="{{ route('cyclesynchub.complete', $bike->id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" style="color:green; background:none; border:none; text-decoration:underline; cursor:pointer;">
                                    Odhacz jako gotowy
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('cyclesynchub.destroy', $bike->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Usunąć rower?')" style="color:#b32a2a; background:none; border:none; text-decoration:underline; cursor:pointer;">Usuń</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="padding:20px 0; text-align:center; color:#999;">Brak rowerów</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
