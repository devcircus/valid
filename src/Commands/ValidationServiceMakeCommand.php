<?php

namespace BrightComponents\Valid\Commands;

use Illuminate\Support\Facades\Config;
use Illuminate\Console\GeneratorCommand;
use BrightComponents\Valid\Exceptions\InvalidNamespaceException;

class ValidationServiceMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bright:validation {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new validation service class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Validation Service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (false === parent::handle() && ! $this->option('force')) {
            return;
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/validation-service.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $validationNamespace = Config::get('valid.validation-services.validators.namespace', '');

        if (! $validationNamespace) {
            throw InvalidNamespaceException::missingValidationServiceNamespace();
        }

        return $rootNamespace.'\\'.$validationNamespace;
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        $input = studly_case(trim($this->argument('name')));
        $validatorSuffix = Config::get('valid.validation-services.suffix');

        if (Config::get('valid.validation-services.override_duplicate_suffix')) {
            return str_finish($input, $validatorSuffix);
        }

        return $input.$validatorSuffix;
    }
}
