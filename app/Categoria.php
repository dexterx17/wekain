<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Categoria extends Model
{
    use Sluggable;

    protected $primaryKey = 'id';

    protected $table = 'categorias';

    protected $fillable = ['categoria','descripcion','user_id','padre','icono','slug'];

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'categoria'
            ]
        ];
    }

    public function scopeSearch($query,$categoria)
    {
        return $query->where('categoria','LIKE',"%$categoria%");
    }

    /**
     * Usuario que creo la categoria
     * @return App\User     objeto tipo User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Una categoria tiene varios Items
     * @return [App\Item]   Array de objetos tipo Item
     */
    public function items()
    {
        return $this->belongsToMany('App\Item')->withTimestamps();
    }
}
