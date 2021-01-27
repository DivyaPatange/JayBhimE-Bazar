<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;

class DesignController extends Controller
{
    public function singleProduct($id)
    {
        $products = Product::where('category_id', $id)->orderBy('id', 'DESC')->where('status', 1)->paginate(12);
        return view('auth.category-product', compact('products'));
    }

    public function singleCategoryProduct($id)
    {
        $products = Product::where('parent_sub_category', $id)->orderBy('id', 'DESC')->where('status', 1)->paginate(12);
        return view('auth.category-product', compact('products'));
    }
}
