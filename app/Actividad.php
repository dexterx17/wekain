<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Actividad extends Model
{
    use Sluggable;

    protected $table = "actividades";

    protected $fillable = ['actividad','descripcion','user_id','icono','slug'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'actividad'
            ]
        ];
    }

    /**
     * Usuario que creo la actividad
     * @return App\User     objeto tipo User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Una actividad tiene varios Items
     * @return [App\Item]   Array de objetos tipo Item
     */
    public function items()
    {
        return $this->belongsToMany('App\Item')->withTimestamps();
    }
}
