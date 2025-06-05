@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:15px; font-size:22px;">Rowery</h1>

    @if(session('success'))
        <div style="color:#207227; background:#e9fbe5; border-radius:5px; padding:5px 12px; margin-bottom:12px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color:#b32a2a; background:#ffe9e9; border-radius:5px; padding:5px 12px; margin-bottom:12px; text-align:center;">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    {{-- Formularz dodawania roweru --}}
    <form method="POST" action="{{ route('cyclesynchub.store') }}" style="margin-bottom:10px; display:flex; gap:4px; flex-wrap:wrap; justify-content:center;">
        @csrf
        <input type="text" name="name" placeholder="Nazwa" required maxlength="10" style="padding:2px 4px; border:1px solid #aaa; min-width:110px; font-size:13px;">
        <select name="type" required style="padding:2px 4px; border:1px solid #aaa; min-width:90px; font-size:13px;">
            <option value="">Typ roweru</option>
            <option value="mtb">MTB</option>
            <option value="szosowy">Szosowy</option>
            <option value="cross">Cross</option>
            <option value="gravel">Gravel</option>
            <option value="trekking">Trekking</option>
            <option value="miejski">Miejski</option>
        </select>
        <select name="components" required style="padding:2px 4px; border:1px solid #aaa; min-width:110px; font-size:13px;">
            <option value="">Podzespoły</option>
            <option value="Campagnolo">Campagnolo</option>
            <option value="SRAM">SRAM</option>
            <option value="Shimano">Shimano</option>
            <option value="Microshift">Microshift</option>
            <option value="Inne">Inne</option>
        </select>

        <textarea name="info" placeholder="Opisz, co trzeba naprawić"
            style="padding:2px 4px; border:1px solid #aaa; min-width:160px; font-size:13px; min-height:32px;">{{ old('info') }}</textarea>

        <input type="number" step="0.1" name="weight" placeholder="Waga (kg)" style="padding:2px 4px; border:1px solid #aaa; min-width:70px; font-size:13px;">
        <input type="text" name="description" placeholder="Imię i nazwisko" required style="padding:2px 4px; border:1px solid #aaa; min-width:100px; font-size:13px;">
        <input type="tel" name="phone" placeholder="+48XXXXXXXXX" pattern="^\+48\d{9}$" required style="padding:2px 4px; border:1px solid #aaa; min-width:120px; font-size:13px;">
        <select name="status" required style="padding:2px 4px; border:1px solid #aaa; font-size:13px;">
            <option value="oczekuje">Oczekuje</option>
            <option value="w naprawie">W naprawie</option>
        </select>
        <input type="date" name="deadline" placeholder="Termin" style="padding:2px 4px; border:1px solid #aaa; min-width:70px; font-size:13px;">
        <input
            type="submit"
            value="Dodaj"
            style="padding:2px 8px; background:#eaeaea; color:#222; border:2px outset #b3b3b3; font-size:13px; cursor:pointer; border-radius:0; font-family:inherit;">
    </form>

    {{-- Wyszukiwarka --}}
    <form method="GET" action="{{ route('cyclesynchub.index') }}" style="margin-bottom:6px; text-align:center;">
        <input type="text" name="q" placeholder="Szukaj po nazwie..." value="{{ request('q') }}" style="padding:2px 6px; border:1px solid #aaa; width:120px; font-size:13px;">
        <button
            type="submit"
            style="padding:2px 10px; background:#eaeaea; color:#222; border:2px outset #b3b3b3; font-size:13px; cursor:pointer; border-radius:0; font-family:inherit;">
            Szukaj
        </button>
    </form>

    {{-- Lista rowerów --}}
    <div style="overflow-x:auto;">
        <table style="margin:0 auto; border-collapse:collapse; width:auto; min-width:100%; font-size:14px;">
            <tr style="background:#e3e3e3;">
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Nazwa</th>
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Status</th>
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Termin</th>
                @if(auth()->user()->isAdmin() || auth()->user()->isOwner())
                    <th style="padding:5px 8px; border:1px solid #bdbdbd;">Właściciel</th>
                @endif
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Akcje</th>
            </tr>
            @forelse($bikes as $bike)
                <tr>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">{{ $bike->name }}</td>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">
                        {{ ucfirst($bike->status) }}
                        @if($bike->status === 'gotowy')
                            <span style="color:#14b830;"></span>
                        @elseif($bike->status === 'w naprawie')
                            <span style="color:#f39c12;"></span>
                        @elseif($bike->status === 'odebrany')
                            <span style="color:#1267e0;"></span>
                        @endif
                    </td>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">
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
                        <td style="padding:4px 6px; border:1px solid #d0d0d0;">{{ $bike->user->name ?? '-' }}</td>
                    @endif
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">
                        <a href="{{ route('cyclesynchub.show', $bike->id) }}" style="text-decoration:underline; margin-right:4px;">Szczegóły</a>
                        <a href="{{ route('cyclesynchub.edit', $bike->id) }}" style="color:#1581e0; text-decoration:underline; margin-right:4px;">Edytuj</a>

                        @if(!in_array($bike->status, ['gotowy', 'odebrany']))
                            <form method="POST" action="{{ route('cyclesynchub.complete', $bike->id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" style="color:green; background:none; border:none; text-decoration:underline; cursor:pointer; font-size:13px;">Gotowy</button>
                            </form>
                        @endif

                        @if($bike->status === 'gotowy')
                            <form method="POST" action="{{ route('cyclesynchub.collected', $bike->id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" style="color:#1267e0; background:none; border:none; text-decoration:underline; cursor:pointer; font-size:13px;">Odebrany</button>
                            </form>
                        @endif

                        @if(auth()->user()->isOwner() || auth()->user()->isAdmin())
                            <form action="{{ route('cyclesynchub.destroy', $bike->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Usunąć rower?')" style="color:#b32a2a; background:none; border:none; text-decoration:underline; cursor:pointer; font-size:13px;">Usuń</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding:10px 0; text-align:center; color:#999; border:1px solid #e0e0e0;">Brak rowerów</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
