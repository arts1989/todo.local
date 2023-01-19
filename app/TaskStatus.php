<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStatus extends Model
{
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
