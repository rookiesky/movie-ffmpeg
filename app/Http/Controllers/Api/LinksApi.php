<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use App\Transformers\LinkTansform;
use App\Http\Controllers\Controller;

class LinksApi extends Controller
{
    /**
     * get link list
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $links = Link::orderBy('sort')->get();

        if($links->isEmpty()){
            return $this->errorMsg('links is empty',404);
        }

        return $this->successMsg('success',
            (new LinkTansform())->transformCollection($links->toArray())
            );
    }
}
