<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Repositories\IsAdmin\Concatenate\Interfaces\ConcatenateInterface','App\Repositories\IsAdmin\Concatenate\ConcatenateRepository');
        $this->app->bind('App\Repositories\IsAdmin\User\Interfaces\UserInterface','App\Repositories\IsAdmin\User\UserRepository');
        $this->app->bind('App\Repositories\IsAdmin\Privillage\Interfaces\PrivillageInterface','App\Repositories\IsAdmin\Privillage\PrivillageRepository');
        $this->app->bind('App\Repositories\IsAdmin\Logs\Interfaces\LogActivitiesInterface','App\Repositories\IsAdmin\Logs\LogActivitiesRepository');
        $this->app->bind('App\Repositories\Management\ManagementMenu\Interfaces\ManagementMenuInterface','App\Repositories\Management\ManagementMenu\ManagementMenuRepository');
        $this->app->bind('App\Repositories\Management\ManagementUser\Interfaces\ManagementUserInterface','App\Repositories\Management\ManagementUser\ManagementUserRepository');
        $this->app->bind('App\Repositories\Management\ManagementRole\Interfaces\ManagementRoleInterface','App\Repositories\Management\ManagementRole\ManagementRoleRepository');
    }
}
