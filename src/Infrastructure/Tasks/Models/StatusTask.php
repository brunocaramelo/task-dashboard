<?php

namespace Src\Infrastructure\Tasks\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class StatusTask extends Model
{
    use SoftDeletes;

    protected $table = 'status_tasks';
    protected $fillable = [
        'name',
        'slug',
    ];
}
