<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Redirect;

class CartController extends Controller
{
    public function add(Request $request){
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
            )
        ));
        return Redirect::back()->with('success_msg', 'Item is Added to Cart!');
    }

    public function cart()
    {
        $cartCollection = \Cart::getContent();
        return view('auth.cart', compact('cartCollection'));
    }
}
