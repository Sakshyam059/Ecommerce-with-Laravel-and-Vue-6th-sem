<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }
    function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    function destination(){
        return $this->belongsTo(Destination::class,'destination_id','id');
    }
}
