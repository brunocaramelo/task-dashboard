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
        $this->app->bind('Src\Domain\Tasks\Interfaces\TaskRepositoryInterface', 'Src\Infrastructure\Tasks\Repositories\EloquentTaskRepository');
        $this->app->bind('Src\Domain\Tasks\Interfaces\CommentTasRepositoryInterface', 'Src\Infrastructure\Tasks\Repositories\EloquentCommentTaskRepository');
        $this->app->bind('Src\Domain\Users\Interfaces\UserRepositoryInterface', 'Src\Infrastructure\Users\Repositories\EloquentUserRepository');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
