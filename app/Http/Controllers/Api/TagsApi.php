<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoTag;
use App\Transformers\TagTansfrom;


class TagsApi extends Controller
{
    public function tags()
    {
        $data['tags'] = (new TagTansfrom())->transformCollection(VideoTag::get()->toArray());

        if(empty($data['tags'])){
            $data['tags'] = null;
        }

        $data['city'] = (new Video())->regionForm() ?? null;

        return $this->successMsg('success',compact('data'));
    }
}
