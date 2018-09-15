<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Date: 2018/8/27
 * Time: 16:46
 */

namespace App\Transformers;


class VideoTansfrom
{
    public function transform($items)
    {
        return collect($items)->map(function ($val){
            return [
                'link_id' => $val->id,
                'title' => $val->name,
                'length' => $val->time_limit,
                'thumb' => cache('system_base')->imgServer . $val->thumbnail,
                'pixel' => $val->pixelForm()[$val->pixel],
                'click' => $val->view,
                'create_time' => $val->updated_at->format('Y-m-d'),
                ];
        });
    }

    public function playTransform($item)
    {

        return [
            'link_id' => $item->id,
            'title' => $item->name,
            'thumb' =>  cache('system_base')->imgServer . $item->thumbnail,
            'click' => $item->view,
            'link' => $item->link,
            'point' => $item->point,
            'create_time' => $item->updated_at->format('Y-m-d'),
            'server' => (new ServerTansform())->transformCollection($item->servers->toArray()),
            'server_link' => $item->servers->toArray()[0]['site'],
            'collect' => $item->collect()
        ];
    }
}