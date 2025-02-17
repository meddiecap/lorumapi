<?php

namespace App\Http\Controllers;

use App\Filters\DirectorFilters\DirectorFilter;
use App\Http\Requests\DirectorFilterRequest;
use App\Http\Requests\DirectorRequest;
use App\Http\Resources\DirectorCollection;
use App\Http\Resources\Json\DirectorResource;
use App\Models\Director;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DirectorFilterRequest $request, DirectorFilter $filters): DirectorCollection
    {
        $directors = Director::filter($filters->extract($request))
            ->when($request->has('sort'), function ($query) use ($request) {
                $query->orderBy($request->get('sort'), $request->get('order', 'asc'));
            })
            ->paginate($request->input('per_page', 10));

        return new DirectorCollection($directors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DirectorRequest $request)
    {
        // Create a director
        $movie = Director::create($request->validated());

        return new DirectorResource($movie);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get the director
        $director = Director::findOrFail($id);

        return new DirectorResource($director);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DirectorRequest $request, string $id)
    {
        // Update the director
        $director = Director::findOrFail($id);
        $director->update($request->validated());

        return new DirectorResource($director);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the director
        $director = Director::findOrFail($id);
        $director->delete();

        return response()->noContent();
    }
}
