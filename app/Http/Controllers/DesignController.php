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

    public function load_data(Request $request, $id)
    {
        if($request->ajax())
        {
            $subCategory = Category::findorfail($id);
            $product1 = DB::table('products')->where('category_id', $id)->where('status', 1); 
            // dd(isset($request->maximum_price, $request->minimum_price) && !empty($request->minimum_price) && !empty($request->maximum_price));
            if(isset($request->maximum_price, $request->minimum_price) && !empty($request->minimum_price) && !empty($request->maximum_price))
            {
                $product1 = $product1->whereBetween('selling_price', [$request->minimum_price, $request->maximum_price]); 
                // dd($request->minimum_price.' '.$request->maximum_price);
                // return $product;
            }
            if(isset($request->keyword))
            {
                $product1 = $product1->where('product_name', 'LIKE', $request->keyword.'%'); 
            }
            if(isset($request->brand))
            {
                $product1 = $product1->where('parent_sub_category', $request->brand); 
            }
            if($request->id > 0)
            {
                
                $product1 = $product1->where('id', '<', $request->id); 
            }
            $product = $product1->orderBy('id', 'DESC')->limit(6)->get();
            // dd($product);
            $output = '';
            $last_id = '';
            if(!$product->isEmpty())
            {
                foreach($product as $row)
                {
                    $output .= '<div class="col-sm-4">';
                    $productUrl = route('show.product', $row->id);
                    $output .= '<div class="product-image-wrapper">
                                    
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
                                                $output .= '<form action="'.$formUrl.'" method="POST">'.$token;
                                                        if($row->size){
                                                            $output .= '<p style="margin-bottom:0px">Size</p>
                                                            <div class="input-group" style="margin:auto">
                                                            <div id="" class="btn-group radioBtn">';
                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){  $output .= 'active';}else{ $output .= 'notActive'; } $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                            }
                                                            $output .= '
                                                            </div>
                                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
                                                            </div>';
                                                        }
                                                        $output .= '<input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                            <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                            <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                            <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                            <input type="hidden" value="1" id="quantity" name="quantity">
                                                            <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                            </form>
                                                            <a href="'.$productUrl.'">
                                                            <div class="product-overlay">
					                                            <div class="overlay-content">
						                                            <h2><i class="fa fa-inr">&nbsp;</i>'.$row->selling_price.' - <del><i class="fa fa-inr">&nbsp;</i>'.$row->cost_price.'</del></h2>
						                                            <p>'.$row->product_name.'</p>
						                                            <form action="'.$formUrl.'" method="POST">'.$token;
                                                                    if($row->size){
                                                                        $output .= '<p style="margin-bottom:0px">Size</p>
							                                            <div class="input-group" style="margin:auto">
								                                            <div id="" class="btn-group radioBtn">';
                                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                            $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){ $output .= 'active';} else{ $output .= 'notActive';} $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                                            }
                                                                            $output .= '</div>
								                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
							                                            </div>';
                                                                    }
                                                                    $output .= '<input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                                        <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                                        <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                                        <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                                                        <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						                                            </form>
					                                            </div>
				                                            </div>
                                                            </a>
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
      if($request->id){
        $data = array('output' =>$output,'id' =>$request->id);
      }
      else{
        $data = array('output' =>$output);
      }
        // dd($data);
        echo json_encode($data);
        
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

    public function SubCategoryProduct($id, Request $request)
    {
        // dd($id);
        $subCategory = SubCategory::findorfail($id);
        
        
        // dd($products);
        return view('auth.subCategoryProduct', compact('subCategory'));
    }

    public function productDetails($id)
    {
        $product = Product::findorfail($id);
        return view('auth.product_detail', compact('product'));
    }

    public function filterProduct(Request $request)
    {
        if($request->ajax())
        {
            $product1 = DB::table('products')->where('status', 1); 
            // dd(isset($request->maximum_price, $request->minimum_price) && !empty($request->minimum_price) && !empty($request->maximum_price));
            if(isset($request->maximum_price, $request->minimum_price) && !empty($request->minimum_price) && !empty($request->maximum_price))
            {
                $product1 = $product1->whereBetween('selling_price', [$request->minimum_price, $request->maximum_price]); 
                // dd($request->minimum_price.' '.$request->maximum_price);
                // return $product;
            }
            if(isset($request->keyword))
            {
                $product1 = $product1->where('product_name', 'LIKE', $request->keyword.'%'); 
            }
            if(isset($request->brand))
            {
                $product1 = $product1->where('brand_name', $request->brand); 
            }
            if($request->id > 0)
            {
                
                $product1 = $product1->where('id', '<', $request->id); 
            }
            $product = $product1->orderBy('id', 'DESC')->limit(6)->get();
            // dd($product);
            $output = '';
            $last_id = '';
            if(!$product->isEmpty())
            {
                foreach($product as $row)
                {
                    $output .= '<div class="col-sm-4">';
                    $productUrl = route('show.product', $row->id);
                    $output .= '<div class="product-image-wrapper">
                                    
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
                                                $output .= '<form action="'.$formUrl.'" method="POST">'.$token;
                                                if($row->size){
                                                $output .= '<p style="margin-bottom:0px">Size</p>
                                                            <div class="input-group" style="margin:auto">
                                                            <div id="" class="btn-group radioBtn">';
                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){  $output .= 'active';}else{ $output .= 'notActive'; } $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                            }
                                                            $output .= '
                                                            </div>
                                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
                                                            </div>';
                                                        }
                                                        $output .= '<input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                            <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                            <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                            <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                            <input type="hidden" value="1" id="quantity" name="quantity">
                                                            <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                            </form>
                                                            <a href="'.$productUrl.'">
                                                            <div class="product-overlay">
					                                            <div class="overlay-content">
						                                            <h2><i class="fa fa-inr">&nbsp;</i>'.$row->selling_price.' - <del><i class="fa fa-inr">&nbsp;</i>'.$row->cost_price.'</del></h2>
						                                            <p>'.$row->product_name.'</p>
						                                            <form action="'.$formUrl.'" method="POST">'.$token;
                                                                    if($row->size){
                                                                    $output .= '<p style="margin-bottom:0px">Size</p>
							                                            <div class="input-group" style="margin:auto">
								                                            <div id="" class="btn-group radioBtn">';
                                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                            $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){ $output .= 'active';} else{ $output .= 'notActive';} $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                                            }
                                                                            $output .= '</div>
								                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
							                                            </div>';
                                                                    }
                                                                    $output .= '<input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                                        <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                                        <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                                        <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                                                        <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						                                            </form>
					                                            </div>
				                                            </div>
                                                            </a>
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
      if($request->id){
        $data = array('output' =>$output,'id' =>$request->id);
      }
      else{
        $data = array('output' =>$output);
      }
        // dd($data);
        echo json_encode($data);
        
        }
    }

    public function loadSubCategoryProduct(Request $request, $id)
    {
        if($request->ajax())
        {
            $subCategory = SubCategory::findorfail($id);
        // dd($subCategory);
            $product1 = DB::table('products')->where('parent_sub_category', $id)->where('status', 1); 
            // dd(isset($request->maximum_price, $request->minimum_price) && !empty($request->minimum_price) && !empty($request->maximum_price));
            if(isset($request->maximum_price, $request->minimum_price) && !empty($request->minimum_price) && !empty($request->maximum_price))
            {
                $product1 = $product1->whereBetween('selling_price', [$request->minimum_price, $request->maximum_price]); 
                // dd($request->minimum_price.' '.$request->maximum_price);
                // return $product;
            }
            if(isset($request->keyword))
            {
                $product1 = $product1->where('product_name', 'LIKE', $request->keyword.'%'); 
            }
            if(isset($request->brand))
            {
                // dd($request->brand);
                $product1 = $product1->where('sub_category', $request->brand); 
            }
            if($request->id > 0)
            {
                
                $product1 = $product1->where('id', '<', $request->id); 
            }
            $product = $product1->orderBy('id', 'DESC')->limit(6)->get();
            // dd($product);
            $output = '';
            $last_id = '';
            if(!$product->isEmpty())
            {
                foreach($product as $row)
                {
                    $output .= '<div class="col-sm-4">';
                    $productUrl = route('show.product', $row->id);
                    $output .= '<div class="product-image-wrapper">
                                    
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
                                                $output .= '<form action="'.$formUrl.'" method="POST">'.$token;
                                                        if($row->size){
                                                            $output .= '<p style="margin-bottom:0px">Size</p>
                                                            <div class="input-group" style="margin:auto">
                                                            <div id="" class="btn-group radioBtn">';
                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){  $output .= 'active';}else{ $output .= 'notActive'; } $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                            }
                                                            $output .= '
                                                            </div>
                                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
                                                            </div>';
                                                        }
                                                        $output .= '<input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                            <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                            <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                            <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                            <input type="hidden" value="1" id="quantity" name="quantity">
                                                            <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                            </form>
                                                            <a href="'.$productUrl.'">
                                                            <div class="product-overlay">
					                                            <div class="overlay-content">
						                                            <h2><i class="fa fa-inr">&nbsp;</i>'.$row->selling_price.' - <del><i class="fa fa-inr">&nbsp;</i>'.$row->cost_price.'</del></h2>
						                                            <p>'.$row->product_name.'</p>
						                                            <form action="'.$formUrl.'" method="POST">'.$token;
                                                                    if($row->size){
                                                                        $output .= '<p style="margin-bottom:0px">Size</p>
							                                            <div class="input-group" style="margin:auto">
								                                            <div id="" class="btn-group radioBtn">';
                                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                            $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){ $output .= 'active';} else{ $output .= 'notActive';} $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                                            }
                                                                            $output .= '</div>
								                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
							                                            </div>';
                                                                    }
                                                                    $output .= '<input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                                        <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                                        <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                                        <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                                                        <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						                                            </form>
					                                            </div>
				                                            </div>
                                                            </a>
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
      if($request->id){
        $data = array('output' =>$output,'id' =>$request->id);
      }
      else{
        $data = array('output' =>$output);
      }
        // dd($data);
        echo json_encode($data);
        
        }
    }

    public function filterBrandProduct(Request $request, $id)
    {
        if($request->ajax())
        {
            $brand = Brand::findorfail($id);
        // dd($subCategory);
            $product1 = DB::table('products')->where('brand_name', $brand->id)->where('status', 1); 
            // dd(isset($request->maximum_price, $request->minimum_price) && !empty($request->minimum_price) && !empty($request->maximum_price));
            if(isset($request->maximum_price, $request->minimum_price) && !empty($request->minimum_price) && !empty($request->maximum_price))
            {
                $product1 = $product1->whereBetween('selling_price', [$request->minimum_price, $request->maximum_price]); 
                // dd($request->minimum_price.' '.$request->maximum_price);
                // return $product;
            }
            if(isset($request->keyword))
            {
                $product1 = $product1->where('product_name', 'LIKE', $request->keyword.'%'); 
            }
            if(isset($request->brand))
            {
                // dd($request->brand);
                $product1 = $product1->where('sub_category', $request->brand); 
            }
            if($request->id > 0)
            {
                
                $product1 = $product1->where('id', '<', $request->id); 
            }
            $product = $product1->orderBy('id', 'DESC')->limit(6)->get();
            // dd($product);
            $output = '';
            $last_id = '';
            if(!$product->isEmpty())
            {
                foreach($product as $row)
                {
                    $output .= '<div class="col-sm-4">';
                    $productUrl = route('show.product', $row->id);
                    $output .= '<div class="product-image-wrapper">
                                    
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
                                                $output .= '<form action="'.$formUrl.'" method="POST">'.$token;
                                                        if($row->size){
                                                            $output .= '<p style="margin-bottom:0px">Size</p>
                                                            <div class="input-group" style="margin:auto">
                                                            <div id="" class="btn-group radioBtn">';
                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){  $output .= 'active';}else{ $output .= 'notActive'; } $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                            }
                                                            $output .= '
                                                            </div>
                                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
                                                            </div>';
                                                        }
                                                        $output .= '<input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                            <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                            <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                            <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                            <input type="hidden" value="1" id="quantity" name="quantity">
                                                            <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                            </form>
                                                            <a href="'.$productUrl.'">
                                                            <div class="product-overlay">
					                                            <div class="overlay-content">
						                                            <h2><i class="fa fa-inr">&nbsp;</i>'.$row->selling_price.' - <del><i class="fa fa-inr">&nbsp;</i>'.$row->cost_price.'</del></h2>
						                                            <p>'.$row->product_name.'</p>
						                                            <form action="'.$formUrl.'" method="POST">'.$token;
                                                                    if($row->size){
                                                                        $output .= '<p style="margin-bottom:0px">Size</p>
							                                            <div class="input-group" style="margin:auto">
								                                            <div id="" class="btn-group radioBtn">';
                                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                            $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){ $output .= 'active';} else{ $output .= 'notActive';} $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                                            }
                                                                            $output .= '</div>
								                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
							                                            </div>';
                                                                    }
                                                                    $output .= '<input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                                        <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                                        <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                                        <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                                                        <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						                                            </form>
					                                            </div>
				                                            </div>
                                                            </a>
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
      if($request->id){
        $data = array('output' =>$output,'id' =>$request->id);
      }
      else{
        $data = array('output' =>$output);
      }
        // dd($data);
        echo json_encode($data);
        
        }
    }

    public function filterParentSubCategoryProduct(Request $request, $id)
    {
        if($request->ajax())
        {
            $subCategory = SubCategory::findorfail($id);
        // dd($subCategory);
            $product1 = DB::table('products')->where('sub_category', $subCategory->id)->where('status', 1); 
            // dd(isset($request->maximum_price, $request->minimum_price) && !empty($request->minimum_price) && !empty($request->maximum_price));
            if(isset($request->maximum_price, $request->minimum_price) && !empty($request->minimum_price) && !empty($request->maximum_price))
            {
                $product1 = $product1->whereBetween('selling_price', [$request->minimum_price, $request->maximum_price]); 
                // dd($request->minimum_price.' '.$request->maximum_price);
                // return $product;
            }
            if(isset($request->keyword))
            {
                $product1 = $product1->where('product_name', 'LIKE', $request->keyword.'%'); 
            }
            if(isset($request->brand))
            {
                // dd($request->brand);
                $product1 = $product1->where('sub_category', $request->brand); 
            }
            if($request->id > 0)
            {
                
                $product1 = $product1->where('id', '<', $request->id); 
            }
            $product = $product1->orderBy('id', 'DESC')->limit(6)->get();
            // dd($product);
            $output = '';
            $last_id = '';
            if(!$product->isEmpty())
            {
                foreach($product as $row)
                {
                    $output .= '<div class="col-sm-4">';
                    $productUrl = route('show.product', $row->id);
                    $output .= '<div class="product-image-wrapper">
                                    
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
                                                $output .= '<form action="'.$formUrl.'" method="POST">'.$token;
                                                        if($row->size){
                                                            $output .= '<p style="margin-bottom:0px">Size</p>
                                                            <div class="input-group" style="margin:auto">
                                                            <div id="" class="btn-group radioBtn">';
                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){  $output .= 'active';}else{ $output .= 'notActive'; } $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                            }
                                                            $output .= '
                                                            </div>
                                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
                                                            </div>';
                                                        }
                                                        $output .= '<input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                            <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                            <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                            <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                            <input type="hidden" value="1" id="quantity" name="quantity">
                                                            <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                            </form>
                                                            <a href="'.$productUrl.'">
                                                            <div class="product-overlay">
					                                            <div class="overlay-content">
						                                            <h2><i class="fa fa-inr">&nbsp;</i>'.$row->selling_price.' - <del><i class="fa fa-inr">&nbsp;</i>'.$row->cost_price.'</del></h2>
						                                            <p>'.$row->product_name.'</p>
						                                            <form action="'.$formUrl.'" method="POST">'.$token;
                                                                    if($row->size){
                                                                        $output .= '<p style="margin-bottom:0px">Size</p>
							                                            <div class="input-group" style="margin:auto">
								                                            <div id="" class="btn-group radioBtn">';
                                                                            for($i=0; $i< count($explodeSize); $i++){
                                                                            $output .= '<a class="btn btn-primary btn-sm '; if($i == 0){ $output .= 'active';} else{ $output .= 'notActive';} $output .= '" data-toggle="size'.$row->id.'" data-title="'.$explodeSize[$i].'" value="'.$explodeSize[$i].'" style="margin-bottom:5px">'.$explodeSize[$i].'</a>';
                                                                            }
                                                                            $output .= '</div>
								                                            <input type="hidden" name="size" id="size'.$row->id.'" value="'.$explodeSize[0].'">
							                                            </div>';
                                                                    }
                                                                    $output .= '<input type="hidden" value="'.$row->id.'" id="id" name="id">
                                                                        <input type="hidden" value="'.$row->product_name.'" id="name" name="name">
                                                                        <input type="hidden" value="'.$row->selling_price.'" id="price" name="price">
                                                                        <input type="hidden" value="'.$explodeProductImage[0].'" id="img" name="img">
                                                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                                                        <button class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						                                            </form>
					                                            </div>
				                                            </div>
                                                            </a>
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
      if($request->id){
        $data = array('output' =>$output,'id' =>$request->id);
      }
      else{
        $data = array('output' =>$output);
      }
        // dd($data);
        echo json_encode($data);
        
        }
    }
}
