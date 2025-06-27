<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\DirectorCollection;
use App\Http\Resources\Json\DirectorResource;
use App\Http\Resources\Json\GenreResource;
use App\Http\Resources\Json\MovieResource;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with API documentation.
     */
    public function index(Request $request): View
    {
        // Get sample data for API examples
        $movie = Movie::with(['director', 'genre'])->first();
        $director = Director::with('movies')->first();
        $genre = Genre::with('movies')->first();

        // Create sample API responses
        $movieResource = new MovieResource($movie);
        $directorResource = new DirectorResource($director);
        $genreResource = new GenreResource($genre);
        $directorsCollection = new DirectorCollection(Director::paginate(3));

        return view('home', [
            'movieResource' => json_encode($movieResource->toArray($request), JSON_PRETTY_PRINT),
            'directorResource' => json_encode($directorResource->toArray($request), JSON_PRETTY_PRINT),
            'genreResource' => json_encode($genreResource->toArray($request), JSON_PRETTY_PRINT),
            'directorsCollection' => json_encode($directorsCollection->toArray($request), JSON_PRETTY_PRINT),
        ]);
    }
}
