<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::firstOrCreate(
            ['room_name' => 'TEI'],
            ['location' => 'Lantai 1', 'status' => 'available']
        );

        Room::firstOrCreate(
            ['room_name' => 'TKJ'],
            ['location' => 'Lantai 2', 'status' => 'available']
        );

        Room::firstOrCreate(
            ['room_name' => 'RPL'],
            ['location' => 'Lantai 3', 'status' => 'available']
        );
    }
}
