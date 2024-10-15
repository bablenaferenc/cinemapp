<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Models\ScreeningEvent;
use Illuminate\Database\Eloquent\Builder;

class ScreeningEventRepository
{
    public function all(): Builder
    {
        return ScreeningEvent::select()
            ->with('movie')
            ->orderBy('time');
    }

    public function find(string $id): ScreeningEvent
    {
        return $this->all()->findOrFail($id);
    }

    public function create(array $data): ScreeningEvent
    {
        return ScreeningEvent::create($data);
    }

    public function update(string $id, array $data): ScreeningEvent
    {
        $movie = ScreeningEvent::findOrFail($id);

        $movie->update($data);

        return $movie;
    }

    public function delete(string $id)
    {
        $movie = ScreeningEvent::findOrFail($id);

        $movie->delete();
    }
}
