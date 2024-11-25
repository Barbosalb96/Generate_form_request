<?php

namespace barbosalb96\Blade;

use Illuminate\Support\ServiceProvider;
use barbosalb96\Blade\GenerateBladeRequestCommand;

class GenerateBladeFromRequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            GenerateBladeRequestCommand::class,
        ]);

        $this->publishes([
            __DIR__ . '/resources/views' => 'resources\views',
        ], 'views');
    }

    public function boot()
    {
    }
}
