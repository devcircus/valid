<?php

namespace BrightComponents\Valid\Commands;

use Illuminate\Support\Facades\Config;
use Illuminate\Console\GeneratorCommand;

class CustomRuleMakeCommand extends GeneratorCommand
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'bright:rule {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Custom Rule';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Custom Rule';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/custom-rule.stub';
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
        $namespace = studly_case(trim(Config::get('valid.rules.namespace')));

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
        $ruleSuffix = Config::get('valid.rules.suffix');

        if (Config::get('valid.rules.override_duplicate_suffix')) {
            return str_finish($input, $ruleSuffix);
        }

        return $input.$ruleSuffix;
    }
}
