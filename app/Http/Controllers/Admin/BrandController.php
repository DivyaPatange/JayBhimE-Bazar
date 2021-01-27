<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Brand;

class BrandController extends Controller
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
        $subCategories = SubCategory::where('parent_id', 0)->where('status', 1)->get();
        $brand = Brand::orderBy('id', 'DESC')->get();
        return view('admin.brand.index', compact('subCategories', 'brand'));
    }

    public function brandSubCategory(Request $request)
    {
        $subCategory = SubCategory::where("parent_id", $request->parent_sub_category_id)->where('status', 1)
            ->pluck("sub_category","id");
            return response()->json($subCategory);
    }

    public function childSubCategory(Request $request)
    {
        $subCategory = SubCategory::where('parent_id', $request->sub_category_id)->where('status', 1)->get();
        $output = "";
        // dd($subCategory);
        if(count($subCategory) > 0)
        {

            $output.='<div class="form-group form-default">
                <select name="child_sub_category" class="form-control">
                    <option value="">Choose</option>';
                    foreach($subCategory as $s){
                    $output.='<option value="'.$s->id.'">'.$s->sub_category.'</option>';
                    }
                $output.='</select>
                <span class="form-bar"></span>
                <label class="float-label">Child Sub-Category</label>
            </div>';
        return $output;
        }
        else{
            $output = "";

            return $output;
        }
        
        // dd($subCategory);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'parent_sub_category' => 'required',
            'brand_name' => 'required',
            'status' => 'required',
        ]);
        $explodeBrand = explode(",", $request->brand_name);
        for($i=0; $i < count($explodeBrand); $i++)
        {
            $brand = new Brand();
            $brand->parent_sub_category = $request->parent_sub_category;
            $brand->sub_category = $request->sub_category;
            $brand->child_sub_category = $request->child_sub_category;
            $brand->brand_name = $explodeBrand[$i];
            $brand->status = $request->status;
            $brand->save();
        }
        return redirect('/admin/brand')->with('success', 'Brand Added Successfully!');
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
        $brand = Brand::findorfail($id);
        $subCategories = SubCategory::where('parent_id', 0)->where('status', 1)->get();
        $subCategory = SubCategory::where('parent_id', $brand->parent_sub_category)->where('status', 1)->get();
        $childSubCategory = SubCategory::where('parent_id', $brand->sub_category)->where('status', 1)->get();
        // dd($subCategory);
        return view('admin.brand.edit', compact('brand', 'subCategory', 'childSubCategory', 'subCategories'));
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
        $brand = Brand::findorfail($id);
        $request->validate([
            'parent_sub_category' => 'required',
            'brand_name' => 'required',
            'status' => 'required',
        ]);
            
        $brand->parent_sub_category = $request->parent_sub_category;
        if($request->sub_category != null){
            $brand->sub_category = $request->sub_category;
        }
        else{
            $brand->child_sub_category = null;
        }
        // dd($request->child_sub_category);
        if($request->child_sub_category != null){
            $brand->child_sub_category = $request->child_sub_category;
        }
        else{
            $brand->child_sub_category = null;
        }
        $brand->brand_name = $request->brand_name;
        $brand->status = $request->status;
        $brand->update($request->all());
        return redirect('/admin/brand')->with('success', 'Brand Updated Successfully!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findorfail($id);
        $brand->delete();
        return redirect('/admin/brand')->with('success', 'Brand Deleted Successfully!');
    }
}
