<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeInterfaceCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:produce-interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new modify interface class || @author https://github.com/BayuWidia';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Interface';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/Interface.stub';
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
        return $rootNamespace.'\Repositories';
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

        return "{$this->laravel['path']}/../app/Repositories/{$name}Interface.php";
    }
}
