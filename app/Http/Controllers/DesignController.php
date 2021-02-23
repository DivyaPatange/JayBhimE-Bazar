<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;
use DB;

class DesignController extends Controller
{

    public function load_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->id > 0)
            {
                $product = DB::table('products')->where('id', '<', $request->id)->where('status', 1)->orderBy('id', 'DESC')->limit(6)->get(); 
            }
            else
            {
                $product = DB::table('products')->where('status', 1)->orderBy('id', 'DESC')->limit(6)->get(); 
            }
            $output = '';
            $last_id = '';
            if(!$product->isEmpty())
            {
                foreach($product as $row)
                {
                    $output .= '<div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">';
                                                $explodeProductImage = explode(",", $row->product_img);
                                                $imageUrl = asset('ProductImg/' . $explodeProductImage[0]);
                                                $output .= '<img src="'.$imageUrl.'" alt="" class="img-fluid" />
                                                <h2><i class="fa fa-inr">&nbsp;</i>'.$row->selling_price.' - <del><i class="fa fa-inr">&nbsp;</i>'.$row->cost_price.'</del></h2>
                                                <p>'.$row->product_name.'</p>';
                                                $formUrl = route('cart.store');
                                                $token = csrf_field();
                                                $explodeSize = explode(",", $row->size);
                                                $output .= '<form action="'.$formUrl.'" method="POST">'.$token.'
                                                            <p style="margin-bottom:0px">Size</p>
                                                            <div class="input-group" style="margin:auto">
                                                            <div id="" class="btn-group radioBtn">';
                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){  $output .= 'active';}else{ $output .= 'notActive'; } $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                            }
                                                            $output .= '
                                                            </div>
                                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
                                                            </div>
                                                            <input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                            <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                            <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                            <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                            <input type="hidden" value="1" id="quantity" name="quantity">
                                                            <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                            </form>
                                                            <div class="product-overlay">
					                                            <div class="overlay-content">
						                                            <h2><i class="fa fa-inr">&nbsp;</i>'.$row->selling_price.' - <del><i class="fa fa-inr">&nbsp;</i>'.$row->cost_price.'</del></h2>
						                                            <p>'.$row->product_name.'</p>
						                                            <form action="'.$formUrl.'" method="POST">'.$token.'
							                                            <p style="margin-bottom:0px">Size</p>
							                                            <div class="input-group" style="margin:auto">
								                                            <div id="" class="btn-group radioBtn">';
                                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                            $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){ $output .= 'active';} else{ $output .= 'notActive';} $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                                            }
                                                                            $output .= '</div>
								                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
							                                            </div>
                                                                        <input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                                        <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                                        <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                                        <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                                                        <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						                                            </form>
					                                            </div>
				                                            </div>
                                                        </div>
                                        </div>
                                    </div>
                                </div>'  ; 
                                $last_id = $row->id;
                }
                $output .= '
                    <div id="load_more" style="text-align:center">
                        <div class="col-sm-12">
                        <button type="button" name="load_more_button" class="btn" data-id="'.$last_id.'" id="load_more_button" style="margin-bottom:20px;border: 1px solid #f24f55;
                        color: #f24f55;
                        background: white;">Load More</button>
                        </div>
                    </div>
                    ';
                    
            }
            else
      {
       $output .= '
       <div id="load_more" style="text-align:center">
       <div class="col-sm-12">
        <button type="button" name="load_more_button" class="btn" style="margin-bottom:20px;border: 1px solid #f24f55;
        color: #f24f55;
        background: white;">No Data Found</button>
        </div>
       </div>
       ';
      }
            echo $output;
        }
    }

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
