<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseLog extends Model
{
    use HasFactory;
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class,'productAttribute_id');
    }
}
