<?php

namespace App\Transformers;

use App\Item;

use League\Fractal\TransformerAbstract;

class ItemsTransformer extends TransformerAbstract
{
    public function transform(Item $item)
    {
        return [
            'id'        => (int) $item->id,
            'item'      => ucfirst($item->item),
            'descripcion'     => ucfirst($item->descripcion),
            'web'      => $item->web,
            'fuente'      => $item->fuente,
            'google_id'      => $item->google_id,
            'wiki_url'      => $item->wiki_url,
            'hashtag'      => $item->hashtag,
            'owner'     => (int)$item->user_id,
            //'delicious' => (bool) $item->delicious,
        ];
    }
}
