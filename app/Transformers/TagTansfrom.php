<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/8/30
 * Time: 18:36
 */

namespace App\Transformers;


class TagTansfrom extends BaseTransformer
{
    public function transform($item)
    {
        return [
            'links_id' => $item['id'],
            'name' => $item['title']
        ];
    }
}