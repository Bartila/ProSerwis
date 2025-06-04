@extends('layouts.app')

@section('content')
    <h2 style="text-align:center; color:#0a4fa3; margin-bottom:18px; font-size:22px;">
        Szczegóły roweru: <span style="color:#232">{{ $bike->name }}</span>
    </h2>

    <div style="overflow-x:auto;">
        <table style="margin:0 auto; border-collapse:collapse; font-size:14px; min-width:400px;">
            <tr style="background:#f2f2f2;">
                <th style="text-align:left; padding:6px 10px; border:1px solid #ccc;">Typ</th>
                <td style="padding:6px 10px; border:1px solid #ccc;">{{ ucfirst($bike->type) }}</td>
            </tr>
            <tr>
                <th style="text-align:left; padding:6px 10px; border:1px solid #ccc;">Podzespoły</th>
                <td style="padding:6px 10px; border:1px solid #ccc;">{{ $bike->components ?? '-' }}</td>
            </tr>
            <tr>
                <th style="text-align:left; padding:6px 10px; border:1px solid #ccc;">Waga</th>
                <td style="padding:6px 10px; border:1px solid #ccc;">{{ $bike->weight ? $bike->weight.' kg' : '-' }}</td>
            </tr>
            <tr>
                <th style="text-align:left; padding:6px 10px; border:1px solid #ccc;">Opis / Imię</th>
                <td style="padding:6px 10px; border:1px solid #ccc;">{{ $bike->description ?? '-' }}</td>
            </tr>
            <tr>
                <th style="text-align:left; padding:6px 10px; border:1px solid #ccc;">Numer telefonu</th>
                <td style="padding:6px 10px; border:1px solid #ccc;">{{ $bike->phone ?? '-' }}</td>
            </tr>
            <tr>
                <th style="text-align:left; padding:6px 10px; border:1px solid #ccc;">Status</th>
                <td style="padding:6px 10px; border:1px solid #ccc;">
                    {{ ucfirst($bike->status) }}
                    @if($bike->status === 'gotowy')
                    @elseif($bike->status === 'w naprawie')
                    @elseif($bike->status === 'oczekuje')
                    @elseif($bike->status === 'odebrany')
                    @endif
                </td>
            </tr>
            <tr>
                <th style="text-align:left; padding:6px 10px; border:1px solid #ccc;">Termin</th>
                <td style="padding:6px 10px; border:1px solid #ccc;">
                    @if($bike->deadline)
                        {{ \Carbon\Carbon::parse($bike->deadline)->format('d.m.Y') }}
                        @if(\Carbon\Carbon::parse($bike->deadline)->isPast() && $bike->status != 'gotowy')
                            <span style="color:red;">(po terminie!)</span>
                        @endif
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th style="text-align:left; padding:6px 10px; border:1px solid #ccc;">Właściciel</th>
                <td style="padding:6px 10px; border:1px solid #ccc;">{{ $bike->user->name ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div style="margin-top:24px; text-align:center;">
        <a href="{{ route('cyclesynchub.edit', $bike->id) }}" style="color:#1581e0; text-decoration:underline; margin-right:12px;">
            Edytuj rower
        </a>
        <a href="{{ route('cyclesynchub.index') }}" style="color:#0a4fa3; text-decoration:underline;">Powrót do listy</a>
    </div>
@endsection
