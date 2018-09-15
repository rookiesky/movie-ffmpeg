<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/9/11
 * Time: 12:46
 */

namespace App\Transformers;


class ProgramTansform extends BaseTransformer
{
    public function transform($item)
    {
        return [
            'id' => $item['id'],
            'title' => $item['title'],
            'summary' => $item['summary'],
            'total' => (int) $item['total'],
            'money' => (int) $item['sales']
        ];
    }
}