<?php

namespace App\Observers;

use App\Actions\Cache\CleanCacheByTagsAction;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(User $task): void
    {
        (new CleanCacheByTagsAction())->handle(['tasksList']);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(User $task): void
    {
        (new CleanCacheByTagsAction())->handle(['tasksList']);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(User $task): void
    {
        (new CleanCacheByTagsAction())->handle(['usersList']);
    }


}
