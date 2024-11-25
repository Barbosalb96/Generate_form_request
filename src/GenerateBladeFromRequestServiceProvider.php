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

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'barbosalb96/blade');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/barbosalb96/blade'),
        ], 'views');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'barbosalb96/blade');
    }
}
