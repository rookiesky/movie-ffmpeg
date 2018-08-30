<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoTagsController extends Controller
{
    public $menuModel = 'video';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * video tag view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tagMenu = 'active';

        $tags = VideoTag::orderBy('id','desc')->paginate(20);
        return view('admin.video.tag',compact(['tags','tagMenu']));
    }

    /**
     * show video tag
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is empty');
        }

        $data = VideoTag::find($id);

        if($data){
            return $this->successMsg('success',$data->toArray());
        }else{
            return $this->errorMsg('video tag is not exist');
        }
    }

    /**
     * @param $id video tag id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is empty',404);
        }

        $result = VideoTag::find($id);

        if(!$result){
            return $this->errorMsg('video tag is not exits',404);
        }

        if($result->delete()){
            return $this->successMsg('is ok');
        }else{
            return $this->errorMsg('destroy failure');
        }
    }

    /**
     * create and update video tag
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required'
        ]);

        $title = $request->only(['title']);

        $id = $request->get('id');

        if($id){
            $result = VideoTag::where('id',$id)->update($title);
        }else{
            $result = VideoTag::create($title);
        }

        if($result){
            return $this->successMsg('is ok');
        }else{
            return $this->errorMsg('submit is failure');
        }
    }

}
