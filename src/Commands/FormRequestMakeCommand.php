<?php

namespace BrightComponents\Valid\Commands;

use Illuminate\Support\Facades\Config;
use Illuminate\Console\GeneratorCommand;

class FormRequestMakeCommand extends GeneratorCommand
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'adr:request {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Custom FormRequest';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Custom FormRequest';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/custom-request.stub';
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
        $namespace = studly_case(trim(Config::get('valid.requests.namespace')));

        return $namespace ? $rootNamespace.'\\'.$namespace : $rootNamespace;
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        $input = studly_case(trim($this->argument('name')));
        $requestSuffix = Config::get('valid.requests.suffix');

        if (Config::get('valid.requests.override_duplicate_suffix')) {
            return str_finish($input, $requestSuffix);
        }

        return $input.$requestSuffix;
    }
}
