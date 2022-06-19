<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name', 'slug', 'parent_id','status'];

    public function subCategory()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
