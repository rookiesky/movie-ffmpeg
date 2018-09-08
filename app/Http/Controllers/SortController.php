<?php

namespace App\Http\Controllers;

use App\Models\VideoSort;
use Illuminate\Http\Request;

class SortController extends Controller
{
    public function index($id)
    {
        $sort = VideoSort::find($id);
        if(empty($sort)){
            return redirect('/');
        }

        return view('home.sort.index');
    }
}
