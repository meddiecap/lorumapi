<?php

namespace App\View\Components\Faker;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResourceSample extends Component
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
     * Available programming languages for code snippets.
     * @var array|string[]
     */
    public array $languages = [
        'php' => 'PHP',
        'js' => 'JavaScript',
        'bash' => 'Bash',
    ];

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
        return view('components.faker.code-snippets.sample-request');
    }
}
