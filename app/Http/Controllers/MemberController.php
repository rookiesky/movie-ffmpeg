<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userMenus = 'active';
        $user = \Auth::user();
        $notices = Notice::orderBy('id','desc')->limit(4)->get();

        return view('home.member.index',compact(['user','notices','userMenus']));
    }


    public function userInfo()
    {
        $userInfoMenu = 'active';
        $user = \Auth::user();

        return view('home.member.user_info',compact(['userInfoMenu','user']));
    }

    public function collects()
    {
        $collectMenu = 'active';

        $collects = User::where('id',\Auth::user()->id)->first()->collects()->orderBy('id','desc')->paginate(8);

        $imgServer = cache('system_base')->imgServer;

        return view('home.member.collect',compact(['collectMenu','collects','imgServer']));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
