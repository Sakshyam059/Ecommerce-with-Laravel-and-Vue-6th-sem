<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

class AdminController extends Controller
{
    public function dashboard(){
        $product=Product::count();
            $orders=Order::where('payment_status','completed')->get();
            $totalorders=$orders->count();
            $deliveries=Order::where('payment_status','completed')->where('delivery_status',0)->count();
            $revenue=0;
            foreach($orders as $order){
                $revenue += $order['amount'];
            }
            return Inertia::render('Dashboard',compact('product','totalorders','deliveries','revenue'));
    }
    public function myProduct(){
        $products=Product::with('category')->with('sale')->get();
        return Inertia::render('Seller/Product/MyProducts',['products'=>$products]);
    }

    public function addProduct(){
        $categories=Category::all();
        return Inertia::render("Seller/Product/AddProduct",compact('categories'));
    }
    public function storeProduct(Request $request){
        $product=$request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'category_id'=>'required',
            'base_price'=>'required|string',
            'stock'=>'required|string',
            'image'=>['nullable','image','mimes:jpg,png'],
            'discount'=>'nullable',
            'discount_type'=>'nullable',
        ]);
        $product['total_price']=$request->base_price - $request->base_price*($request->discount/100);
       
        if($request->hasFile('image')){
            $file =$request->file('image');
            $fileName=$file->getClientOriginalName();
            $imagepath=time().'_'.$fileName;
            $file->move(public_path('images/product/'),$imagepath);
            $product['image']=$imagepath;
        }
        Product::create($product);
        return Redirect::route('myproducts');
    }

    public function editProduct(Request $request,$id){
        $product=Product::find($id);
        return Inertia::render('Seller/Product/EditProduct',compact('product'));
    }
    public function updateProduct(Request $request){
        $product=Product::find($request->id);
        $data=$request->validate([
            'name'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'base_price'=>'required',
            'stock'=>'required',
            'image'=>'required',
            'discount'=>'required',
            'discount_type'=>'required',
        ]);
        $data['total_price']=$request->base_price - $request->base_price*($request->discount/100);
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $image=time().'_'.$filename;
            $file->move(public_path('/images/product/'),$image);
            File::delete(public_path('/images/product/'.$product->image));
            $data['image']=$image;
        }
        $product->update($data);
        return Redirect::route('myproducts');
    }

    public function deleteProduct($id){
        $product=Product::find($id);
        $product->delete();
    }

    public function categories(){
        $categories=Category::get();
        return Inertia::render('Seller/Category/Categories',compact('categories'));
    }

    public function addCategory(Request $request){
        $category=$request->validate([
            'name'=>'string'
        ]);
        Category::create($category);

    }

    public function editCategory($id){
        $categories=Category::all();  
        $category=Category::find($id);  
        return Inertia::render('Seller/Category/Categories',compact('categories','category'));

    }

    public function updateCategory(Request $request,$id){
        $category=Category::find($id);
        $data=$request->validate([
            'name'=>'string'
        ]);
        $category->update($data);
    }


    public function deleteCategory($id){
        $category=Category::find($id);
        $category->delete();
    }

    public function salesAdmin(){
        $sales=Sale::with('product')->get();
        return Inertia::render('Seller/Sales/MySales',compact('sales'));
    }
    public function orders(){
        $orders=Order::where('payment_status','completed')->with('product')->with('destination')->get();
        return Inertia::render('Seller/Order/Orders',compact('orders'));
    }
}
