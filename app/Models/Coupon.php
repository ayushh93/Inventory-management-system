<?php

namespace App\Models;

use Database\Factories\CouponFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable =['coupon_code','discount','expiry_date','status'];
    protected $dates = ['date'];


protected static function newFactory()
{
    return CouponFactory::new();
}
}
