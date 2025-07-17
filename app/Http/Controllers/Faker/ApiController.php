<?php

namespace App\Http\Controllers\Faker;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlockFactory;
use ReflectionClass;

class ApiController extends Controller
{
    /**
     * The prefix for the Faker resource classes.
     * This is used to dynamically load the resource classes based on the request.
     *
     * @var string
     */
    protected string $resourceClassPrefix = 'App\\Http\\Resources\\Faker\\';

    /**
     * Handle the incoming request to return a Faker resource.
     * This method dynamically loads the requested resource class and returns the generated data.
     *
     * @param Request $request
     * @param string $resource The name of the resource to be returned.
     * @return JsonResponse
     */
    public function index(Request $request, string $resource): JsonResponse
    {
        // Convert the resource name to singular and studly case
        $resource = Str::of($resource)->singular()->studly();

        $resourceClass = $this->resourceClassPrefix . $resource . 'Resource';

        // Check if the resource class exists
        if (!class_exists($resourceClass)) {
            return response()->json([
                'status' => 'Error',
                'code' => 404,
                'message' => "Resource '$resource' not found. See: " . route('faker.list')
            ], 404);
        }

        return $this->returnResponse($request, $resourceClass);
    }

    /**
     * @throws \ReflectionException
     */
    public function listResources(): JsonResponse
    {
        // Haal de lijst van beschikbare Faker resources op uit de cache
        $fakerResources = $this->getResources();

        return response()->json([
            'status' => 'OK',
            'code' => 200,
            'data' => $fakerResources
        ]);
    }

    /**
     * Return a JSON response with the generated data.
     * This method uses the provided resource class to generate the data based on the request parameters.
     *
     * @param Request $request
     * @param string $resource
     * @return JsonResponse
     */
    protected function returnResponse(Request $request, string $resource): JsonResponse
    {
        $results = [];

        $params = $this->getParams($request);
        $faker = Faker::create($params->language);
        if($params->seed) $faker->seed($params->seed);

        for ($i=0; $i < $params->quantity; $i++) {
            $results[] = (new $resource($request, $faker, $params, $i + 1))->resolve();
        }

        return response()
            ->json([
                'status' => 'OK',
                'code' => 200,
                'total' => count($results),
                'data' => $results
            ]);
    }

    /**
     * Get the parameters from the request.
     * This method limits the quantity to a maximum defined in the config
     * and retrieves the locale and seed from the request.
     *
     * @param Request $request
     * @return object
     */
    protected function getParams(Request $request): object
    {
        // Limit the quantity to a maximum defined in the config
        $q = min(
            $request->get('_quantity', 10),
            config('api.response_limit_number', 1000)
        );

        return (object)[
            'quantity' => $q,
            'language' => $request->get('_locale', 'en_US'),
            'seed' => $request->get('_seed')
        ];
    }

    /**
     * Get all available Faker resources.
     *
     * This method scans the app/Http/Resources/Faker directory.
     * It returns an array of resources with their name, class, and route.
     *
     * @return mixed
     * @throws \ReflectionException
     */
    protected function getResources(): mixed
    {
        return collect(File::files(app_path('Http/Resources/Faker')))
            // Get all PHP files in the Faker resources directory
            ->map(fn(\SplFileInfo $file) => $file->getBasename('.php'))
            // Exclude BaseResource
            ->reject(fn(string $base) => $base === 'BaseResource')
            // Rename to full class names
            ->map(fn(string $base) => $this->resourceClassPrefix . $base)
            // Filter only existing classes
            ->filter(fn(string $class) => class_exists($class))
            // Build an array with resource name, class and route
            ->map(function (string $class) {
                $ref = new ReflectionClass($class);

                $short = Str::of($ref->getShortName())
                    ->replace('Resource', '');

                return [
                    'name' => (string)$short,
                    'class' => $class,
                    'route' => route('faker.index', [
                        'resource' => $short->plural()->kebab(),
                    ]),
                ];
            })
            // Sort the resources by name
            ->sortBy('name')
            ->values();
    }
}
