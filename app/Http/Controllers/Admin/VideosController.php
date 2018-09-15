<?php

namespace App\Http\Controllers\Admin;

use App\Models\SystemServer;
use App\Models\Video;
use App\Models\VideoSort;
use App\Models\VideoTag;
use App\Models\VideoToServer;
use App\Models\VideoToTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
{
    public $menuModel = 'video';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($status)
    {
        $listVideoMenu = '';
        $noVideoMenu = '';

        if($status == 1){
            $listVideoMenu = 'active';
        }else{
            $noVideoMenu = 'active';
        }

        $videos = Video::where('status',$status)->orderBy('created_at','desc')->paginate(15);

        return view('admin.video.index',compact(['videos','listVideoMenu','noVideoMenu']));
    }


    public function search(Request $request)
    {
        $this->validate($request,[
            'keyword' => 'required'
        ]);

        $keyword = $request->get('keyword');

        $videos = Video::where('name','like',"%{$keyword}%")->paginate(15);

        $listVideoMenu = 'active';

        return view('admin.video.index',compact(['videos','listVideoMenu','noVideoMenu']));
    }

    /**
     * video create view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $createVideoMenu = 'active';

        $model = new Video();

        $sort = VideoSort::get();

        $server = SystemServer::where('is_active',1)->get();

        $tags = VideoTag::get();

        return view('admin.video.add',compact(['createVideoMenu','model','sort','server','tags']));
    }

    /**
     * video edit view
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if(empty($id)){
            return redirect()->back();
        }

        $video = Video::find($id);

        if(empty($video)){
            return redirect()->back();
        }

        $model = new Video();

        $sort = VideoSort::get();

        $server = SystemServer::where('is_active',1)->get();

        $tags = VideoTag::get();

        $serverId = collect($video->servers)->pluck('id')->toArray();
        $tagId = collect($video->tags)->pluck('id')->toArray();

        return view('admin.video.edit',compact(['video','model','sort','server','tags','serverId','tagId']));
    }

    /**
     * update video status
     * @param $id video id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is empty',404);
        }
        $model = new Video();
        $video = $model::find($id);

        if(empty($video)){
            return $this->errorMsg('video is not exist',404);
        }
        $status = 1;

        if($video->status == 1){
            $status = 0;
        }
        $video->status = $status;

        if($video->save()){
            return $this->successMsg('is ok');
        }
        return $this->errorMsg('update is fail',501);
    }

    /**
     * update video
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'link' => 'required'
        ]);

        if(!$request->has('id')){
            return redirect()->back()->withErrors('視頻不存在');
        }

        $data = $request->only(['name','pixel','sort','region','is_vip','point','is_banner','link','id']);
        $data['time_limit'] = $request->get('time_limit') ?? '';

        $video = Video::find($data['id']);
        if(!$video){
            return redirect()->back()->withErrors('視頻不存在');
        }

        $fileName = $this->upload($request);
        if($fileName != false){
            $data['thumbnail'] = $fileName;
        }

        $server = $request->get('server');
        $tags = $request->get('tags');

        if(empty($server)){
            return redirect()->back()->withErrors('伺服器不能為空');
        }

        $result = Video::where('id',$video->id)->update($data);

        if($result){

            VideoToServer::where('video_id',$video->id)->delete();

            $resultServer = collect($server)->crossJoin($video->id)->map(function ($val){
                $data['server_id'] = array_first($val);
                $data['video_id'] = array_last($val);
                return $data;
            });

            \DB::table('video_to_server')->insert($resultServer->toArray());

            VideoToTag::where('video_id',$video->id)->delete();

            $resultTag = collect($tags)->crossJoin($video->id)->map(function ($val){
                $data['video_id'] = array_last($val);
                $data['tag_id'] = array_first($val);
                return $data;
            });

            if($resultTag){
                \DB::table('video_to_tag')->insert($resultTag->toArray());
            }
            if(isset($data['thumbnail']) && $data['thumbnail'] != ''){
                Storage::disk('ftp')->delete($video->thumbnail);
            }
            return redirect('/setAdmin/video/0');
        }
        return redirect()->back()->withErrors('更新是失敗');
    }

    /**
     * create video
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'link' => 'required'
        ]);


        $data = $request->only(['name','pixel','sort','region','is_vip','point','is_banner','link']);
        $data['time_limit'] = $request->get('time_limit') ?? '';
        $data['view'] = rand(1000,10000);

        $video = Video::where('link',$data['link'])->first();

        if($video){
            return redirect()->back()->withErrors('視頻地址已存在，請確認！');
        }

        $fileName = $this->upload($request);

        if($fileName == false){
            return redirect()->back()->withErrors('封面上傳失敗！');
        }else{
            $data['thumbnail'] = $fileName;
        }

        $server = $request->get('server');
        $tags = $request->get('tags');

        if(empty($server)){
            return redirect()->back()->withErrors('伺服器不能為空');
        }

        $result = Video::create($data);

        if($result->id){
            $id = [$result->id];
            $resultServer = collect($server)->crossJoin($id)->map(function ($val){
                $data['server_id'] = array_first($val);
                $data['video_id'] = array_last($val);
                return $data;
            });

            if(empty($resultServer)){
                $result->delete();
                return redirect()->back()->withErrors('伺服器不能為空！');
            }

            \DB::table('video_to_server')->insert($resultServer->toArray());

            $resultTag = collect($tags)->crossJoin($id)->map(function ($val){
                $data['video_id'] = array_last($val);
                $data['tag_id'] = array_first($val);
                return $data;
            });

            if($resultTag){
                \DB::table('video_to_tag')->insert($resultTag->toArray());
            }

            return redirect('/setAdmin/video/0');
        }
        return redirect()->back()->withErrors('submit is fail');
    }

    /**
     *  delete video
     * @param $id video id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is empty',404);
        }

        $video = Video::find($id);
        if(empty($video)){
            return $this->errorMsg('video is not exist',404);
        }
        $thumb = $video->thumbnail;
        $id = $video->id;

        if($video->delete()){
            Storage::disk('ftp')->delete($thumb);
            VideoToTag::where('video_id',$id)->delete();
            VideoToServer::where('video_id',$id)->delete();

            return $this->successMsg('is ok');
        }
        return $this->errorMsg('delete is fail',501);
    }
    
    /**
     * upload images
     * @param $file
     * @return bool
     */
    protected function upload($request)
    {

        $file = $request->file('thumbnail');

        if($file){
            if($file->isValid()){
                $ext = $file->getClientOriginalExtension();
                $tmpPath = $file->getRealPath();
                $fileName = date('Y-m-d') . '/' . uniqid() . '.' . $ext;
                $is_upload = Storage::disk('ftp')->put($fileName,file_get_contents($tmpPath));

                if($is_upload == false){
                    return false;
                }
                return $fileName;
            }else{
                return false;
            }
        }
        return false;
    }
}
