<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        $faker = Faker::create();

        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) {
                Event::create([
                    'title' => "Evento " . Str::uuid(),
                    'description' => $faker->paragraph(3),
                    'location' => "Location " . ($i + 1),
                    'date' => Carbon::now()->addDays(rand(1, 30)),
                    'created_by' => $user->id
                ]);
            }
        }
    }
}
