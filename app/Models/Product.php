<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }
    // public function brand(){
    // 	return $this->belongsTo(Brand::class,'brand_id','id');
    // }
    public function unit(){
    	return $this->belongsTo(Unit::class,'unit_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }
    public function multi_imgs()
    {
        return $this->hasMany(MultiImg::class);
    }
   
}