<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Transformers\VideoTansfrom;
use Illuminate\Support\Facades\Log;

class VideoApi extends Controller
{
    public function homeBanner()
    {
        $result = Video::where('is_banner',1)->orderBy('created_at','desc')->limit(4)->get();

        if($result->isEmpty()){
            Log::warning('home banner is empty');
            return $this->errorMsg('banner is empty',404);
        }


        return $this->successMsg('success',
            (new VideoTansfrom())->transform($result)->toArray()
        );
    }
}
