@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:20px; font-size:22px;">
        Wiadomości wewnętrzne
    </h1>


    @if(session('success'))
        <div style="color:#207227; background:#e9fbe5; border-radius:5px; padding:6px 12px; margin-bottom:16px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formularz dodawania wiadomości --}}
    <form method="POST" action="{{ route('messages.store') }}" style="text-align:center; margin-bottom:20px;">
        @csrf
        <textarea name="content" rows="3" placeholder="Napisz wiadomość..." required
                  style="width:100%; max-width:500px; padding:8px; font-size:14px; border:1px solid #aaa; border-radius:4px;"></textarea>
        <br>
        <button type="submit"
                style="margin-top:8px; padding:6px 14px; font-size:14px; border:2px outset #b3b3b3; background:#eaeaea; cursor:pointer;">
            Dodaj wiadomość
        </button>
    </form>

    {{-- Lista wiadomości --}}
    <div style="max-width:700px; margin:0 auto;">
        @forelse($messages as $message)
            <div style="border:1px solid #ccc;  padding:10px 14px; margin-bottom:12px; border-radius:6px; background-color:#b3b3b3">
                <div style="margin-bottom:4px; color:#555; font-size:13px;">
                    <strong>{{ $message->user->name }}</strong>
                    <span style="float:right;">{{ $message->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div style="white-space:pre-wrap; color:#222; font-size:14px;">
                    {{ $message->content }}
                </div>

                {{-- Usuwanie: admin lub właściciel wiadomości --}}
                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $message->user_id))
                    <form method="POST" action="{{ route('messages.destroy', $message->id) }}"
                          onsubmit="return confirm('Usunąć wiadomość?')" style="text-align:right; margin-top:8px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="background:none; color:#b32a2a; border:none; cursor:pointer; font-size:13px;">
                            Usuń
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <p style="text-align:center; color:#666;">Brak wiadomości.</p>
        @endforelse
    </div>

    <div style="margin-top: 24px; display: flex; justify-content: center;">
    <div class="pagination-wrapper">
        {{ $messages->onEachSide(1)->links('vendor.pagination.custom') }}
    </div>
</div>

@endsection
