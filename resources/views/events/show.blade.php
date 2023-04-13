@extends('layouts.app')

@if(isset($errorMessage))
<div class="alert alert-danger">{{ $errorMessage }}</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@section('content')
<div class="container">
    @if(isset($event))
    <h1>{{ $event->title }}</h1>
    <p>{{ $event->description }}</p>
    <p><strong>Ubicación:</strong> {{ $event->location }}</p>
    <p><strong>Fecha:</strong> {{ $event->date }}</p>
    <p><strong>Creado por:</strong> {{ $event->user ? $event->user->name : 'Desconocido' }}</p>

    <h2>Asistentes</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($event->attendeesUsers as $attendee)
            <tr>
                <td>{{ $attendee->name }}</td>
                <td>{{ $attendee->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="/events/{{ $event->id }}/register" class="btn btn-primary">Registrar Asistente</a>
    <a href="/events/{{ $event->id }}/edit" class="btn btn-secondary">Editar Evento</a>
    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este evento?')">Eliminar Evento</button>
    </form>
    @endif
    <a href="{{ route('events.index') }}" class="btn btn-success">Volver a la Lista</a>
</div>
@endsection