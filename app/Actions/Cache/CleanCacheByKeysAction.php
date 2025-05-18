<?php

namespace App\Actions\Cache;

use App\Actions\Action;

class CleanCacheByKeysAction extends Action
{

    public function handle(array $keys)
    {
        foreach ($keys as $key) {
            cache()->forget($key);
        }

    }
}