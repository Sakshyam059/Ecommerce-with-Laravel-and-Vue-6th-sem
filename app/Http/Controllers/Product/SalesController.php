<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use Illuminate\Support\Facades\File;

class SalesController extends Controller
{
    public function index(){
        $sales=Sale::with('product')->get();
        return Inertia::render('Product/Sales/Sales',compact('sales'));
    }
    public function viewSaleForm(Request $request){
        $product=Product::find($request->id);
        $sale=Sale::where('product_id',$request->id)->first();
        return Inertia::render('Seller/Sales/AddSales',compact('product','sale'));
    }
    public function addSales(Request $request){
        $product=Product::find($request->product_id);
        $data=$request->validate([
            'discount'=>'required',
        ]);
        $product->total_price=$product['base_price'] - $product['base_price']*($request->discount/100);
      
        $product->discount=$data['discount'];
        $product->update();

        // $sale=Sale::where('product_id',$request->product_id)->get();
        $saledata=$request->validate([
            'product_id'=>'required',
            'image'=>'nullable|image|mimes:png,jpg',
        ]);
        $saledata['product_id']=$request->product_id;
         $sale = Sale::where('product_id', $request->product_id)->first();
         if(is_null($sale)) {
            if($request->hasFile('image')){
                $file =$request->file('image');
                $fileName=$file->getClientOriginalName();
                $imagepath=time().'_'.$fileName;
                $file->move(public_path('images/sale/'),$imagepath);
                $saledata['image']=$imagepath;
            }
                Sale::create($saledata);
             } else {
            if($request->hasFile('image')){
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $image=time().'_'.$filename;
                $file->move(public_path('/images/sale/'),$image);
                File::delete(public_path('/images/sale/'.$sale->image));
                $saledata['image']=$image;
            }
             $sale->update($saledata);
        }
        
        return Redirect::route('sales.admin');
    }
    
    public function deleteSale($id){
        $sale=Sale::find($id);
        $sale->delete();
    }
}
