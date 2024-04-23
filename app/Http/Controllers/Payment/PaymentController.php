<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function index(){
        return Inertia::render('Payment/Payment');
    }

    public function khaltiPayment(Request $request)
    {
        $products=$request->products;
        $return_url = "http://127.0.0.1:8000/epayment/verify";
        $website_url = "http://127.0.0.1:8000";
        $khalti = 'https://a.khalti.com/api/v2/';
        $order_id = $request->purchase_order_id;

        $order_amount=$request->total_amount;
        $amount=$order_amount*100;
        
        $order=$request->validate([
            'user_id'=>'integer',
            'product_id'=>'nullable',
            'destination_id'=>'required',
            'payment_status'=>'nullable',
        ]);
        $payment=$request->validate([
            'user_id'=>'integer',
            'product_id'=>'nullable',
            'payment_status'=>'nullable',
        ]);
        
        $data = ([
            "return_url"=> $return_url,
            "website_url"=> "https://example.com/",
            "amount"=> $amount,
            "purchase_order_id"=> 11,
            "purchase_order_name"=> "test",
            'user_id'=>'integer',
            'product_id'=>'nullable',
            'payment_status'=>'nullable',
        ]);
        
        $response = Http::withHeaders([
                'Authorization' => 'key 044b7ae87946412c923ddaa2923c84fd',
                'Content-Type'=> 'application/json',
        ])->post($khalti."epayment/initiate/", $data);

        $request->session()->forget('orders');
        foreach ($products as $product) {
            $order['user_id']=auth()->user()->id;
            $order['ref_id']=$response['pidx'];
            $order['product_id']=$product['product_id'];
            $order['amount']=$product['total_price'];
            Session::push('orders', $order);
        }      
        return Inertia::location($response['payment_url']);
    }

    public function verifyPayment(Request $request){

        $khalti = 'https://a.khalti.com/api/v2/';

        $pidx = $request->pidx;
        $amount=0;
        $data = ([
            "pidx"=> $pidx,
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'key 044b7ae87946412c923ddaa2923c84fd',
            'Content-Type'=> 'application/json',
        ])->post($khalti."epayment/lookup/", $data);
        if($response['status']=="Completed"){
            $orders=Session::get('orders');
            foreach($orders as $order){
                $order['payment_status']=$response['status'];
                $orderdata[]=Order::updateOrCreate([
                    'product_id' => $order['product_id'],
                    'ref_id'=>$response['pidx'],
                ],$order);
            }
            foreach ($orderdata as $data) {
                $payment['user_id']=auth()->user()->id;
                $payment['ref_id']=$response['pidx'];
                $payment['product_id']=$data['product_id'];
                $payment['amount']=$data['amount'];
                $payment['payment_status']=$response['status'];
                $payment['payment_mode']='Khalti';
                $payment['request_date']=Carbon::now();
                $payments[]=Payment::updateOrCreate([
                    'ref_id'=>$response['pidx'],
                    'product_id' => $data['product_id'],
                ],$payment);
                $amount+=$data['amount'];            
                
                $product=Product::find($data['product_id']);
                $product->stock=$product['stock']-1;
                $product->update();
                
                $request->session()->forget('orders');
            }
            
            return Inertia::render('Payment/Success',compact('amount'));
        }
        else{
            return Redirect::route('welcome');
        }
    }
    public function success(){
        $order=Order::where("payment_status","failed")->first();
        dd($order);
        return Inertia::render('Payment/Success');
    }
}
