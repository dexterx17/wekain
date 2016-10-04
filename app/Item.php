<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    protected $fillable = [
        'item','descripcion','web','fuente','google_id','wiki_url','hashtag','user_id'
    ];

    /**
     * Usuario que creo el Item
     * @return App\User     objeto tipo User
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Una item tiene varias categorias
     * @return [App\Categoria]   Array de objetos tipo Categoria
     */
    public function categorias(){
        return $this->belongsToMany('App\Categoria')->withTimestamps();
    }

    /**
     * Una item tiene varias actividades
     * @return [App\Actividad]   Array de objetos tipo Actividad
     */
    public function categorias(){
        return $this->belongsToMany('App\Actividad')->withTimestamps();
    }
}
