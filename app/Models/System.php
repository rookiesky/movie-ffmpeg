<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class System extends Model
{
    public $fillable = ['website','url','email','count'];

    const CACHE_NAME = 'system_base';



    public function getCache()
    {
        return Cache::rememberForever(self::CACHE_NAME,function (){
            return DB::table($this->getTable())->first();
        });
    }

    /**
     * destroy system cache
     */
    public function forgetCache()
    {
        Cache::forget(self::CACHE_NAME);
        $this->getCache();
    }
}
