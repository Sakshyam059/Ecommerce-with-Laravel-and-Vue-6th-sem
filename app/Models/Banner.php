<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'image'
    ];
    function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
