<?php

namespace App\Entity\Category;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'category_product';

    protected $fillable = [
        'product_id',
        'category_id',
    ];
}
