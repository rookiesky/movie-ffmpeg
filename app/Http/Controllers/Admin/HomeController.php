<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/8/22
 * Time: 13:50
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public $menuModel = 'Home';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.home.index');
    }

}