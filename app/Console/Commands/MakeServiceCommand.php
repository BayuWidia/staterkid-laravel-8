<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
use Str;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'make:produce-service {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description'
    protected $description = 'Create a new modify service || @author https://github.com/BayuWidia';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //
        $name = $this->argument('name');
        $this->service($name);
    }

    //modify
    protected function getStub()
    {
        // return __DIR__.'/stubs/Service.stub';
        return file_get_contents(resource_path("stubs/service.stub"));
    }


    protected function service($name)
    {
        $template = str_replace(
            [
                '{{ namespace }}',
                '{{ rootNamespace }}',
                '{{ class }}',
                '{{ classSingularLowerCase }}',
                '{{ classCamelStyle }}'
            ],
            [
                'App\Services',
                'App'.'\\',
                $name,
                strtolower($name),
                lcfirst($name)
            ],
            $this->getStub()
        );

        // file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
        file_put_contents(app_path("\Services"."\\".$name."Service.php"), $template);
    }
}
