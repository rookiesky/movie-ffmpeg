<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Transformers\VideoTansfrom;
use Illuminate\Http\Request;
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

    /**
     * video list
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sortList(Request $request)
    {
        $sort = $request->get('sort') ?? '';

        $keyword = $request->get('keyword');

        $limit = $request->get('limit') ?? 1;
        $starPage = 36;

        $query = new Video();

        if($sort){
            $query = $query->where('sort',$sort);
        }

        if($keyword){
            $query = $query->where('name','like',"%{$keyword}%");
        }

        $videos = $query->where('status',1)->paginate($starPage, ['*'], 'page', $limit);

        $data['videos'] = (new VideoTansfrom())->transform($videos->items());
        $data['current_page'] = $limit;
        $data['last_page'] = $videos->lastPage();
        $data['total'] = $videos->total();

        return $this->successMsg('success',$data);
    }


    public function find($id)
    {

        if( empty($id) || is_numeric($id == false) ){
            return $this->errorMsg('id is empty!',404);
        }

        $video = Video::where('status',1)->find($id);

        if(empty($video)){
            return $this->errorMsg('視頻不存在',404);
        }

        $video = (new VideoTansfrom())->playTransform($video);

        return $this->successMsg('success',$video);
    }


    public function randomVideo()
    {
        $id = (new Video())->videoTotalId();

        $random = array_rand($id->toArray(),8);

        $randId = [];
        foreach ($random as $val){
            $randId[] = $id[$val];
        }
        $videos = Video::whereIn('id',$randId)->get();

        return $this->successMsg('success',
            (new VideoTansfrom())->transform($videos)->toArray()
            );
    }
}
