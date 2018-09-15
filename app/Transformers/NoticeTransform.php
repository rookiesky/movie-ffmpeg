<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/9/15
 * Time: 13:37
 */

namespace App\Transformers;


class NoticeTransform extends BaseTransformer
{

    public function transform($item)
    {
        return [
            'title' => $item['title'],
            'content' => $item['content']
        ];
    }

}