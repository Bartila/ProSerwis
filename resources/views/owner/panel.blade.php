@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:20px; font-size:22px;">Panel właściciela</h1>

    @if(session('success'))
        <div style="color:#207227; background:#e9fbe5; border-radius:5px; padding:5px 12px; margin-bottom:20px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabela statystyk --}}
    <div style="overflow-x:auto; margin-bottom:30px;">
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
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">{{ $stats['gotowy'] }}</td>
            </tr>
            <tr>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">W naprawie</td>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">{{ $stats['naprawa'] }}</td>
            </tr>
            <tr>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">Oczekujące</td>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">{{ $stats['oczekuje'] }}</td>
            </tr>
            <tr>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">Odebrane</td>
                <td style="padding:6px 10px; border:1px solid #d0d0d0;">
                    {{ $stats['odebrany'] }}
                    @if($stats['odebrany'] > 0)
                        <form method="POST" action="{{ route('cyclesynchub.destroyCollected') }}"
                              onsubmit="return confirm('Czy na pewno chcesz usunąć wszystkie rowery oznaczone jako odebrane?')"
                              style="display:inline; margin-left:8px;">
                            @csrf
                            @method('DELETE')
                            {{-- OLD SCHOOL BUTTON START --}}
                            <button type="submit"
                                    style="padding:2px 10px; background:#eaeaea; color:#222; border:2px outset #b3b3b3; font-size:12px; cursor:pointer; border-radius:0; font-family:inherit;">
                                Usuń odebrane
                            </button>
                            {{-- OLD SCHOOL BUTTON END --}}
                        </form>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    {{-- Tabela rowerów po terminie --}}
    @if(isset($overdueBikes) && $overdueBikes->count())
        <h2 style="text-align:center; color:#b32a2a; margin-bottom:15px; font-size:20px;">Rowery po terminie</h2>

        <div style="overflow-x:auto;">
            <table style="margin:0 auto; border-collapse:collapse; width:auto; min-width:600px; font-size:14px;">
                <thead>
                    <tr style="background:#ffe0e0;">
                        <th style="padding:6px 10px; border:1px solid #ccc;">Nazwa</th>
                        <th style="padding:6px 10px; border:1px solid #ccc;">Typ</th>
                        <th style="padding:6px 10px; border:1px solid #ccc;">Status</th>
                        <th style="padding:6px 10px; border:1px solid #ccc;">Termin</th>
                        <th style="padding:6px 10px; border:1px solid #ccc;">Utworzony przez</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($overdueBikes as $bike)
                        <tr>
                            <td style="padding:6px 10px; border:1px solid #ddd;">{{ $bike->name }}</td>
                            <td style="padding:6px 10px; border:1px solid #ddd;">{{ $bike->type }}</td>
                            <td style="padding:6px 10px; border:1px solid #ddd;">{{ ucfirst($bike->status) }}</td>
                            <td style="padding:6px 10px; border:1px solid #ddd; color:red;">
                                {{ \Carbon\Carbon::parse($bike->deadline)->format('d.m.Y') }}
                            </td>
                            <td style="padding:6px 10px; border:1px solid #ddd;">
                                {{ $bike->user->name ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p style="text-align:center; color:#777; margin-top:20px;">Brak rowerów po terminie.</p>
    @endif
@endsection
