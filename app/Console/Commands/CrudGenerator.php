<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
use Str;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'make:produce-crud {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description'
    protected $description = 'Create a new build crud || @author https://github.com/BayuWidia';

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

        $random = date("Y_m_d").'_'.rand().'_crud_'.$name;

        $this->controller($name, $random);
        $this->model($name, $random);
        $this->request($name, $random);
        $this->interface($name, $random);
        $this->repository($name, $random);
        $this->service($name, $random);
        $this->view($name, $random);

        $nameLower = strtolower($name);

        File::append(base_path('routes/web.php'), PHP_EOL .'/*=============== THIS IS APPEND MAKE PRODUCE CRUD ===============*/');
        File::append(base_path('routes/web.php'), PHP_EOL .'Route::get(\''.$nameLower.'-index'. "', [{$name}Controller::class, 'index'])->name('$nameLower-index');");
        File::append(base_path('routes/web.php'), PHP_EOL .'Route::get(\''.$nameLower.'-create'. "', [{$name}Controller::class, 'create'])->name('$nameLower-create');");
        File::append(base_path('routes/web.php'), PHP_EOL .'Route::get(\''.$nameLower.'-edit/{id}'. "', [{$name}Controller::class, 'edit'])->name('$nameLower-edit');");
        File::append(base_path('routes/web.php'), PHP_EOL .'Route::get(\''.$nameLower.'-show/{id}'. "', [{$name}Controller::class, 'show'])->name('$nameLower-show');");
        File::append(base_path('routes/web.php'), PHP_EOL .'Route::post(\''.$nameLower.'-store'. "', [{$name}Controller::class, 'store'])->name('$nameLower-store');");
        File::append(base_path('routes/web.php'), PHP_EOL .'Route::put(\''.$nameLower.'-update'. "', [{$name}Controller::class, 'update'])->name('$nameLower-update');");
        File::append(base_path('routes/web.php'), PHP_EOL .'Route::delete(\''.$nameLower.'-destroy'. "', [{$name}Controller::class, 'destroy'])->name('$nameLower-destroy');");

        File::append(base_path('app\Providers\RepositoryServiceProvider.php'), PHP_EOL .'/*=============== THIS IS APPEND MAKE PRODUCE CRUD ===============*/');
        File::append(base_path('app\Providers\RepositoryServiceProvider.php'), PHP_EOL ."$"."this->app->bind('App\Repositories\_pathUrl_\Interfaces"."\\".$name."Interface','App\Repositories\_pathUrl_"."\\".$name."Repository');");
    }

    //modify
    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }


    protected function model($name, $random)
    {
        $modelTemplate = str_replace(
            [
              '{{ namespace }}',
              '{{ rootNamespace }}',
              '{{ class }}'
            ],
            [
              'App\Models',
              'App'.'\\',
              $name
            ],
            $this->getStub('model')
        );

        // file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
        file_put_contents(app_path("/$random/{$name}.php"), $modelTemplate);
    }

    protected function controller($name, $random)
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
            $this->getStub('controller')
        );

        if(!file_exists($path = app_path("$random")))
        mkdir($path, 0777, true);

        // file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
        file_put_contents(app_path("/$random/{$name}Controller.php"), $template);
    }

    protected function request($name, $random)
    {
        $template = str_replace(
            [
              '{{ namespace }}',
              '{{ rootNamespace }}',
              '{{ class }}'
            ],
            [
              'App\Http\Requests',
              'App'.'\\',
              $name
            ],
            $this->getStub('request')
        );

        // file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
        file_put_contents(app_path("/$random/{$name}Request.php"), $template);
    }

    protected function interface($name, $random)
    {
        $template = str_replace(
            [
              '{{ namespace }}',
              '{{ rootNamespace }}',
              '{{ class }}'
            ],
            [
              'App\Repositories',
              'App'.'\\',
              $name
            ],
            $this->getStub('interface')
        );

        // file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
        file_put_contents(app_path("/$random/{$name}Interface.php"), $template);
    }

    protected function repository($name, $random)
    {
        $template = str_replace(
            [
              '{{ namespace }}',
              '{{ rootNamespace }}',
              '{{ class }}'
            ],
            [
              'App\Repositories',
              'App'.'\\',
              $name
            ],
            $this->getStub('repository')
        );

        // file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
        file_put_contents(app_path("/$random/{$name}Repository.php"), $template);
    }

    protected function service($name, $random)
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
            $this->getStub('service')
        );

        if(!file_exists($path = app_path("$random")))
        mkdir($path, 0777, true);

        // file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
        file_put_contents(app_path("/$random/{$name}Service.php"), $template);
    }

    protected function view($name, $random)
    {
        $viewTemplate = str_replace(
            [
              '{{ class }}'
            ],
            [
              $name
            ],
            $this->getStub('view')
        );

        file_put_contents(app_path("/$random/index{$name}.blade.php"), $viewTemplate);
    }
}
