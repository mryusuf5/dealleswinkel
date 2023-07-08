<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productcategories;

class Products extends Model
{
    use HasFactory;

    public function productcategories()
    {
        return $this->belongsTo(Productcategories::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(reviews::class, 'product_id');
    }

    public function productimages()
    {
        return $this->hasMany(Productimages::class, "product_id");
    }
}
