<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(){
        $products=Product::all();
        $categories=Category::all();
        if(empty(Banner::count())){
            return Inertia::render('Welcome',compact('products','categories'));
        }else{
            $banners=Banner::OrderBy('id','desc')->with('category')->get();
            $otherbanners=Banner::OrderBy('id','desc')->with('category')->limit(2)->get();
            return Inertia::render('Welcome',compact('products','categories','banners','otherbanners'));
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
    public function success(){
        return Inertia::render('Payment/Success');
    }
}