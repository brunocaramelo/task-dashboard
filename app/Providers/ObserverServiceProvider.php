<?php


namespace App\Providers;

use App\Models\{Task,
                CommentTask,
                User};

use App\Observers\{TaskObserver,
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