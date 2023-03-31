<?php

namespace Database\Seeders;

use Database\Seeders\EventsTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(UserEventsAttendeeSeeder::class);
    }
}
