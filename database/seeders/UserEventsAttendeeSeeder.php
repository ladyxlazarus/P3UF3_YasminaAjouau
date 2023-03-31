<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\UserEventsAttendee;

class UserEventsAttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();
        $events = Event::all();

        foreach ($users as $user) {
            $eventCount = rand(0, $events->count());
            $attendedEvents = $events->random($eventCount);

            foreach ($attendedEvents as $event) {
                $userEventAttendee = new UserEventsAttendee([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                ]);
                $userEventAttendee->save();
            }
        }
    }
}
