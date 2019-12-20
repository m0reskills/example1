<?php

namespace App\Entity\Order;

use App\Entity\Product\Product;
use App\Entity\User\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'city',
        'postcode',
        'phone',
        'delivery',
        'discount',
        'discount_code',
        'cart_total',
        'status',
    ];
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function products ()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
