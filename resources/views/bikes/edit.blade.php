@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:15px; font-size:22px;">Edytuj rower</h1>

    @if($errors->any())
        <div style="color:#b32a2a; background:#ffe9e9; border-radius:5px; padding:5px 12px; margin-bottom:12px; text-align:center;">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('cyclesynchub.update', $bike->id) }}" style="display:flex; gap:4px; flex-wrap:wrap; justify-content:center;">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ old('name', $bike->name) }}" placeholder="Nazwa" required maxlength="10"
               style="padding:2px 4px; border:1px solid #aaa; min-width:110px; font-size:13px;">

        <select name="type" required style="padding:2px 4px; border:1px solid #aaa; min-width:90px; font-size:13px;">
            <option value="">Typ roweru</option>
            @foreach(['mtb', 'szosowy', 'cross', 'gravel', 'trekking', 'miejski', 'elektryczny'] as $type)
                <option value="{{ $type }}" {{ old('type', $bike->type) === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
            @endforeach
        </select>

        <textarea name="info" placeholder="Opisz, co trzeba naprawić"
            style="padding:2px 4px; border:1px solid #aaa; min-width:160px; font-size:13px; min-height:32px;">{{ old('info', $bike->info) }}</textarea>

        <input type="text" name="description" value="{{ old('description', $bike->description) }}" placeholder="Imię i nazwisko"
               required style="padding:2px 4px; border:1px solid #aaa; min-width:120px; font-size:13px;">

        <input type="tel" name="phone"
            value="{{ old('phone', isset($bike) ? preg_replace('/^\+48/', '', $bike->phone) : '') }}"
            placeholder="np. 501234567"
            pattern="^\d{9}$" required
            style="padding:2px 4px; border:1px solid #aaa; min-width:120px; font-size:13px;">

        <select name="status" required style="padding:2px 4px; border:1px solid #aaa; font-size:13px;">
            @foreach(['oczekuje', 'w naprawie', 'gotowy', 'odebrany'] as $status)
                <option value="{{ $status }}" {{ old('status', $bike->status) === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
            @endforeach
        </select>

        <input type="date" name="deadline" value="{{ old('deadline', $bike->deadline) }}" placeholder="Termin"
               style="padding:2px 4px; border:1px solid #aaa; min-width:90px; font-size:13px;">

        @auth
            <input type="text" name="qr_code" value="{{ old('qr_code', $bike->qr_code) }}" placeholder="Kod QR (skan lub wpisz)"
                   style="padding:2px 4px; border:1px solid #aaa; min-width:140px; font-size:13px;">
        @endauth

        <input type="submit" value="Zapisz zmiany"
               style="padding:2px 10px; background:#eaeaea; color:#222; border:2px outset #b3b3b3; border-radius:0; font-size:13px; cursor:pointer; font-family:inherit; min-width:90px;">
    </form>
@endsection
