@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Asistentes - {{ $event->title }}</h1>

    <form method="POST" action="/events/{{ $event->id }}/register">
        @csrf

        <div class="form-group">
            <label>Asistentes</label>
            <br>
            <div class="form-check form-check-inline">
                @foreach ($users as $user)
                @if ($event->attendeesUsers->contains($user->id))
                <input class="form-check-input" type="checkbox" name="attendees[]" value="{{ $user->id }}" checked>
                @else
                <input class="form-check-input" type="checkbox" name="attendees[]" value="{{ $user->id }}">
                @endif
                <label class="form-check-label">{{ $user->name }}</label>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar asistentes</button>
        <a href="{{ route('events.show', $event->id) }}" class="btn btn-success">Volver al evento</a>
    </form>
</div>
@endsection