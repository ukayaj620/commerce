<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    private function init_cart($user_id)
    {
        $cart = Cart::where('user_id', '=', $user_id)->first();
        if ($cart->count() != 1) {
            $cart = Cart::create([
                'user_id' => $user_id
            ]);
        }

        return $cart;
    }

    public function product_detail($id)
    {
        $product = Product::find($id);
        return view('client.product.view', [
            'product' => $product
        ]); 
    }

    public function create(Request $request)
    {
        $id = Auth::user()->id;
        $cart = $this->init_cart($id);

        $cart->products()->attach($request->input('product_id'), ['qty' => $request->input('qty')]);

        print_r($cart);
    }
}
