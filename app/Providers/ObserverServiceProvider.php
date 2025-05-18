<?php


namespace App\Providers;

use App\Models\{Task,
                CommentTask};

use App\Observers\{TaskObserver,
                  CommentTaskObserver};

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Task::observe(TaskObserver::class);
        CommentTask::observe(CommentTaskObserver::class);
    }

    public function register()
    {

    }
}