<?php

namespace App\Transformers;

use App\Tip;

use League\Fractal\TransformerAbstract;

class TipsTransformer extends TransformerAbstract
{
    public function transform(Tip $tip)
    {
        return [
            'id'        => (int) $tip->id,
            'tip'      => ucfirst($tip->tip),
            'slug'      => $tip->slug,
            'descripcion'     => ucfirst($tip->descripcion),
            'icono'     => $tip->icono,
            'owner'     => (int)$tip->user_id,
            //'delicious' => (bool) $tip->delicious,
        ];
    }
}
