<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Repositories\MovieRepository;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    private $repository;

    public function __construct()
    {
        $this->repository = new MovieRepository();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = $this->repository->all()->get();

        return response()->json($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $movie = $this->repository->create($request->validated());

        return response()->json($movie, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = $this->repository->find($id);

        return response()->json($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, string $id)
    {
        $movie = $this->repository->update($id, $request->validated());

        return response()->json($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repository->delete($id);

        return response()->json();
    }
}
