<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function login()
    {
        return view('home.auth.login');
    }

    public function signup()
    {
        return view('home.auth.signup');
    }

    public function forget()
    {
        return view('home.auth.forget');
    }

}
