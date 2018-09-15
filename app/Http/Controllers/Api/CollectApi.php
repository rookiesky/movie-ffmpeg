<?php

namespace App\Http\Controllers\Api;

use App\Models\Collect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CollectApi extends Controller
{
    public function set($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is error',404);
        }

        $user_id = \Auth::user()->id;

        $model = new Collect();

        $data = $model::where('user_id',$user_id)
            ->where('video_id',$id)
            ->first();

        if($data){
            if($data->delete()){
                return $this->successMsg('已取消收藏',[2]);
            }
        }

        if(empty($data)){
            if($model::create(['user_id'=>$user_id,'video_id'=>$id])){
                return $this->successMsg('收藏成功！',[1]);
            }
        }

        return $this->errorMsg('操作失敗！',502);
    }


    public function destroy($id)
    {
        if(empty($id)){
            return $this->errorMsg('請選擇收藏');
        }
        $collect = Collect::where('video_id',$id)
            ->where('user_id',\Auth::user()->id)
            ->first();

        if(empty($collect)){
            return $this->errorMsg('您沒有收藏這個視頻！');
        }

        if($collect->delete()){
            return $this->successMsg('刪除收藏成功！');
        }
        Log::error('用戶刪除收藏紀錄失敗！');
        return $this->errorMsg('操作失敗！');
    }
    
}
