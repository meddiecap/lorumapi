<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;

class FakerResource extends Model
{
    use \Sushi\Sushi;

    /**
     * @throws ReflectionException
     */
    public function getRows(): array
    {
        $namespace = 'App\\Http\\Resources\\Faker\\';
        $path = app_path('Http/Resources/Faker');
        $resources = [];

        foreach (File::files($path) as $file) {
            $class = $namespace . Str::replaceLast('.php', '', $file->getFilename());
            $reflection = new ReflectionClass($class);

            if (
                class_exists($class) &&
                is_subclass_of($class, \App\Http\Resources\Faker\BaseResource::class) &&
                !$reflection->isAbstract()
            ) {

                $resourceName = (string) Str::of($reflection->getShortName())->replace('Resource', '')->plural();

                $resourceTitle = method_exists($class, 'title')
                    ? $class::title()
                    : $resourceName;

                $resources[] = [
                    'class' => $class,
                    'name' => $resourceTitle,
                    'description' => $class::description(),
                    'longDescription' => $class::longDescription(),
                    'url' => route('faker.resource', ['resource' => strtolower($resourceName)]),
                ];
            }
        }

        return $resources;
    }

    protected function sushiShouldCache(): true
    {
        return true;
    }
}
