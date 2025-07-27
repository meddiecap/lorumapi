<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FakerManager;

class FakerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind the FakerManager to the service container
        $this->app->singleton('faker', function() {
            $locale = config('app.faker_locale', 'en_US');
            return new FakerManager($locale);
        });
    }
}
