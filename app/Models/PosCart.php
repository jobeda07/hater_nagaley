<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosCart extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function productStock(){
        return $this->belongsTo(ProductStock::class, 'stock_id');
    }
    public function attribute(){
        return $this->belongsTo(Attribute::class,'stock_id','id');
    }
}
