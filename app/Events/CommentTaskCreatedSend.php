<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class CommentTaskCreatedSend implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

     public $message;
     public function __construct($commentTask)
     {
         $currentUser = $commentTask->responsable;
         $task = $commentTask->task;

         $message = <<<EOT
         A comment has created on
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
         return 'comment-task.created';
     }
}
