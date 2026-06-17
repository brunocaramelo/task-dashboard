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
        $this->app->bind('Src\Domain\Tasks\Interfaces\TaskRepositoryInterface', 'Src\Infrastructure\Tasks\Repositories\TaskRepository');
        $this->app->bind('Src\Domain\Tasks\Interfaces\CommentTasRepositoryInterface', 'Src\Infrastructure\Tasks\Repositories\CommentTaskRepository');
        $this->app->bind('Src\Domain\Users\Interfaces\UserRepositoryInterface', 'Src\Infrastructure\Users\Repositories\UserRepository');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
