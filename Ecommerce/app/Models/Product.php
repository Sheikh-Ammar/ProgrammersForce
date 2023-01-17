<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'price', 'discountPercentage', 'rating', 'stock', 'brand', 'category_id'];

    // PRODUCT MANY-ONE CATEGORY
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // PRODUCT MANY-ONE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // PRODUCT ONE-MANY ORDERS
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
