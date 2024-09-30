<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function division(){
    //     return $this->belongsTo(Division::class,'division_id','id');
    // }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    // public function division(){
    //     return $this->belongsTo('App\Models\Division');
    // }
    public function district(){
        return $this->belongsTo('App\Models\District');
    }
    public function upazilla(){
        return $this->belongsTo('App\Models\Upazilla');
    }
    
}
