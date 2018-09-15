<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{

    public $menuModel = 'system';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticeMenu = 'active';
        $notices = Notice::orderBy('id','desc')->paginate(20);

        return view('admin.notices.index',compact(['noticeMenu','notices']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $noticeMenu = 'active';

        return view('admin.notices.create_and_edit',compact('noticeMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required'
        ]);

        $data = $request->only(['title','content']);

        $id = $request->get('id');

        $model = new Notice();

        if($id){
            $result = $model->where('id',$id)->update($data);
        }else{
            $result = $model::create($data);
        }

        if($result){
            return redirect('/setAdmin/notices');
        }
        return redirect()->back()->withErrors('提交錯誤！');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(empty($id)){
            return redirect()->back();
        }

        $notice = Notice::find($id);

        if(empty($notice)){
            return redirect()->back();
        }

        $noticeMenu = 'active';

        return view('admin.notices.create_and_edit',compact(['noticeMenu','notice']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is empty');
        }
        $notice = Notice::find($id);

        if(empty($notice)){
            return $this->errorMsg('notice is exist');
        }

        if($notice->delete()){
            return $this->successMsg('success');
        }
        return $this->errorMsg('delete error',502);
    }
}
