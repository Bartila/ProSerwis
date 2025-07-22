@extends('layouts.app')

@section('content')
<style>
    .message-box {
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 10px 14px;
        margin-bottom: 12px;
        background: #f9f9f9;
        color: #222;
    }

    .message-time {
        text-align: right;
        font-size: 12px;
        color: #777;
    }

    .message-delete {
        background: none;
        border: none;
        color: #b32a2a;
        text-decoration: underline;
        cursor: pointer;
    }

    .form-button {
        margin-top: 8px;
        padding: 6px 18px;
        background: #eaeaea;
        border: 2px outset #ccc;
        cursor: pointer;
        color: #222;
    }

    textarea {
        width: 80%;
        max-width: 600px;
        min-height: 60px;
        padding: 6px;
        font-size: 14px;
        border: 1px solid #aaa;
        border-radius: 4px;
        background: #fff;
        color: #000;
    }

    /* 🌙 DARK MODE OVERRIDES */
    body.dark .message-box {
        background: #2a2a2a;
        color: #f1f1f1;
        border-color: #555;
    }

    body.dark .message-time {
        color: #aaa;
    }

    body.dark .form-button {
        background: #3a3a3a;
        color: #f1f1f1;
        border-color: #666;
    }

    body.dark textarea {
        background: #2a2a2a;
        color: #f1f1f1;
        border-color: #555;
    }
</style>

<h1 style="text-align:center; color:#0a4fa3; margin-bottom:18px;">Strona główna</h1>

@if(session('success'))
    <div style="color:#207227; background:#e9fbe5; border-radius:5px; padding:6px 12px; margin-bottom:20px; text-align:center;">
        {{ session('success') }}
    </div>
@endif

<div style="text-align:center; margin-bottom:20px;">
    <strong>Łączna liczba przyjętych rowerów:</strong>
    <span style="font-size:20px; color:#0a4fa3;">{{ $totalBikes }}</span>
</div>

<form method="POST" action="{{ route('messages.store') }}" style="margin-bottom:30px; text-align:center;">
    @csrf
    <textarea name="content" required placeholder="Dodaj wiadomość dla innych użytkowników..."></textarea><br>
    <button type="submit" class="form-button">Wyślij wiadomość</button>
</form>

<h2 style="text-align:center; font-size:18px; margin-bottom:14px;">Wiadomości użytkowników</h2>

<div style="max-width:800px; margin:0 auto;">
    @forelse($messages as $message)
        <div class="message-box">
            <strong>{{ $message->user->name ?? 'Użytkownik' }}</strong> napisał:
            <p style="margin-top:6px;">{{ $message->content }}</p>
            <div class="message-time">{{ $message->created_at->format('d.m.Y H:i') }}</div>

            @if(auth()->user()->isAdmin())
                <form method="POST" action="{{ route('messages.destroy', $message->id) }}" style="margin-top:4px; text-align:right;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Usunąć wiadomość?')" class="message-delete">
                        Usuń
                    </button>
                </form>
            @endif
        </div>
    @empty
        <p style="text-align:center; color:#888;">Brak wiadomości.</p>
    @endforelse
</div>
@endsection
