<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;

class SubCategoryController extends Controller
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
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::all();
        return view('admin.subCategory.index', compact('categories', 'subCategories'));
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
            'sub_category' => 'required',
            'category_name' => 'required',
            'status' => 'required',
        ]);
        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_name;
        $subCategory->sub_category = $request->sub_category;
        if($request->parent_status == "No")
        {
            $subCategory->parent_id = $request->parent_sub_category;
        }
        else{
            $subCategory->parent_id = 0;
        }
        $subCategory->status = $request->status;
        $subCategory->save();
        return redirect('/admin/sub-categories')->with('success', 'Sub Category Added Successfully!');
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
        $categories = Category::where('status', 1)->get();
        $subCategory = SubCategory::findorfail($id);
        return view('admin.subCategory.edit', compact('categories', 'subCategory'));
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
        $subCategory = SubCategory::findorfail($id);
        $request->validate([
            'sub_category' => 'required',
            'category_name' => 'required',
            'status' => 'required',
        ]);
        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_name;
        $subCategory->sub_category = $request->sub_category;
        if($request->parent_status == "No")
        {
            $subCategory->parent_id = $request->parent_sub_category;
        }
        else{
            $subCategory->parent_id = 0;
        }
        $subCategory->status = $request->status;
        $subCategory->save();
        return redirect('/admin/sub-categories')->with('success', 'Sub Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $subCategory->delete();
        return redirect('/admin/sub-categories')->with('success', 'Sub Category Deleted Successfully!');
    }
}
