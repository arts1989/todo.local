<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
      'title', 
      'user_id',
    ];

    public function tasks() {
        return $this->hasMany('\App\Task'); //Product Model Name
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
