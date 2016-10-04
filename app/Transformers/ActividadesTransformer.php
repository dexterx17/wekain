<?php

namespace App\Transformers;

use App\Actividad;

use League\Fractal\TransformerAbstract;

class ActividadesTransformer extends TransformerAbstract
{
    public function transform(Actividad $actividad)
    {
        return [
            'id'        => (int) $actividad->id,
            'actividad'      => ucfirst($actividad->actividad),
            'slug'      => $actividad->slug,
            'descripcion'     => ucfirst($actividad->descripcion),
            'icono'     => $actividad->icono,
            'owner'     => (int)$actividad->user_id,
            //'delicious' => (bool) $actividad->delicious,
        ];
    }
}
