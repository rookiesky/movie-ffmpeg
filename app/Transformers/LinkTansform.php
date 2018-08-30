<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/8/28
 * Time: 16:20
 */

namespace App\Transformers;


class LinkTansform extends BaseTransformer
{
    public function transform($item)
    {
        return [
            'name' => $item['name'],
            'link' => $item['url']
        ];
    }

}