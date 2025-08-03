<?php

namespace App\View\Components\Faker;

use App\Services\FakerResourceRegistry;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResourceList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $fakerResources = FakerResourceRegistry::list();

        return view('components.faker.resource-list', [
            'fakerResources' => $fakerResources,
        ]);
    }
}
