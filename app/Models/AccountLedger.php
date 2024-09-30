<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLedger extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function account_head(){
        return $this->belongsTo(AccountHead::class);
    }
}
