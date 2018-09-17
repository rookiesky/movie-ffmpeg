<?php

namespace App\Http\Controllers\Api;

use App\Models\SystemServer;
use App\Transformers\ServerTansform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServerApi extends Controller
{
    public function find($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is empty');
        }

        $server = SystemServer::where('is_active',1)->find($id);

        if(empty($server)){
            return $this->errorMsg('線路不存在');
        }

        return $this->successMsg('success',
            (new ServerTansform())->linkTransform($server->toArray())
            );

    }
}
