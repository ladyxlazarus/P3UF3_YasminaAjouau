@extends('layouts.app')
@if(session('alert'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('alert') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
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
    <h1>Mis eventos</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Ubicación</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->location }}</td>
                <td>{{ $event->date }}</td>
                <td class="btn-group btn-group-sm">
    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary rounded mr-2" style="max-height:30px"><i class="fa fa-eye"></i></a>
    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-success rounded mr-2" style="max-height:30px"><i class="fa fa-edit"></i></a>
    <a href="{{ route('events.registerAttendee', $event->id) }}" class="btn btn-success rounded mr-2" style="max-height:30px"><i class="fa fa-user-plus"></i></a>
    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este evento?')"><i class="fa fa-trash"></i></button>
    </form>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $events->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
