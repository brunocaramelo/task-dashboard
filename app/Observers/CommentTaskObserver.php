<?php

namespace App\Observers;

use App\Models\CommentTask;

use App\Actions\Cache\{CleanCacheByKeysAction,
    CleanCacheByTagsAction};

class CommentTaskObserver
{
    /**
     * Handle the CommentTask "created" event.
     */
    public function created(CommentTask $commentTask): void
    {
        (new CleanCacheByKeysAction())->handle(['taskItem:'.$commentTask->task->id]);
    }

    /**
     * Handle the CommentTask "updated" event.
     */
    public function updated(CommentTask $commentTask): void
    {
        (new CleanCacheByKeysAction())->handle(['taskItem:'.$commentTask->task->id]);
    }

    /**
     * Handle the CommentTask "deleted" event.
     */
    public function deleted(CommentTask $commentTask): void
    {
        (new CleanCacheByKeysAction())->handle(['taskItem:'.$commentTask->task->id]);

    }

}
