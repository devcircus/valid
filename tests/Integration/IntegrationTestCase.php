<?php

namespace BrightComponents\Valid\Tests\Integration;

use Orchestra\Testbench\TestCase as Orchestra;
use BrightComponents\Valid\ValidServiceProvider;

class IntegrationTestCase extends Orchestra
{
    /**
     * Setup the test case.
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down the test case.
     */
    public function tearDown()
    {
        parent::tearDown();

        $file = app('Illuminate\Filesystem\Filesystem');
        $file->cleanDirectory(base_path().'/app/Http/Requests');
        $file->cleanDirectory(base_path().'/app/Services');
    }

    /**
     * Load ServiceProviders.
     */
    protected function getPackageProviders($app)
    {
        return [
            ValidServiceProvider::class,
        ];
    }

    /**
     * Configure the environment.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app->setBasePath(__DIR__.'/../../vendor/orchestra/testbench-core/laravel/');

        // Configuration for Form Requests
        $app['config']->set('valid.requests.namespace', 'Http\\Requests');
        $app['config']->set('valid.requests.suffix', 'Request');
        $app['config']->set('valid.requests.override_duplicate_suffix', true);

        // Configuration for Custom Rules
        $app['config']->set('valid.rules.namespace', 'Rules');
        $app['config']->set('valid.rules.suffix', 'Rule');
        $app['config']->set('valid.rules.override_duplicate_suffix', true);

        // Configuration for Validation Services
        $app['config']->set('valid.validation-services.namespace', 'Services');
        $app['config']->set('valid.validation-services.suffix', 'Validation');
        $app['config']->set('valid.validation-services.override_duplicate_suffix', true);
    }
}
