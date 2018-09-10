<?php

namespace App\Http\Controllers\Admin;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public $menuModel = 'finance';

    public $program = 'active';

    /**
     * ProgramController constructor.
     *
     */
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
        $program = $this->program;
        $info = Program::orderBy('created_at','desc')->get();
        return view('admin.program.index',compact(['program','info']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $program = $this->program;
        return view('admin.program.create',compact(['program']));
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
            'total' => 'required',
            'sales' => 'required'
        ]);

        $data = $request->only(['title','summary','total','sales','time']);

        $id = $request->get('id');

        $model = new Program();

        if($id){
            $result = $model->where('id',$id)->update($data);
        }else{
            $result = $model->create($data);
        }

        if($result){
            return redirect('/setAdmin/program');
        }else{
            return redirect()->back()->withErrors('提交失敗');
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
        $info = Program::find($id);

        if(empty($info)){
            return redirect()->back();
        }

        $program = $this->program;
        return view('admin.program.create',compact(['program','info']));
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

        $info = Program::find($id);

        if(empty($info)){
            return $this->errorMsg('program is exits');
        }

        if($info->delete()){
            return $this->successMsg('success');
        }else{
            return $this->errorMsg('delete error',501);
        }
    }
}
