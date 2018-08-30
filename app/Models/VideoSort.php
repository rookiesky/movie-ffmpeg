<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoSort extends Model
{
    public $table = 'video_sort';

    public $fillable = ['name','sort','is_home'];

    public function video()
    {
        return $this->hasMany(Video::class,'sort','id');
    }

    public function homeListVideo()
    {
        return $this->video()->where('status',1)->orderBy('updated_at','desc')->limit(8);
    }

}
