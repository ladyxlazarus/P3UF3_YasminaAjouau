<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // agregamos el campo is_admin
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // agregamos el método isAdmin
    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function attendees()
    {
        return $this->hasMany(UserEventsAttendee::class);
    }
}
