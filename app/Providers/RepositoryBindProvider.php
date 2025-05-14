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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
