<?php

namespace Src\Infrastructure\Tasks\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Broadcasting\InteractsWithBroadcasting;
use Src\Infrastructure\Users\Models\User;

class UserRememberPassword
{
    use Dispatchable, InteractsWithQueue, InteractsWithBroadcasting;

    public $user;
    public $passwordRemember;

    public function __construct(User $user, $passwordRemember)
    {
        $this->user = $user;
        $this->passwordRemember = $passwordRemember;
    }
}
