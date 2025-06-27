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
     * Display the homepage.
     */
    public function index(): View
    {
        return view('home');
    }

    /**
     * Display the API documentation page.
     */
    public function documentation(Request $request): View
    {
        // Get sample data for API examples (keep this for response examples)
        $movie = Movie::with(['director', 'genre'])->first();
        $director = Director::with('movies')->first();
        $genre = Genre::with('movies')->first();

        // Create sample API responses
        $movieResource = new MovieResource($movie);
        $directorResource = new DirectorResource($director);
        $genreResource = new GenreResource($genre);
        $directorsCollection = new DirectorCollection(Director::paginate(3));

        // Read and parse the api.json file
        $apiJsonPath = base_path('api.json');
        $apiSpec = json_decode(file_get_contents($apiJsonPath), true);

        // Organize endpoints by tags
        $endpoints = [];
        foreach ($apiSpec['paths'] as $path => $methods) {
            foreach ($methods as $method => $details) {
                $tag = $details['tags'][0] ?? 'Other';

                // Format parameters for the component
                $parameters = [];
                if (isset($details['parameters'])) {
                    foreach ($details['parameters'] as $param) {
                        $parameters[] = [
                            'name' => $param['name'],
                            'type' => $param['schema']['type'] ?? 'string',
                            'description' => $param['description'] ?? '',
                            'required' => $param['required'] ?? false,
                        ];
                    }
                }

                // Add request body parameters if they exist
                if (isset($details['requestBody']['content']['application/json']['schema']['$ref'])) {
                    $schemaRef = $details['requestBody']['content']['application/json']['schema']['$ref'];
                    $schemaName = basename($schemaRef);

                    // Extract schema from components
                    if (isset($apiSpec['components']['schemas'][$schemaName])) {
                        $schema = $apiSpec['components']['schemas'][$schemaName];
                        if (isset($schema['properties'])) {
                            foreach ($schema['properties'] as $propName => $propDetails) {
                                $parameters[] = [
                                    'name' => $propName,
                                    'type' => is_array($propDetails['type'] ?? 'string') ? implode('|', $propDetails['type']) : ($propDetails['type'] ?? 'string'),
                                    'description' => $propDetails['description'] ?? '',
                                    'required' => in_array($propName, $schema['required'] ?? []),
                                ];
                            }
                        }
                    }
                }

                $endpoints[$tag][] = [
                    'method' => strtoupper($method),
                    'path' => '/api' . $path,
                    'description' => $details['summary'] . (isset($details['description']) ? "\n" . $details['description'] : ''),
                    'parameters' => $parameters,
                    'operationId' => $details['operationId'] ?? '',
                ];
            }
        }

        return view('documentation', [
            'movieResource' => json_encode($movieResource->toArray($request), JSON_PRETTY_PRINT),
            'directorResource' => json_encode($directorResource->toArray($request), JSON_PRETTY_PRINT),
            'genreResource' => json_encode($genreResource->toArray($request), JSON_PRETTY_PRINT),
            'directorsCollection' => json_encode($directorsCollection->toArray($request), JSON_PRETTY_PRINT),
            'apiSpec' => $apiSpec,
            'endpoints' => $endpoints,
        ]);
    }
}
