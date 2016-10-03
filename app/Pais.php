<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table ="paises";

    protected $fillable = [
        'pais','short_name','continente','descripcion',
        'bandera_url','escudo_url','zipcode','lat','lng',
        'zoom','n_items'
    ];

    public $timestamps = false;
}
