<?php

namespace App\Http\Controllers\Admin;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinksController extends Controller
{
    public $menuModel = 'links';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * links view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $links = Link::orderBy('sort')->paginate(15);
        return view('admin.links.index',compact('links'));
    }

    /**
     * destroy link
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is empty',404);
        }

        $link = Link::find($id);

        if(!$link){
            return $this->errorMsg('link is not exist',404);
        }

        if($link->delete()){
            return $this->successMsg('success');
        }

        return $this->errorMsg('delete link is fail',502);

    }

    /**
     * find link
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function find($id)
    {
        if(empty($id)){
            return $this->errorMsg('id is empty',404);
        }

        $link = Link::find($id);

        if($link){
            return $this->successMsg('success',$link->toArray());
        }
        return $this->errorMsg('link is not exist',404);
    }

    /**
     * create and update link
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'url' => 'required'
        ]);

        $data = $request->only(['name','url','sort']);
        $id = $request->get('id');

        if($id){
            $result = Link::where('id',$id)->update($data);
        }else{
            $result = Link::create($data);
        }

        if($result){
            return $this->successMsg('success');
        }
        return $this->errorMsg('submit fail',502);
    }

}
