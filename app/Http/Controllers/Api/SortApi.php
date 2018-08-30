<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VideoSort;
use App\Transformers\SortTansform;

class SortApi extends Controller
{
    /**
     * video sort list
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        $sort = VideoSort::orderBy('sort')->get();
        if($sort->isEmpty()){
            return $this->errorMsg('sort is empty',404);
        }

        return $this->successMsg('is ok',
            (new SortTansform())->transformCollection($sort->toArray())
        );
    }

    /**
     * home video list
     * @return \Illuminate\Http\JsonResponse
     */
    public function video()
    {
        $video = VideoSort::where('is_home',1)->get();

        if($video->isEmpty()){
            return $this->errorMsg('video list is empty',404);
        }
        return $this->successMsg('success',
            (new SortTansform())->homeSortTransform($video)->toArray()
        );

    }
}
