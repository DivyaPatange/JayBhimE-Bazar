<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;

class DesignController extends Controller
{
    public function singleProduct($id)
    {
        $subCategory = Category::findorfail($id);
        // dd($subCategory);
        $products = Product::where('category_id', $id)->orderBy('id', 'DESC')->where('status', 1)->paginate(12);
        return view('auth.category-product', compact('products', 'subCategory'));
    }

    public function singleCategoryProduct($id)
    {
        $subCategory = SubCategory::findorfail($id);
        // dd($subCategory);
        $products = Product::where('parent_sub_category', $id)->orderBy('id', 'DESC')->where('status', 1)->paginate(12);
        return view('auth.subCategory-product', compact('products', 'subCategory'));
    }

    public function getProductByBrand($id)
    {
        $brand = Brand::findorfail($id);
        // dd($brand);
        $products = Product::where('brand_name', $brand->id)->orderBy('id','DESC')->where('status', 1)->get();
        return view('auth.brand-product', compact('brand', 'products'));
    }
}
