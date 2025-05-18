<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskUpdatedSend
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;

    public function __construct($task)
    {
        $currentUser = \Auth::user();

        $message = <<<EOT
        Task [$task->code] has updated
        by $currentUser->name
        EOT;

        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('task-channel'),
        ];
    }
    public function broadcastAs()
    {
        return 'task.updated';
    }
}
