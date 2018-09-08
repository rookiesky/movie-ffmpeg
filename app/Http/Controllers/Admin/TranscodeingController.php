<?php

namespace App\Http\Controllers\Admin;

use App\Models\TransCodeing;
use App\Tools\SshConnect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TranscodeingController extends Controller
{

    public $menuModel = 'transcode';

    /**
     * TranscodeingController constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {

        $transMenu = 'active';
        $server = TransCodeing::first();

        return view('admin.transcodeing.index',compact(['transMenu','server']));

    }

    public function codeRun()
    {
        $result = (new \App\Http\Controllers\Api\Transcodeing())->codeingRun();
        dd($result);
    }

    public function trancodeing()
    {
        $transCodeMenu = 'active';
        $menuModel['transcode'] = 'active';
        $trans = (new \App\Http\Controllers\Api\Transcodeing())->transcodeList();

        return view('admin.transcodeing.list',compact(['trans','transCodeMenu','menuModel']));
    }


    /**
     * create and update server
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'host' => 'required',
            'port' => 'required|integer',
            'username' => 'required',
            'password' => 'required',
            'file_path' => 'required'
        ]);

        $data = $request->only(['host','port','username','password','file_path']);

        $model = new TransCodeing();

        $server = $model::first();

        if($server){
            $id = $request->get('id');
            $result = $model::where('id',$id)->update($data);
        }else{
            $result = $model::create($data);
        }

        if($result){
            return redirect('/setAdmin/transcodeing');
        }

        return redirect()->back()->withErrors('submit error');
    }
}
