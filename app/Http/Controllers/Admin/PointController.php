<?php

namespace App\Http\Controllers\Admin;

use App\Models\Point;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PointController extends Controller
{

    public $menuModel = 'finance';

    public $pointMenu = 'active';

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
        $pointMenu = $this->pointMenu;
        $point = Point::get();
        return view('admin.point.index',compact(['pointMenu','point']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.point.create');
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
            'summary' => 'required',
            'point' => 'required',
            'money' => 'required'
        ]);

        $data = $request->only(['title','summary','point','money']);

        $id = $request->get('id');

        $model = new Point();

        if($id){
            $result = $model->where('id',$id)->update($data);
        }else{
            $result = $model->create($data);
        }

        if($result){
            return redirect('/setAdmin/point');
        }else{
            return redirect()->back()->withErrors('提交錯誤');
        }

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

        $info = Point::find($id);

        if(empty($info)){
            return redirect()->back();
        }

        $pointMenu = $this->pointMenu;
        return view('admin.point.create',compact(['pointMenu','info']));
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
            return $this->errorMsg('id is empty',404);
        }

        $point = Point::find($id);

        if(empty($point)){
            return $this->errorMsg('point is exits',404);
        }

        if($point->delete()){
            return $this->successMsg('success');
        }
        return $this->errorMsg('delete error',502);
    }
}
