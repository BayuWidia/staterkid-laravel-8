<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRequestCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:produce-request {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new modify Request class || @author https://github.com/BayuWidia';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/Request.stub';
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
        return $rootNamespace.'\Http\Requests';
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

        return "{$this->laravel['path']}/../app/Http/Requests/{$name}Request.php";
    }
}
