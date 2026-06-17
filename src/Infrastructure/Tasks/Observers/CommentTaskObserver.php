<?php

namespace App\Observers;

use App\Models\CommentTask;

use App\Actions\Cache\CleanCacheByTagAndKeysAction;

class CommentTaskObserver
{
    /**
     * Handle the CommentTask "created" event.
     */
    public function created(CommentTask $commentTask): void
    {
        (new CleanCacheByTagAndKeysAction())->handle([[
            'tag' => 'taskItem',
            'key' => 'taskItem:'.$commentTask->task->id
        ]]);
    }

    /**
     * Handle the CommentTask "updated" event.
     */
    public function updated(CommentTask $commentTask): void
    {
        (new CleanCacheByTagAndKeysAction())->handle([[
            'tag' => 'taskItem',
            'key' => 'taskItem:'.$commentTask->task->id
        ]]);
    }

    /**
     * Handle the CommentTask "deleted" event.
     */
    public function deleted(CommentTask $commentTask): void
    {
        (new CleanCacheByTagAndKeysAction())->handle([[
            'tag' => 'taskItem',
            'key' => 'taskItem:'.$commentTask->task->id
        ]]);
    }

}
