<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Task;

use Illuminate\Database\Eloquent\SoftDeletes;

class CommentTask extends Model
{
    use SoftDeletes;

    protected $table = 'task_comments';
    protected $fillable = [
        'message',
        'task_id',
        'responsible_id',
    ];

    public function task()
    {
        return $this->hasOne(
            Task::class,
            'task_id',
            'id'
        );
    }

}
