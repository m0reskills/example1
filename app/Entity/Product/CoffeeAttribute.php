<?php

namespace App\Entity\Product;

use Illuminate\Database\Eloquent\Model;

class CoffeeAttribute extends Model
{
    public $fillable = [
        'product_id',
        'arabica_percent',
        'robusta_percent',
        'origin',
        'bitterness',
        'density',
        'strong',
        'aroma',
        'uses'
    ];
    public function products ()
    {
        return $this->belongsTo(Product::class);
    }
}
