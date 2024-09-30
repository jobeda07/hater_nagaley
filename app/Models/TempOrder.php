<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public function division(){
        return $this->belongsTo(Division::class,'division_id','id');
    }

    public function district(){
        return $this->belongsTo(District::class,'district_id','id');
    }

    public function upazilla(){
        return $this->belongsTo(Upazilla::class,'upazilla_id','id');
    }
}
