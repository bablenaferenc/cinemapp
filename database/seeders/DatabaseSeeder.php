<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\ScreeningEvent;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $movies = [
            'Aladdin',
            'Avengers',
            'Back to the Future',
            'Cars',
            'Forrest Gump',
            'Ghostbusters',
            'Harry Potter',
            'Interstellar',
            'Jaws',
            'Joker',
            'Jumanji',
            'Jurassic Park',
            'The Lord of the Rings',
            'The Matrix',
            'Pulp Fiction',
            'Star Wars',
            'The Shining',
            'Titanic',
        ];

        foreach ($movies as $movie) {
            Movie::factory()->create([
                'title' => $movie,
                'cover_image' => '/movies/' . Str::slug($movie) . '.jpg',
            ]);
        }

        ScreeningEvent::factory()->count(50)->create();
    }
}
