<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Builder;

class MovieRepository
{
    public function all(): Builder
    {
        return Movie::select()
            ->with('screeningEvents')
            ->orderBy('title');
    }

    public function find(string $id): Movie
    {
        return $this->all()->findOrFail($id);
    }

    public function create(array $data): Movie
    {
        if (isset($data['cover_image']) && $data['cover_image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['cover_image'] = $data['cover_image']->store('movies', ['public']);
        }

        return Movie::create($data);
    }

    public function update(string $id, array $data): Movie
    {
        $movie = Movie::findOrFail($id);

        if (isset($data['cover_image']) && $data['cover_image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['cover_image'] = $data['cover_image']->store('movies', ['public']);
        }

        $movie->update($data);

        return $movie;
    }

    public function delete(string $id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();
    }
}
