<?php
namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PhpParser\Comment\Doc;
use ReflectionClass;

class FakerResourceRegistry
{
    public static function list(): array
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

                $resources[strtolower($resourceName)] = [
                    'class' => $class,
                    'name' => $resourceName,
                    'description' => $class::description(),
                    'longDescription' => $class::longDescription(),
                    'url' => route('faker.resource', ['resource' => strtolower($resourceName)]),
                ];
            }
        }

        return $resources;
    }
}
