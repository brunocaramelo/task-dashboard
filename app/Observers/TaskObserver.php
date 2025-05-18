<?php

namespace App\Observers;

use App\Actions\Cache\{CleanCacheByTagAndKeysAction,
                       CleanCacheByTagsAction};

use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        (new CleanCacheByTagAndKeysAction())->handle([[
            'tag' => 'taskItem',
            'key' => 'taskItem:'.$task->id
        ]]);
        (new CleanCacheByTagsAction())->handle(['tasksList']);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        (new CleanCacheByTagAndKeysAction())->handle([[
            'tag' => 'taskItem',
            'key' => 'taskItem:'.$task->id
        ]]);
        (new CleanCacheByTagsAction())->handle(['tasksList']);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        (new CleanCacheByTagAndKeysAction())->handle([[
            'tag' => 'taskItem',
            'key' => 'taskItem:'.$task->id
        ]]);
        (new CleanCacheByTagsAction())->handle(['tasksList']);
    }


}
