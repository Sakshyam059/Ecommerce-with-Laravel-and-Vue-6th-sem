<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    function orders(){
        return $this->belongsTo(Order::class);
    }
    function sale(){
        return $this->belongsTo(Sale::class,'id','product_id');
    }


}
