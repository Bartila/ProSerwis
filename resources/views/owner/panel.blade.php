@extends('layouts.app')

@section('content')
    <h1 style="color:#0a4fa3; margin-bottom:20px;">Panel właściciela</h1>
    <ul style="list-style:none; padding:0; font-size:16px;">
        <li><strong>Łączna liczba rowerów:</strong> {{ $stats['total'] }}</li>
        <li><strong>Gotowe:</strong> {{ $stats['ready'] }}</li>
        <li><strong>W naprawie:</strong> {{ $stats['inRepair'] }}</li>
        <li><strong>Oczekujące:</strong> {{ $stats['waiting'] }}</li>
        <li><strong>Odebrane:</strong> {{ $stats['collected'] }}</li>
    </ul>

@endsection
