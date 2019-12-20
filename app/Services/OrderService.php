<?php


namespace App\Services;

use App\Entity\Order\Order;
use App\Entity\Order\OrderProduct;
use App\Mail\OrderPlaced;
use Mail;

class OrderService
{

    public function createOrder($request, $discount, $code, $total)
    {
       return Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'delivery' => $request->delivery,
            'discount' => $discount,
            'discount_code' => $code,
            'cart_total' => $total,
        ]);
    }

    public function createOrderProducts($cart, $order): void
    {
    foreach ( $cart as $product ) {
        OrderProduct::create([
            'order_id' => $order->id,
            'product_id' => $product->model->id,
            'quantity' => $product->qty,
        ]);
    }
    }

    public function mailToCustomer($order): void
    {
        Mail::send(new OrderPlaced($order));
    }
}
