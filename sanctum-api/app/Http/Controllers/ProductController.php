<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::where('quantity', '!=', 0)->get();

        return response()->json($products, 200);
    }

    public function showProduct($id)
    {
        $product = Product::find($id);

        return response()->json($product, 200);
    }

    public function addProduct(Request $request)
    {
        $request->validate(
            [
                'user_id' => 'required',
                'productName' => 'required',
                'productDescription' => 'required',
                'productQuantity' => 'required|min:1',
                'price' => 'required',
            ]
        );

        Product::create([
            'user_id' => $request->user_id,
            'product_name' => $request->productName,
            'product_description' => $request->productDescription,
            'quantity' => $request->productQuantity,
            'price' => $request->price
        ]);

        return response(['message' => 'Product Added Successfully'], 201);
    }

    public function editProduct(Request $request, $id)
    {
        $request->validate([
            'productName' => 'required',
            'productDescription' => 'required',
            'quantity' => 'required|min:1',
            'price' => 'required',
        ]);

        $product = Product::where('product_id', $id)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update([
            'product_name' => $request->productName,
            'product_description' => $request->productDescription,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return response()->json(['message' => 'Successfully Updated'], 200);
    }

    public function removeProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json(['Successfully Removed Product'], 200);
    }

    public function filterLowPrice()
    {
        $products = Product::orderBy('price', 'asc')->get();
        
        return response()->json($products,200);
    }

    public function filterHighPrice()
    {
        $products = Product::orderBy('price', 'desc')->get();
        
        return response()->json($products,200);
    }
}
