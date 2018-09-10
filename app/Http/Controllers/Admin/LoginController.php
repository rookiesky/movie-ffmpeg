<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/8/21
 * Time: 20:20
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * admin user view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.login.index');
    }

    /**
     * admin login logic
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|min:4|max:10',
            'password' => 'required|min:6|max:10',
        ]);

        $user = $request->only(['username','password']);

        if( Auth::guard('admin')->attempt($user) ){
             return redirect('setAdmin/home');
        }
        return redirect()->back();
    }

    /**
     * admin user logout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        return redirect('setAdmin/login');
    }

}