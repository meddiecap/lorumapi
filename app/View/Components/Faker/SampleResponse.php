<?php

namespace App\View\Components\Faker;

use App\Services\FakerResourceRegistry;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SampleResponse extends Component
{
    /**
     * @var string The title of the resource sample.
     */
    public string $title;

    /**
     * @var array Parameters for the resource sample.
     */
    public array $parameters;

    /**
     * @var string The resource name.
     */
    public string $resource;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $resource, array $parameters = [])
    {
        $this->title = $title;
        $this->parameters = $parameters;
        $this->resource = $resource;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        // Create a sample response for the resource
        $fakerResources = FakerResourceRegistry::list();
        $fakerResource = $fakerResources[$this->resource]['class'];

        $params = collect($fakerResource::availableParams())->map(function ($param) {
            return $param['example'];
        })->toArray();

        for ($i=0; $i < 2; $i++) {
            $results[] = app($fakerResource, [
                'request' => request(),
                'faker' => app('Faker\Generator'),
                'params' => $params,
                'counter' => $i + 1
            ])->resolve();
        }

        // Encode the response as JSON
        $json = json_encode([
            'status' => 'OK',
            'code' => 200,
            'params' => $params,
            'total' => $params['quantity'],
            'data' => $results
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ';'; // Add a semicolon marker for the string replacement logic

        $json = $this->addCommentLine($json);

        return view('components.faker.code-snippets.sample-response', [
            'sampleResponse' => $json,
        ]);
    }

    /**
     * Add a comment line to the JSON response for clarity in the documentation.
     * @param string $json
     * @return string
     */
    protected function addCommentLine(string $json): string
    {
        // DO NOT format this code as it will break the replacement logic
        return str_replace('}
    ]
};', '},
        // ...
    ]
}', $json);
    }
}
