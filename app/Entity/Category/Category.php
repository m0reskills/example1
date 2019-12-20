<?php

namespace App\Entity\Category;

use App\Entity\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function products ()
    {
        return $this->belongsToMany(Product::class);
    }
    public function children ()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function parentId ()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
