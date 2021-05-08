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
        if ($cart == NULL) {
            $cart = Cart::create([
                'user_id' => $user_id
            ]);
        }

        return $cart;
    }

    public function fetch()
    {
        $user_id = Auth::user()->id;
        $cart = $this->init_cart($user_id);
        

        return view('client.cart.index', [
            'url' => 'user',
            'cart' => $cart,
            'is_empty' => $cart->products()->count() == 0
        ]);
    }

    public function fetch_detail($id)
    {
        $user_id = Auth::user()->id;
        $cart = $this->init_cart($user_id);
        $product = $cart->products()->where('product_id', $id)->first();
        return view('client.cart.detail', [
            'product' => $product,
            'url' => 'user'
        ]); 
    }

    public function product_detail($id)
    {
        $product = Product::find($id);
        return view('client.product.view', [
            'product' => $product,
            'url' => 'user'
        ]); 
    }

    public function add_product(Request $request)
    {
        $request->validate(
            [
                'product_id' => 'required',
                'quantity' => 'required'
            ]
        );

        $id = Auth::user()->id;
        $cart = $this->init_cart($id);

        $current_cart = $cart->products()->where('product_id', $request->input('product_id'))->first();
        if ($current_cart != NULL) {
            $cart->products()->updateExistingPivot(
                $request->input('product_id'), 
                ['qty' => (int)$current_cart->pivot->qty + (int)$request->input('quantity')]
            );
        } else {
            $cart->products()->attach($request->input('product_id'), ['qty' => $request->input('quantity')]);
        }


        return redirect(route('cart.fetch'));
    }

    public function update_product(Request $request)
    {
        $id = Auth::user()->id;
        $cart = $this->init_cart($id);
        $cart->products()->updateExistingPivot($request->input('product_id'), ['qty' => $request->input('quantity')]);
    
        return redirect(route('cart.fetch'));
    }

    public function remove_product($product_id)
    {
        $id = Auth::user()->id;
        $cart = $this->init_cart($id);
        $cart->products()->detach($product_id);

        return redirect(route('cart.fetch'));
    }
}
