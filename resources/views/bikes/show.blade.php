@extends('layouts.app')

@section('content')
    <h2 style="text-align:center; color:#0a4fa3; margin-bottom:18px;">
        Szczegóły roweru: <span style="color:#232">{{ $bike->name }}</span>
    </h2>

    <table style="margin:0 auto; border-collapse:collapse;">
        <tr><th style="text-align:left;">Typ:</th><td>{{ $bike->type }}</td></tr>
        <tr><th style="text-align:left;">Podzespoły:</th><td>{{ $bike->components ?? '-' }}</td></tr>
        <tr><th style="text-align:left;">Waga:</th><td>{{ $bike->weight ? $bike->weight.' kg' : '-' }}</td></tr>
        <tr><th style="text-align:left;">Opis:</th><td>{{ $bike->description ?? '-' }}</td></tr>
    </table>

    <div style="margin-top:24px; text-align:center;">
        <a href="{{ route('cyclesynchub.edit', $bike->id) }}" style="color:#1581e0; text-decoration:underline; margin-right:12px;">
            Edytuj rower
        </a>
        <a href="{{ route('cyclesynchub.index') }}" style="color:#0a4fa3; text-decoration:underline;">Powrót do listy</a>
    </div>
@endsection
