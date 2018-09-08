<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransCodeing extends Model
{
    public $table = 'transcodeing';

    public $fillable = ['host','port','username','password','file_path'];
}
