<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::all();

        return response([$orders], 201);
    }

    public function checkoutItem(Request $request, $id)
    {
    }

    public function processOrder($id)
    {
    }

    public function removeOrder($id)
    {
    }
}
