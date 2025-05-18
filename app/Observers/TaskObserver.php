<?php

namespace App\Observers;

use App\Actions\Cache\{CleanCacheByKeysAction,
                       CleanCacheByTagsAction};

use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        (new CleanCacheByKeysAction())->handle(['taskItem:'.$task->id]);
        (new CleanCacheByTagsAction())->handle(['tasksList']);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        \Log::info('interceptei updated');
        (new CleanCacheByKeysAction())->handle(['taskItem:'.$task->id]);
        (new CleanCacheByTagsAction())->handle(['tasksList']);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        (new CleanCacheByKeysAction())->handle(['taskItem:'.$task->id]);
        (new CleanCacheByTagsAction())->handle(['tasksList']);
    }


}
