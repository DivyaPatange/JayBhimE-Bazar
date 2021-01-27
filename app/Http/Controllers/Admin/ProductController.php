<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Brand;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('admin.product.index', compact('products'));
    }

    public function getSubCategoryList(Request $request)
    {
        $subCategory = SubCategory::where("category_id", $request->category_id)->where('parent_id', 0)->where('status', 1)
            ->pluck("sub_category","id");
            return response()->json($subCategory);
    }

    public function parentSubCategory(Request $request)
    {
        $subCategory = SubCategory::where("parent_id", $request->parent_sub_category_id)->where('status', 1)
            ->pluck("sub_category","id");
        $brand = Brand::where('parent_sub_category', $request->parent_sub_category_id)->where('status', 1)
            ->pluck("brand_name", "id");
        return response()->json(['subCategory' => $subCategory, 'brand' => $brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'parent_sub_category' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_img' => 'required',
            'selling_price' => 'required',
            'cost_price' => 'required',
        ]);
        $product = new Product();
        $product->category_id = $request->category_name;
        $product->parent_sub_category = $request->parent_sub_category;
        $product->sub_category = $request->sub_category;
        $product->child_sub_category = $request->child_sub_category;
        $product->size = $request->size;
        $product->brand_name = $request->brand_name;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->selling_price = $request->selling_price;
        $product->cost_price = $request->cost_price;
        $product->status = $request->status;
        // dd($request->hasfile('product_img'));
        if($request->hasfile('product_img'))

         {

            foreach($request->file('product_img') as $file)

            {

                $name = time().rand(1,100).'.'.$file->extension();

                $file->move(public_path('ProductImg'), $name);  

                $files[] = $name;  

            }
            // dd($files);

         }
        $product->product_img = implode(",", $files);
        $product->save();
        return redirect('/admin/product')->with('success', 'Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorfail($id);
        $product->delete();
        return redirect('/admin/product')->with('success', 'Product Deleted Successfully!');
    }
}
