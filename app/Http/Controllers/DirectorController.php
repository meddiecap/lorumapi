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
     * List Directors
     *
     * Returns a paginated list of directors. \
     * The list can be filtered by name and date of birth. \
     * E.g. /api/directors?name=Quentin&date_of_birth=1963-03-27 \
     * The list can be sorted by any column. \
     * E.g. /api/directors?sort=name&order=desc
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
     * Create director
     */
    public function store(DirectorRequest $request)
    {
        // Create a director
        $movie = Director::create($request->validated());

        return new DirectorResource($movie);
    }

    /**
     * Get a single director
     */
    public function show(string $id)
    {
        // Get the director
        $director = Director::findOrFail($id);

        return new DirectorResource($director);
    }

    /**
     * Update the specified director
     */
    public function update(DirectorRequest $request, string $id)
    {
        // Update the director
        $director = Director::findOrFail($id);
        $director->update($request->validated());

        return new DirectorResource($director);
    }

    /**
     * Delete the specified director
     */
    public function destroy(string $id)
    {
        // Delete the director
        $director = Director::findOrFail($id);
        $director->delete();

        return response()->noContent();
    }
}
