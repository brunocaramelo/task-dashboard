<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryBindProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Interfaces\TaskInterface', 'App\Repositories\TaskRepository');
        $this->app->bind('App\Interfaces\CommentTaskInterface', 'App\Repositories\CommentTaskRepository');
        $this->app->bind('App\Interfaces\UserInterface', 'App\Repositories\UserRepository');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
