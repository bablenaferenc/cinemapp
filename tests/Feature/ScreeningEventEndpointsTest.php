<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\ScreeningEvent;
use Tests\TestCase;

class ScreeningEventEndpointsTest extends TestCase
{
    protected $prefix = '/api/screening-event';

    public function test_get_screening_event_api_endpoint(): void
    {
        $data = ScreeningEvent::with('movie')
            ->orderBy('time')
            ->get()
            ->toArray();

        $response = $this->get($this->prefix);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'time',
                'available_seats',
                'movie_id',
                'movie',
            ],
        ]);

        $response->assertJson($data);
    }

    public function test_get_screening_event_by_id_api_endpoint(): void
    {
        $data = ScreeningEvent::firstWhere('id', 1)->toArray();

        $response = $this->get($this->prefix . '/1');

        $response->assertStatus(200);

        $response->assertJson($data);
    }

    public function test_post_screening_event_api_endpoint(): void
    {
        $data = ScreeningEvent::factory()->make()->toArray();

        $response = $this->post($this->prefix, $data);

        $response->assertStatus(201);

        $response->assertJson($data);

        $this->assertDatabaseHas('screening_events', $data);
    }

    public function test_put_screening_event_api_endpoint(): void
    {
        $screeningEvent = ScreeningEvent::latest()->first()->toArray();

        $data = [];
        $data['available_seats'] = 100;
        $data['time'] = '2024-12-31 20:00';
        $data['movie_id'] = 2;

        $response = $this->put($this->prefix . '/' . $screeningEvent['id'], $data);

        $response->assertStatus(200);

        $response->assertJson([...$data, 'id' => $screeningEvent['id']]);

        $this->assertDatabaseHas('screening_events', [...$data, 'id' => $screeningEvent['id']]);
    }

    public function test_delete_screening_event_api_endpoint(): void
    {
        $screeningEvent = ScreeningEvent::latest()->first()->toArray();

        $response = $this->delete($this->prefix . '/' . $screeningEvent['id']);

        $response->assertStatus(200);
    }

    public function test_create_screening_event_api_endpoint_not_available(): void
    {
        $response = $this->get($this->prefix . '/create');

        $response->assertStatus(404);
    }

    public function test_edit_screening_event_api_endpoint_not_available(): void
    {
        $response = $this->get($this->prefix . '/1/edit');

        $response->assertStatus(404);
    }

    public function test_get_screening_event_with_movie(): void
    {
        $screeningEvent = ScreeningEvent::latest()->first();

        $movie = Movie::firstWhere('id', $screeningEvent->movie_id)->toArray();

        $response = $this->get($this->prefix . '/' . $screeningEvent->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            "id",
            "movie_id",
            "time",
            "available_seats",
            "movie" => [
                "id",
                "title",
                "description",
                "age_restriction",
                "language",
                "cover_image",
            ],
        ]);

        $this->assertEquals($response['movie'], $movie);
    }
}
