<?php

namespace App\Http\Controllers\Admin;

use App\Models\SystemServer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServerController extends Controller
{
    public $menuModel = 'system';

    public function __construct()
    {
        \View::share('serverMenu','active');
        parent::__construct();
    }

    /**
     * server list view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $server = SystemServer::orderBy('id','desc')->paginate(15);
        return view('admin.system.server',compact('server'));
    }

    /**
     * server create view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.system.create_and_edit_server');
    }

    /**
     * server edit view
     * @param $id server id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id)
    {
        if(empty($id)){
            return redirect('/setAdmin/home');
        }

        $server = SystemServer::find($id);

        if(!$server){
            return redirect('/setAdmin/home');
        }
        return view('admin.system.create_and_edit_server',compact('server'));
    }

    /**
     * create and update server
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'site' => 'required',
        ]);

        $data = $request->only(['name','site']);
        $data['is_active'] = $request->has('is_active') ?? 0;

        if($request->has('id')){
            $result = SystemServer::where('id',$request->get('id'))
                ->update($data);
        }else{
            $result = SystemServer::create($data);
        }
        
        if($result){
            return redirect('/setAdmin/system/server');
        }else{
            return redirect()->withErrors('提交失败')->withInput();
        }
    }

    /**
     * destroy server
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is not empty',404);
        }

        $server = SystemServer::find($id);

        if(!$server){
            return $this->errorMsg('server not exist',404);
        }

        if($server->delete()){
            return $this->successMsg('delete success');
        }else{
            return $this->errorMsg('delete failure');
        }
    }
}
