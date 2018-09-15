<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReflectVideo extends Model
{
    public $table = 'reflect_videos';

    public $fillable = ['user_id','video_id'];
}
