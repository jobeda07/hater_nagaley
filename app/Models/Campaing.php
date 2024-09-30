<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaing extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function campaing_products()
    {
        return $this->hasMany(CampaingProduct::class);
    }
}
