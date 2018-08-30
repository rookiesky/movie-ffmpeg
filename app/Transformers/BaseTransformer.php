<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/8/27
 * Time: 16:03
 */

namespace App\Transformers;


abstract class BaseTransformer
{
    public function transformCollection($items){
        return array_map([$this,'transform'],$items);
    }

    public abstract function transform($item);
}