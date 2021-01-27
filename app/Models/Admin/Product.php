<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = ['category_id', 'sub_category', 'child_sub_category', 'parent_sub_category', 'brand_name', 'product_name', 'product_img', 'product_description', 'cost_price', 'selling_price', 'status'];
}
