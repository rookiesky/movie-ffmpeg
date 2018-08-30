<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/8/27
 * Time: 16:06
 */

namespace App\Transformers;


class SortTansform extends BaseTransformer
{
    public function transform($item)
    {
        return [
            'link_id' => $item['id'],
            'title' => $item['name']
        ];
    }

    public function homeSortTransform($items)
    {
        return collect($items)->map(function ($item){
            return [
                'link_id' => $item->id,
                'title' => $item->name,
                'video' => (new VideoTansfrom())->transform($item->homeListVideo)
            ];
        });
    }
}