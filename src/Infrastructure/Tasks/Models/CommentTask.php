<?php

namespace Src\Infrastructure\Tasks\Models;

use Illuminate\Database\Eloquent\Model;

use Src\Infrastructure\Tasks\Models\Task;
use Src\Infrastructure\Users\Models\User;

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

    public function responsable()
    {
        return $this->belongsTo(User::class,
                                'responsible_id',
                                'id',
                            'responsable');
    }

}
