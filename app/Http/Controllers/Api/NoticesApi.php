<?php

namespace App\Http\Controllers\Api;

use App\Models\Notice;
use App\Transformers\NoticeTransform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticesApi extends Controller
{
    public function find($id)
    {
        if(empty($id)){
            return $this->errorMsg('請選擇需要查看的信息');
        }

        $notice = Notice::find($id);

        if(empty($notice)){
            return $this->errorMsg('通知不存在');
        }

        return $this->successMsg('success',
            (new NoticeTransform())->transform($notice->toArray())
            );
        
    }
}
