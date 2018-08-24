<?php

namespace BrightComponents\Valid;

use Illuminate\Routing\Redirector;
use Illuminate\Support\ServiceProvider;
use BrightComponents\Valid\Commands\CustomRuleMakeCommand;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use BrightComponents\Valid\Commands\FormRequestMakeCommand;
use BrightComponents\Valid\ValidationService\ValidationService;
use BrightComponents\Valid\Commands\ValidationServiceMakeCommand;

class ValidServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/valid.php' => config_path('valid.php'),
            ]);
        }

        $this->mergeConfigFrom(__DIR__.'/../config/valid.php', 'valid');

        $this->app->resolving(ValidatesWhenResolved::class, function ($resolved) {
            if (method_exists($resolved, 'prepareCustomRules')) {
                $resolved->prepareCustomRules();
            }
        });

        $this->app->resolving(ValidationService::class, function ($resolved, $app) {
            $resolved->setContainer($app)->setRedirector($app->make(Redirector::class));
        });

        $this->commands([
            FormRequestMakeCommand::class,
            CustomRuleMakeCommand::class,
            ValidationServiceMakeCommand::class,
        ]);
    }
}
