<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function purchaseLog()
    {
        return $this->hasMany(PurchaseLog::class);
    }
    public function salesLog()
    {
        return $this->hasMany(SalesLog::class);
    }

   
}
