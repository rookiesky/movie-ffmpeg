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

        return $this->successMsg(
            'success',
            $program->isEmpty() ? null : (new ProgramTansform())->transformCollection($program->toArray())
            );
    }
}
