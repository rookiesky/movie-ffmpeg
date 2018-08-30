<?php

namespace App\Http\Controllers;

use App\Tools\MessageApi;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, MessageApi;

    public $menuModel;
    /**
     * Controller constructor.
     */
    public function __construct()
    {
        \View::share('menuModel',[$this->menuModel => 'active']);
    }
}
