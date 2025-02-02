<?php

namespace App\Http\Controllers;

use App\Filters\MovieFilter;
use App\Http\Requests\MovieFilterRequest;
use App\Http\Requests\MovieRequest;
use App\Http\Resources\Json\MovieResource;
use App\Http\Resources\MovieCollection;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MovieFilterRequest $request, MovieFilter $filters): MovieCollection
    {
        // Pas filters toe
        $movies = Movie::filter($filters->extract($request))
            ->when($request->has('sort'), function ($query) use ($request) {
                $query->orderBy($request->get('sort'), $request->get('order', 'asc'));
            })
            ->with('genre')
            ->paginate($request->input('per_page', 10));

        return new MovieCollection($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        // Create a movie
        $movie = Movie::create($request->validated());

        return new MovieResource($movie);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get the movie
        $movie = Movie::with('genre')->findOrFail($id);

        return new MovieResource($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, string $id)
    {
        // Update the movie
        $movie = Movie::findOrFail($id);
        $movie->update($request->validated());

        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the movie
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return response()->noContent();
    }
}
