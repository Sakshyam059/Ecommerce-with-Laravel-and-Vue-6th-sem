<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CartController extends Controller
{
    public function myCart(Request $request){ 
        $carts=$request->cart;
        $product_list=[];
        if($carts){
            foreach($carts as $cart){
                $product[]=$cart['id'];
                $product_list=array_merge($product_list,$product);
            }
        }
        $cart_products=Product::findMany($product_list);
        $destinations=Destination::all();
        return Inertia::render('Cart/MyCart',compact('cart_products','destinations'));
    }
    public function cartProducts(Request $request){
        $carts=$request->cart;
        $product_list=[];
        if($carts){
            foreach($carts as $cart){
                $product[]=$cart['product_id'];
                $product_list=array_merge($product_list,$product);
            }
        }
        $cart_products=Product::findMany($product_list);
        return response()->json($cart_products);
    }
    public function testcart(Request $request){
        $cart=Session::push('cart',$request->prdouct_id);
        dd($cart);
    }
}
