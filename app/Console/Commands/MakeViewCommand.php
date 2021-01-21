<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeViewCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:produce-view {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new modify view || @author https://github.com/BayuWidia';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'View';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/View.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Views';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = class_basename(str_replace('\\', '/', $name));

        return "{$this->laravel['path']}/../resources/views/index{$name}.blade.php";
    }
}
