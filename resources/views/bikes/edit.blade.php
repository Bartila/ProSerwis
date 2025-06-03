@extends('layouts.app')

@section('content')
    <h1 style="text-align:center; color:#0a4fa3; margin-bottom:22px;">Edytuj rower</h1>

    @if($errors->any())
        <div style="color: #b32a2a; background:#ffe9e9; border-radius:8px; padding:9px 18px; margin-bottom:18px; text-align:center;">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('cyclesynchub.update', $bike->id) }}" style="margin-bottom: 32px; display:flex; gap:10px; flex-wrap:wrap; justify-content:center;">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ old('name', $bike->name) }}" placeholder="Nazwa roweru" required style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3; min-width:140px;">
        <input type="text" name="type" value="{{ old('type', $bike->type) }}" placeholder="Typ roweru" required style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3; min-width:120px;">
        <input type="text" name="components" value="{{ old('components', $bike->components) }}" placeholder="Podzespoły" style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3; min-width:120px;">
        <input type="number" step="0.1" name="weight" value="{{ old('weight', $bike->weight) }}" placeholder="Waga (kg)" style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3; min-width:100px;">
        <input type="text" name="description" value="{{ old('description', $bike->description) }}" placeholder="Opis" style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3; min-width:140px;">
        <select name="status" required style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3;">
            <option value="oczekuje" {{ $bike->status == 'oczekuje' ? 'selected' : '' }}>Oczekuje</option>
            <option value="w naprawie" {{ $bike->status == 'w naprawie' ? 'selected' : '' }}>W naprawie</option>
            <option value="odebrany" {{ $bike->status == 'odebrany' ? 'selected' : '' }}>Odebrany</option>
        </select>
        <input type="date" name="deadline" value="{{ old('deadline', $bike->deadline) }}" style="padding:8px 12px; border-radius:8px; border:1px solid #c6daf3;">
        <input type="submit" value="Zapisz" style="padding:8px 24px; background:#1581e0; color:#fff; border:none; border-radius:8px; font-weight:500; cursor:pointer;">
    </form>

    <div style="text-align:center;">
        <a href="{{ route('cyclesynchub.index') }}" style="color:#0a4fa3; text-decoration:underline;">Wróć do listy rowerów</a>
    </div>
@endsection
