<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoSort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SortController extends Controller
{
    public $menuModel = 'video';
    /**
     * SortController constructor.
     */
    public function __construct()
    {
        \View::share('sortMenu','active');
        parent::__construct();
    }

    /**
     * video sort list view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $sort = VideoSort::orderBy('sort')->paginate(15);
        return view('admin.sort.index',compact('sort'));
    }

    /**
     * add video sort view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('admin.sort.add');
    }

    /**
     * video sort edit view
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id)
    {
        if(empty($id)){
            return redirect('/setAdmin/video/sort');
        }
        $sort = VideoSort::find($id);
        return view('admin.sort.add',compact('sort'));
    }

    /**
     *  add and edit video sort
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'sort' => 'required',
        ]);

        $data = $request->only(['name','sort']);
        $data['is_home'] = $request->get('is_home') ?? 0;

        if($request->has('id')){
            $result = VideoSort::where('id',$request->get('id'))
                ->update($data);
        }else{
            $result = VideoSort::create($data);
        }

        if($result){
            return redirect('/setAdmin/video/sort');
        }else{
            return redirect()->withErrors('提交失敗！')->withInput();
        }

    }

    /**
     * destroy
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(empty($id)){
            return $this->errorMsg('sort id can not be empty');
        }
        $result = VideoSort::find($id);

        if(!$result){
            return $this->errorMsg('do not have this is sort',404);
        }

        if($result->delete()){
            return $this->successMsg('success');
        }else{
            return $this->errorMsg('delete error',501);
        }
    }
    
}
