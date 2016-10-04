<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tip extends Model
{
    use Sluggable;

    protected $table = "tips";

    protected $fillable = [
        'tip','descripcion','user_id','icono','slug'
    ];

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'tip'
            ]
        ];
    }

    /**
     * Usuario que creo el Tip
     * @return App\User     objeto tipo User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Un tip tiene varios Items
     * @return [App\Item]   Array de objetos tipo Item
     */
    public function items()
    {
        return $this->belongsToMany('App\Item')->withTimestamps();
    }
}
