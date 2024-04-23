<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function addReview(Request $request){
        $data=$request->validate([
            'product_id'=>'required',
            'rating'=>'required',
            'review'=>'required|string',
        ]);
        $data['user_id']=auth()->user()->id;
        Review::updateOrCreate([
            'user_id' => auth()->user()->id
        ],$data);
        $ratings=Review::where('product_id',$request->product_id)->get();
        $allrating=0;
        foreach ($ratings as $rating) {
            $allrating=$allrating+$rating->rating;
        }
        $avgrating=$allrating/count($ratings);

        $product=Product::find($request->product_id);
        $product->rating=$avgrating;
        $product->update();
    }

    public function deleteReview($id){
        $review=Review::find($id);
        $review->delete();
    }
}
