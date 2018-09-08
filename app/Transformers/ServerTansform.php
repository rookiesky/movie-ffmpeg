<?php
namespace App\Transformers;

class ServerTansform extends BaseTransformer
{
    public function transform($item)
    {
        return [
            'title' => $item['name'],
            'link' => $item['site']
        ];
    }
}