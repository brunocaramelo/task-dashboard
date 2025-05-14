<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTask extends Model
{
    protected $table = 'status_tasks';
    protected $fillable = [
        'name',
        'slug',
    ];
}
