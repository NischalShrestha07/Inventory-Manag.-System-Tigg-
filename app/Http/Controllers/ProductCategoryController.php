<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = ProductCategory::all();
        return view('admin.product_category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddNewProductCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'parent' => 'nullable|string',
        ]);
        $data = new ProductCategory();
        $data->name = $request->name;
        $data->parent = $request->parent;
        $data->save();
        // dd($data);

        return redirect()->route('category.create')->with('success', 'Product Category Added Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory, $id)
    {
        $data = ProductCategory::find($id);
        $data->delete();

        return redirect()->route('category.create')->with('success', 'Product Category Deleted Successfully.');
    }
}
