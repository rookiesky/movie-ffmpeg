<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Transformers\VideoTansfrom;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index($id)
    {
        if(empty($id)){
            return redirect('/');
        }

        return view('home.video.play',compact('id'));
    }
}
