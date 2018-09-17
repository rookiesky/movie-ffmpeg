<?php

namespace App\Http\Controllers\Api;

use App\Models\Program;
use App\Transformers\ProgramTansform;
use App\Http\Controllers\Controller;

class ProgramApi extends Controller
{
    public function get()
    {
        $program = Program::orderBy('sort','asc')->get();

        if($program->isEmpty()){
            return $this->errorMsg('暫時沒有方案');
        }

        return $this->successMsg(
            'success',
            $program->isEmpty() ? null : (new ProgramTansform())->transformCollection($program->toArray())
            );
    }
}
