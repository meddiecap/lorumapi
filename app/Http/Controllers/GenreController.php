<?php

namespace App\Http\Controllers;

use App\Filters\GenreFilters\GenreFilter;
use App\Http\Requests\GenreFilterRequest;
use App\Http\Requests\GenreRequest;
use App\Http\Requests\MovieRequest;
use App\Http\Resources\GenreCollection;
use App\Http\Resources\Json\GenreResource;
use App\Http\Resources\Json\MovieResource;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GenreFilterRequest $request, GenreFilter $filters): GenreCollection
    {
        $genres = Genre::filter($filters->extract($request))
            ->when($request->has('sort'), function ($query) use ($request) {
                $query->orderBy($request->get('sort'), $request->get('order', 'asc'));
            })
            ->paginate($request->input('per_page', 10));

        return new GenreCollection($genres);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreRequest $request)
    {
        // Create a genre
        $movie = Genre::create($request->validated());

        return new GenreResource($movie);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get the genre
        $genre = Genre::findOrFail($id);

        return new GenreResource($genre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenreRequest $request, string $id)
    {
        // Update the genre
        $genre = Genre::findOrFail($id);
        $genre->update($request->validated());

        return new GenreResource($genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete the genre
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return response()->noContent();
    }
}
