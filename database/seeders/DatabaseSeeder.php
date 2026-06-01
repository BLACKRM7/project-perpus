<?php

namespace Database\Seeders;
use Database\Seeders\RoomsSeeder;
use Database\Seeders\BooksSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan UserSeeder untuk membuat akun admin dan user
        $this->call([
            UserSeeder::class,
            RoomsSeeder::class,
            BooksSeeder::class,
        ]);
    }
}
