<?php
namespace App\Transformers;

class ServerTansform extends BaseTransformer
{
    public function transform($item)
    {
        return [
            'title' => $item['name'],
            'link_id' => $item['id']
        ];
    }

    public function linkTransform($item)
    {
        return [
            'link' => $item['site'],
            'title' => $item['name']
        ];
    }
}