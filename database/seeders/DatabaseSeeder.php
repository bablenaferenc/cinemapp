<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\ScreeningEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
            $imageFileName = Str::slug($movie) . '.jpg';

            $imagePath = database_path('seeders/images/' . $imageFileName);
            $targetPath = 'movies/' . $imageFileName;

            Storage::disk('public')->put($targetPath, file_get_contents($imagePath));

            Movie::factory()->create([
                'title' => $movie,
                'cover_image' => '/movies/' . $imageFileName,
            ]);
        }

        ScreeningEvent::factory()->count(50)->create();
    }
}
