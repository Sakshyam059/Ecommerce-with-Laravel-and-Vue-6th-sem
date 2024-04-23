<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function category(Request $request){
        $categories=Category::all();
        $category_name=$request->name;
        $category=Category::where('name',$category_name)->first();
        $products=Product::where('category_id',$category->id)->with('category')->get();
        return Inertia::render('Product/Category/CategoryProduct',compact('products','categories','category_name'));
    }
}
