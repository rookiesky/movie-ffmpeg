<?php

namespace App\Http\Controllers\Admin;

use App\Models\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    public $menuModel = 'system';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * system view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sysActive = 'active';

        return view('admin.system.system',compact(['sysActive']));
    }

    /**
     * create and update system
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'website' => 'required',
            'url' => 'required'
        ]);
        $data = $request->only(['website','url','email','count','imgServer']);

        $model = new System();

        $system = $model::first();

        if($system){
            $result = $model->where('id',$system->id)->update($data);
        }else{
            $result = $model->create($data);
        }

        if($result){

            $model->forgetCache();
            return redirect()->back();
        }
        return redirect()->back()->withErrors('更新失敗');
    }

}
