<?php

namespace App\Transformers;

use App\Categoria;

use League\Fractal\TransformerAbstract;

class CategoriasTransformer extends TransformerAbstract
{
    public function transform(Categoria $categoria)
    {
        return [
            'id'        => (int) $categoria->id,
            'categoria'      => ucfirst($categoria->categoria),
            'slug'      => $categoria->slug,
            'descripcion'     => ucfirst($categoria->descripcion),
            'icono'     => $categoria->icono,
            'owner'     => (int)$categoria->user_id,
            'parent'     => (int)$categoria->categoria_id,
            //'delicious' => (bool) $categoria->delicious,
        ];
    }
}