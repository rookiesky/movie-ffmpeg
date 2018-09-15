<?php

namespace App\Http\Controllers\Api;

use App\Models\ReflectVideo;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReflectApi extends Controller
{
    public function set($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is empty');
        }

        $video = Video::find($id);

        if(empty($video)){
            return $this->errorMsg('video does not exist');
        }
        $user_id = \Auth::user()->id;

        $model = new ReflectVideo();

        $reflect = $model::where('user_id',$user_id)
            ->where('video_id',$id)
            ->orderBy('id','desc')
            ->first();

        if($reflect){

            if((time() - $reflect->created_at->timestamp) < 86400){
                return $this->errorMsg('每天每個視頻只能檢舉一次！');
            }

        }

        if($model::create(['user_id'=>$user_id,'video_id'=>$id])){
            return $this->successMsg('檢舉成功，感謝您的合作！');
        }
        return $this->errorMsg('操作失敗！');

    }
}
