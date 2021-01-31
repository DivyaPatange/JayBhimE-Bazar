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
            // 'size' => $request->size,
            'attributes' => array(
                'size' => $request->size,
                'image' => $request->img,
            )
        ));
        return Redirect::back()->with('success_msg', 'Item is Added to Cart!');
    }

    public function cart()
    {
        $cartCollection = \Cart::getContent();
        // dd($cartCollection);
        return view('auth.cart', compact('cartCollection'));
    }

    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function update(Request $request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
    }
    public function clear(){
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }
}
