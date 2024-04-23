<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
        'image'
    ];
    function product(){
        return $this->belongsTo(Product::class,'product_id','id')->orderByDesc('discount');
    }
}