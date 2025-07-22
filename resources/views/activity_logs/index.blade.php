@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:18px;">Historia operacji</h1>

    @if(session('success'))
        <div style="color:#207227; background:#e9fbe5; border-radius:5px; padding:5px 12px; margin-bottom:14px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    {{--  button do usuwania historii operacji --}}
    @if(auth()->user()->isAdmin() || auth()->user()->isOwner())
        <form method="POST" action="{{ route('activity_logs.destroyAll') }}"
              onsubmit="return confirm('Na pewno wyczyścić WSZYSTKIE logi?');"
              style="text-align:center; margin-bottom:20px;">
            @csrf
            @method('DELETE')
            <button type="submit"
                style="padding:5px 22px; background:#eaeaea; color:#222; border:2px outset #b3b3b3; border-radius:0; font-size:15px; cursor:pointer; font-family:inherit; min-width:80px;">
                Wyczyść
            </button>
        </form>
    @endif

    @php
        function translateAction($action) {
            return match(strtolower($action)) {
                'create' => 'Dodanie',
                'edit', 'update' => 'Edycja',
                'delete' => 'Usunięcie',
                'status_change' => 'Zmiana statusu',
                'sms_sent' => 'Wysłano SMS',
                default => ucfirst(str_replace('_', ' ', $action)),
            };
        }
    @endphp

    <div style="overflow-x:auto;">
        <table style="margin:0 auto; border-collapse:collapse; min-width:600px;">
            <tr style="background:#e3e3e3;">
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Czas</th>
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Użytkownik</th>
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Akcja</th>
                <th style="padding:5px 8px; border:1px solid #bdbdbd;">Opis</th>
            </tr>
            @forelse($logs as $log)
                <tr>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">
                        {{ $log->created_at->format('d.m.Y H:i') }}
                    </td>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">
                        {{ $log->user->name ?? 'System' }}
                    </td>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">
                        {{ translateAction($log->action) }}
                    </td>
                    <td style="padding:4px 6px; border:1px solid #d0d0d0;">
                        {{ str_replace(' (AJAX)', '', $log->description) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding:12px; text-align:center; color:#888; border:1px solid #d0d0d0;">
                        Brak logów w systemie.
                    </td>
                </tr>
            @endforelse
        </table>
    </div>

    <div style="margin-top: 24px; display: flex; justify-content: center;">
        <div class="pagination-wrapper">
            {{ $logs->onEachSide(1)->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
