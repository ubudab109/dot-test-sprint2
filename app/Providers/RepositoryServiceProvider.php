<?php

namespace App\Providers;

use App\Repositories\DataSource\DataSourceInterface;
use App\Repositories\DataSource\DataSourceRepostiry;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /** INTERFACE AND REPOSITORY */
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(DataSourceInterface::class, DataSourceRepostiry::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
