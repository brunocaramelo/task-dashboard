<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\User;
use App\Models\StatusTask;
use App\Models\CommentTask;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'code',
        'rapporteur_id',
        'responsible_id',
        'status_id',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany( CommentTask::class,
                                'task_id',
                                'id'
                            );
    }
    public function rapporteur(): BelongsTo
    {
        return $this->belongsTo(User::class,
                                'rapporteur_id',
                                'id',
                            'rapporteur');
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class,
                                'responsible_id',
                                'id',
                            'responsable');
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusTask::class,
                                'status_id',
                                'id',
                            'status');
    }


}
