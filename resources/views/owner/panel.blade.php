@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:15px; font-size:22px;">Panel właściciela</h1>

    <div style="overflow-x:auto;">
        <table style="margin:0 auto; border-collapse:collapse; width:auto; min-width:400px; font-size:14px;">
            <tr style="background:#e3e3e3;">
                <th style="padding:6px 10px; border:1px solid #bdbdbd;">Typ</th>
                <th style="padding:6px 10px; border:1px solid #bdbdbd;">Liczba</th>
            </tr>
            <tr>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">Łączna liczba rowerów</td>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">{{ $stats['total'] }}</td>
            </tr>
            <tr>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">Gotowe</td>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">{{ $stats['ready'] }}</td>
            </tr>
            <tr>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">W naprawie</td>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">{{ $stats['inRepair'] }}</td>
            </tr>
            <tr>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">Oczekujące</td>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">{{ $stats['waiting'] }}</td>
            </tr>
            <tr>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">Odebrane</td>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">{{ $stats['collected'] }}</td>
            </tr>
        </table>
    </div>
@endsection
