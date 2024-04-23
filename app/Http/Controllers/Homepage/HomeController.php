<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(){
        $products=Product::all();
        $categories=Category::all();
        if(empty(Sale::count())){
            return Inertia::render('Welcome',compact('products','categories'));
        }else{
            $sales=Sale::with('product')->get()->sortByDesc(function($sale) { 
                return $sale->product->discount;
           })->take(3);
            $othersales=Sale::OrderBy('id','desc')->with('product')->limit(2)->get();
            return Inertia::render('Welcome',compact('products','categories','sales','othersales'));
        }
    }
    public function home(){
        if(auth()->user()->role=='admin'){
            return Redirect::route('dashboard');
        }   
        else{       
            return Redirect::route('welcome');
        }
    }
    public function about(){
        return Inertia::render('About');
    }
}