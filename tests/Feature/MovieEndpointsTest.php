<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Movie;
use App\Models\ScreeningEvent;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MovieEndpointsTest extends TestCase
{
    // movie api endpoint prefix
    protected $prefix = '/api/movie';

    public function test_get_movie_api_endpoint(): void
    {
        $data = Movie::with('screeningEvents')
            ->orderBy('title')
            ->get()->toArray();

        $response = $this->get($this->prefix);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                "id",
                "title",
                "description",
                "age_restriction",
                "language",
                "cover_image",
                "screening_events" => [
                    '*' => [
                        "id",
                        "movie_id",
                        "time",
                        "available_seats",
                    ],
                ],
            ],
        ]);

        $response->assertJson($data);
    }

    public function test_get_movie_by_id_api_endpoint(): void
    {
        $data = Movie::with('screeningEvents')->firstWhere('id', 1)->toArray();

        $response = $this->get($this->prefix . '/1');

        $response->assertStatus(200);

        $response->assertJson($data);
    }

    public function test_post_movie_api_endpoint(): void
    {
        $data = Movie::factory()->make()->toArray();

        $image = imagecreatetruecolor(100, 100);
        imagejpeg($image, 'test.jpg');
        $data['cover_image'] = UploadedFile::fake()->image('test.jpg');

        $response = $this->post($this->prefix, $data);

        $data['cover_image'] = $response['cover_image'];

        $response->assertStatus(201);

        $response->assertJson($data);

        $this->assertDatabaseHas('movies', $data);
    }

    public function test_put_movie_api_endpoint(): void
    {
        $updatedDescription = 'Updated Test Description';

        $movie = Movie::latest()->first()->toArray();
        $movie['description'] = $updatedDescription;

        $response = $this->put($this->prefix . '/' . $movie['id'], [
            'description' => $updatedDescription,
        ]);

        $response->assertStatus(200);

        $response->assertJson($movie);
    }

    public function test_delete_movie_api_endpoint(): void
    {
        $movie = Movie::latest()->first()->toArray();

        $response = $this->delete($this->prefix . '/' . $movie['id']);

        $response->assertStatus(200);
    }

    public function test_create_movie_api_endpoint_not_available(): void
    {
        $response = $this->get($this->prefix . '/create');

        $response->assertStatus(404);
    }

    public function test_edit_movie_api_endpoint_not_available(): void
    {
        $response = $this->get($this->prefix . '/1/edit');

        $response->assertStatus(404);
    }

    public function test_get_movie_with_screening_events(): void
    {
        $screeningEvent = ScreeningEvent::latest()->first();

        $events = ScreeningEvent::where('movie_id', $screeningEvent->movie_id)->get();

        $response = $this->get($this->prefix . '/' . $screeningEvent->movie_id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            "id",
            "title",
            "description",
            "age_restriction",
            "language",
            "cover_image",
            "screening_events" => [
                '*' => [
                    "id",
                    "movie_id",
                    "time",
                    "available_seats",
                ],
            ],
        ]);

        $this->assertEquals($response['screening_events'], $events->toArray());
    }
}
