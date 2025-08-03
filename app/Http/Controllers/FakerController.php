<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Facades\Faker;
use App\Http\Resources\Faker\BaseResource;
use App\Services\FakerResourceRegistry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FakerController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(): View
    {
        $commonParameters = BaseResource::availableParams();

        $fakerResources = FakerResourceRegistry::list();

        return view('faker.index', [
            'commonParameters' => $commonParameters,
            'fakerResources' => $fakerResources,
            'fakerLocales' => Faker::getLocales(),
        ]);
    }

    public function resource(Request $request, $resource)
    {
        $resource = strtolower($resource);
        $fakerResources = FakerResourceRegistry::list();
        $availableParameters = $fakerResources[$resource]['class']::availableParams();

        if (!isset($fakerResources[strtolower($resource)])) {
            abort(404, 'Faker resource not found.');
        }

        return view('faker.resource', [
            'resource' => $resource,
            'longDescription' => $fakerResources[$resource]['longDescription'] ?? '',
            'availableParameters' => $availableParameters,
        ]);
    }
}
