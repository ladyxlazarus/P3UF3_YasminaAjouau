<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'location', 'date', 'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'user_events_attendees');
    }

    public function attendeesUsers()
    {
        return $this->hasManyThrough(User::class, UserEventsAttendee::class, 'event_id', 'id', 'id', 'user_id');
    }
}
