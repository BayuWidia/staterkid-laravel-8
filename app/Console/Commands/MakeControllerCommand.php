<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
use Str;

class MakeControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'make:produce-controller {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description'
    protected $description = 'Create a new modify controller || @author https://github.com/BayuWidia';

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

        $random = date("Y_m_d").'_'.rand().'_make_produce_crud';

        $this->controller($name);

    }

    //modify
    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/controller.stub"));
    }


    protected function controller($name)
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
                'App\Http\Controllers',
                'App'.'\\',
                $name,
                strtolower($name),
                lcfirst($name)
            ],
            $this->getStub('Controller')
        );

        // file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
        file_put_contents(app_path("\Http\Controllers"."\\".$name."Controller.php"), $template);
    }
}
