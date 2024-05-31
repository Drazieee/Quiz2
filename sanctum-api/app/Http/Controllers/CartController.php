<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart($id)
    {
        $cart = Cart::where("user_id", $id)->get();

        return response([$cart], 201);
    }

    public function addItemCart($id)
    {
    }

    public function updateQuantityItem(Request $request, $id)
    {
    }

    public function removeItemCart($id)
    {
    }
}
