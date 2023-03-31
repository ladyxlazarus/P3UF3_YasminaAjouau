<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\UserEventsAttendee;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Usuario autenticado
        $user = $request->user();

        if ($user->isAdmin()) {
            $events = Event::paginate(3);
            session()->flash('alert', 'Estás entrando como Admin. Tienes acceso a todos los eventos');
            return view('events.index', [
                'events' => $events
            ]);
        } else {
            $events = $user->events()->paginate(3);
            return view('events.index', [
                'events' => $events
            ]);
        }
    }
    public function show($id)
    {
        $event = Event::with('attendees')->findOrFail($id);

        return view('events.show', compact('event'));
    }

    public function create(Request $request)
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->location = $request->input('location');
        $event->date = $request->input('date');
        $event->created_by = $user->id;
        $event->save();

        return redirect()->route('events.show', $event->id);
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Evento no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required'
        ]);

        $event->title = $validatedData['title'];
        $event->description = $validatedData['description'];
        $event->location = $validatedData['location'];
        $event->date = $validatedData['date'];
        $event->save();

        return redirect('events/' . $id)->with('success', 'Evento actualizado correctamente');
    }

    public function register($id)
    {
        $event = Event::with('attendees')->findOrFail($id);
        $users = User::all();

        return view('events.registerAttendee', ['event' => $event, 'users' => $users]);
    }

    public function storeAttendee(Request $request, $id)
    {
        // Eliminar todas las entradas de la tabla "user_events_attendees" correspondientes a ese evento para setearlo
        UserEventsAttendee::where('event_id', $id)->delete();

        // Recorrer los asistentes seleccionados en la solicitud y crear nuevas entradas en la tabla
        foreach ($request->input('attendees', []) as $attendeeId) {
            $userEventAttendee = new UserEventsAttendee();
            $userEventAttendee->event_id = $id;
            $userEventAttendee->user_id = $attendeeId;
            $userEventAttendee->save();
        }

        // Redirigir a la página del evento con un mensaje de éxito
        return redirect('events/' . $id)->with('success', 'Los asistentes han sido registrados exitosamente.');
    }


    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $event->attendees()->detach();

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento eliminado correctamente');
    }
}
