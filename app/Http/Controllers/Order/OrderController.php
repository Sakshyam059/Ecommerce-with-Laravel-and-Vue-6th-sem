<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::where('user_id',auth()->user()->id)->with('product')->with('destination')->get();
        return Inertia::render('Order/MyOrders',compact('orders'));
    }
   
}
