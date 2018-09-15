<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class MemberApi extends Controller
{
    public function editUsername(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|min:4|max:15',
            'password' => 'required|min:6|max:10'
        ]);

        $name = $request->get('username');

        $verify['email'] = \Auth::user()->email;
        $verify['password'] = $request->get('password');

        if($this->verifyUserPassword($verify) == false){
            return $this->errorMsg('密碼錯誤！');
        }

        if(User::where('email',$verify['email'])->update(['name'=>$name])){
            return $this->successMsg('暱稱修改成功');
        }
        Log::error('用戶暱稱修改失敗！');
        return $this->errorMsg('操作失敗！',502);
    }


    public function editPassword(Request $request)
    {
        $this->validate($request,[
            'password' => 'required|confirmed|min:6|max:10',
            'oldpassword' => 'required|min:6|max:10'
        ],[
            'password.confirmed' => '兩次密碼不一致',
            'oldpassword.required' => '旧密碼不能為空',
            'oldpassword.min' => '旧密碼不能小於6位',
            'oldpassword.max' => '旧密碼不能大於10位'
        ]);

        $verify['email'] = \Auth::user()->email;
        $verify['password'] = $request->get('oldpassword');
        $password = $request->get('password');

        if($this->verifyUserPassword($verify) == false){
            return $this->errorMsg('密碼錯誤！');
        }

        if(User::where('email',$verify['email'])->update(['password'=>bcrypt($password)])){
            return $this->successMsg('修改成功');
        }
        Log::error('用戶修改密碼錯誤');
        return $this->errorMsg('操作失敗！');
    }


    public function verifyUserPassword(array $data)
    {
        if(\Auth::attempt($data)){
            return true;
        }
        return false;
    }

}
