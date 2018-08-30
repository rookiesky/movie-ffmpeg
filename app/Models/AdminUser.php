<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    public $table = 'admin_users';

    public $fillable = ['username','password'];

    protected $rememberTokenName = '';
}
