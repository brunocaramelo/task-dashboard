<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentTaskUpdatedSend
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;
    public function __construct($commentTask)
    {
        $currentUser = $commentTask->responsable;
        $task = $commentTask->task;

        $message = <<<EOT
        A comment has updated on
        Task [$task->code]
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
            new Channel('comment-task-channel'),
        ];
    }
    public function broadcastAs()
    {
        return 'comment-task.updated';
    }
}
