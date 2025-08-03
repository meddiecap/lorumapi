<?php

namespace App\View\Components\Faker;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ApiParameter extends Component
{
    public string $name;
    public string $type;
    public string $description;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $type = 'string', string $description = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.faker.api-parameter');
    }
}
