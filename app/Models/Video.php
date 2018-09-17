<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    public $fillable = ['name','pixel','sort','region','is_vip','point','time_limit','is_banner','thumbnail','link','view','preview'];


    public function videoSort()
    {
        return $this->hasOne(VideoSort::class,'id','sort');
    }

    public function tags()
    {
        return $this->hasManyThrough(VideoTag::class,VideoToTag::class,'video_id','id','id','tag_id');
    }

    public function servers()
    {
        return $this->hasManyThrough(SystemServer::class,VideoToServer::class,'video_id','id','id','server_id');
    }


    public function collect()
    {
        if(!\Auth::check()){
            return false;
        }
        $user_id = \Auth::user()->id;

        $result = Collect::where('user_id',$user_id)
            ->where('video_id',$this->id)
            ->first();

        return (bool) $result;
    }

    public function videoTotalId()
    {
        return Cache::remember('videototalid',120,function (){
            return collect(
                DB::table($this->getTable())->where('status',1)->get(['id'])
            )->pluck('id');
        });
    }

    /**
     * pixel array
     * @return array
     */
    public function pixelForm()
    {
        return ['高清','720P','1080P'];
    }

    /**
     * region
     * @return array
     */
    public function regionForm()
    {
        return [
            'china' => '中國',
            'eu' => '歐洲',
            'us' => '美洲',
            'jp' => '日本',
            'kr' => '韓國'
        ];
    }

}
