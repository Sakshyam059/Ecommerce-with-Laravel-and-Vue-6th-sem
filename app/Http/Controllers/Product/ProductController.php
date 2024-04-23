<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

use function Termwind\render;

class ProductController extends Controller
{
    
    public function viewProduct(){
        $products=Product::all();
        return response()->json($products);
    }
    public function searchProduct(Request $request){
        $posts = Product::where('name', 'like', '%' . $request->keyword . '%')->limit(5)->get();
        return response()->json($posts);
    }

    public function searchResult(Request $request){
        $keyword=$request->keyword;
        $products = Product::where('name', 'like', '%' . $keyword . '%')->get();
        return Inertia::render("Product/Search/SearchResult",compact('products','keyword'));
    }
    public function index(){
        return Inertia::render('Product/ViewProducts');
    }

    public function addToCart(){
        return Inertia::render('Product/AboutProduct');
    }
    
    // public function findProduct($id){
    //     $product=Product::find($id);
    //     return response()->json($product);
    // 
    public function aboutProduct($id){
        $product=Product::where('id',$id)->with('category')->first();
        $reviews=Review::where('product_id',$id)->where('user_id','!=',auth()->user()->id)->with('user')->get();
        if(auth()->user()){
            $myreview=Review::where('user_id',auth()->user()->id)->where('product_id',$id)->with('user')->first();
            
        }else{
            $myreview=[];       
        }
        return Inertia::render('Product/AboutProduct',compact('product','myreview','reviews'));
    }
}
