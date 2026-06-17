<?php


namespace App\Providers;

use Src\Infrastructure\Tasks\Models\{Task,
                CommentTask};

use Src\Infrastructure\Tasks\Models\User;


use Src\Infrastructure\Tasks\Observers\{TaskObserver,
                  CommentTaskObserver,
                  UserObserver};

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Task::observe(TaskObserver::class);
        CommentTask::observe(CommentTaskObserver::class);
        User::observe(UserObserver::class);
    }

    public function register()
    {

    }
}
