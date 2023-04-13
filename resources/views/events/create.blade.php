@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear nuevo evento</h1>
        <form method="POST" action="{{ route('events.store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="location">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="form-group" style="max-width:200px">
                <label for="date">Fecha</label>
                <input type="datetime-local" class="form-control" id="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('events.index') }}" class="btn btn-success">Volver a la Lista</a>
        </form>
    </div>
@endsection
