<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazilla extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Division(){
        return $this->belongsTo('App\Models\Division');
    }

    public function District(){
        return $this->belongsTo('App\Models\District');
    }
}
