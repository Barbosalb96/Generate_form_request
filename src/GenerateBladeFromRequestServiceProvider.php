<?php

namespace Lucas\Blade;

use Illuminate\Support\ServiceProvider;

class GenerateBladeFromRequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the Blade form generation command
        $this->commands([
            GenerateBladeRequestCommand::class,
        ]);

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lucas/blade');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/lucas/blade'),
        ], 'views');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lucas/blade');
    }
}
