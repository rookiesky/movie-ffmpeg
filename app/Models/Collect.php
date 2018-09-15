<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    public $fillable = ['user_id','video_id'];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

}
