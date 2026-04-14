<?php

namespace Database\Seeders;

use App\Models\Workshop;
use Illuminate\Database\Seeder;

class WorkshopSeeder extends Seeder
{
    public function run(): void
    {
        Workshop::insert([
            [
                'title' => 'Web Development Basics',
                'description' => 'Introduction to HTML, CSS, and JavaScript.',
                'speaker' => 'John Cruz',
                'venue' => 'Computer Lab 1',
                'event_date' => '2026-04-20',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'capacity' => 40,
                'status' => 'Open',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laravel for Beginners',
                'description' => 'Learn Laravel routing, MVC, and migrations.',
                'speaker' => 'Maria Santos',
                'venue' => 'Computer Lab 2',
                'event_date' => '2026-04-22',
                'start_time' => '01:00:00',
                'end_time' => '04:00:00',
                'capacity' => 35,
                'status' => 'Open',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'UI/UX Design Workshop',
                'description' => 'Basic UI/UX principles for modern applications.',
                'speaker' => 'Angela Reyes',
                'venue' => 'AVR Room',
                'event_date' => '2026-04-25',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'capacity' => 50,
                'status' => 'Open',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
