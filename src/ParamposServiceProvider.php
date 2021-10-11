<?php

namespace Simpliers\Parampos;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Simpliers\Support\Models\MessageThreadParticipant;

class ParamposServiceProvider extends ServiceProvider
{

    protected $vendorName = "simpliers";
    protected $packageName = "parampos";

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->mergeConfigFrom(
//            __DIR__ . '/../config/' . $this->packageName . '.php', $this->packageName
//        );
    }

    /**
     * A list of artisan commands for your package.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        //$this->loadMigrationsFrom(__DIR__ . '/../database/seeds');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
    }

    protected function bootForConsole()
    {
        // Publishing the configuration file
//        $this->publishes([
//            __DIR__ . '/../config/' . $this->packageName . '.php' => config_path($this->packageName . '.php'),
//        ], 'config');

        /**
         * // Publishing the translation files
         * $this->publishes([
         * __DIR__ . '/../resources/lang' => resource_path('lang/vendor/' . $this->vendorName . '/' . $this->packageName),
         * ], 'translations');
         *
         * // Publishing migration's
         * $this->publishes([
         * __DIR__.'/../migrations' => base_path('/migrations'),
         * ], 'auth-migrations');
         *
         * // Publishing seed's
         * $this->publishes([
         * __DIR__.'/../database' => base_path('/database'),
         * ], 'auth-seeds');
         **/
    }
}
