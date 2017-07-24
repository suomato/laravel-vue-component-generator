<?php

namespace Suomato\VueComponentGenerator;

use Config;
use Illuminate\Support\ServiceProvider;
use Suomato\VueComponentGenerator\Commands\GenerateVueComponent;

class VueComponentGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Vue components path
        Config::set('filesystems.disks.vue-components', [
            "driver" => "local",
            "root"   => resource_path('assets/js/components/'),
        ]);

        // Config
        $this->publishes([
            __DIR__.'/config/vue-component-generator.php' => config_path('vue-component-generator.php'),
        ]);

        // Load views
        $this->loadViewsFrom(__DIR__ . '/views', 'laravel-vue-component-generator');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/laravel-vue-component-generator'),
        ]);

        // Register Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateVueComponent::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/vue-component-generator.php', 'vue-component-generator'
        );
    }
}
