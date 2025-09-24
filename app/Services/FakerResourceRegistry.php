<?php
namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;

class FakerResourceRegistry
{
    protected static array $resources = [];

    public static function resourceTitle(string $name): ?string
    {
        // Normalize the resource name to lowercase
        $name = strtolower($name);

        // If resources are already loaded, check for the specific resource
        if (!empty(self::$resources)) {
            return self::$resources[$name]['name'] ?? null;
        }

        // Load all resources if not already loaded
        self::list();

        return self::$resources[$name]['name'] ?? null;
    }

    public static function resource(string $name): ?array
    {
        // Normalize the resource name to lowercase
        $name = strtolower($name);

        // If resources are already loaded, check for the specific resource
        if (!empty(self::$resources)) {
            return self::$resources[$name] ?? null;
        }

        // Load all resources if not already loaded
        self::list();

        return self::$resources[$name] ?? null;
    }

    public static function list(): array
    {
        // If resources are already loaded, return them
        if (!empty(self::$resources)) {
            return self::$resources;
        }

        $namespace = 'App\\Http\\Resources\\Faker\\';
        $path = app_path('Http/Resources/Faker');

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

                self::$resources[strtolower($resourceName)] = [
                    'class' => $class,
                    'name' => $resourceTitle,
                    'description' => $class::description(),
                    'longDescription' => $class::longDescription(),
                    'url' => route('faker.resource', ['resource' => strtolower($resourceName)]),
                ];
            }
        }

        return self::$resources;
    }
}
