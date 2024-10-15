<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScreeningEventRequest;
use App\Http\Requests\UpdateScreeningEventRequest;
use App\Repositories\ScreeningEventRepository;
use Illuminate\Http\Response;

class ScreeningEventController extends Controller
{
    public function __construct(private ScreeningEventRepository $repository)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $events = ScreeningEvent::all();
        $events = $this->repository->all()->get();

        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScreeningEventRequest $request)
    {
        $screeningEvent = $this->repository->create($request->validated());

        return response()->json($screeningEvent, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $screeningEvent = $this->repository->find($id);

        return response()->json($screeningEvent);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScreeningEventRequest $request, string $id)
    {
        $screeningEvent = $this->repository->update($id, $request->validated());

        return response()->json($screeningEvent);
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
