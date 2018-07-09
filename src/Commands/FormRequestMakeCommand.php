<?php

namespace BrightComponents\Valid\Commands;

use Illuminate\Support\Facades\Config;
use Illuminate\Console\GeneratorCommand;

class FormRequestMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bright:request {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Enhanced FormRequest';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Enhanced FormRequest';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/enhanced-request.stub';
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
        $namespace = studly_case(trim(Config::get('enhanced-form-requests.requests.namespace')));

        return $namespace ? $rootNamespace.'\\'.$namespace : $rootNamespace;
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        $input = $input = studly_case(trim($this->argument('name')));
        $suffix = Config::get('enhanced-form-requests.requests.suffix');

        return str_finish($input, $suffix);
    }
}
