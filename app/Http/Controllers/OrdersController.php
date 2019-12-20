<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class OrdersController extends Controller
{

    public function index(): View
    {
        $orders = auth()->user()->orders()->with('products')->get();
        return view('dashboard.orders')->with('orders', $orders);
    }
}
