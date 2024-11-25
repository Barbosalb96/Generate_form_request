<?php

namespace Lucas\Blade;

use Illuminate\Support\ServiceProvider;

use barbosalb96\Blade\GenerateBladeRequestCommand;

class GenerateBladeFromRequestServiceProvider extends ServiceProvider
{
    public function register()
    {
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