<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='categories';
    protected $fillable = [
        'fbin', 'name', 'image','icon','parent_id', 'last_child', 'is_deleted',
    ];

    public function parent_details()
    {
        return $this->hasOne('App\Category', 'id', 'parent_id');
    }

    public function child()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id');

    }
    public function category_details()
    {
        return $this->hasMany('App\CategorySpecification', 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasManyThrough(
            'App\Variation',
            'App\Product',
            'category_id', // Foreign key on Product table...
            'parent_product_id', // Foreign key on Variation table...
            'id', // Local key on Category table...
            'id' // Local key on Product table...
        );
    }
}
