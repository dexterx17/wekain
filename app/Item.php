<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    protected $fillable = [
        'item','descripcion','web','fuente','google_id','wiki_url','hashtag','user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function categorias(){
        return $this->belongsToMany('App\Categoria')->withTimestamps();
    }
}
