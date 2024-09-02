<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.products', compact('products'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function AddNewProduct(Request $request)
    {
        // $request->validate([
        //     'name' => 'nullable|integer',
        //     'finishgoods' => 'required|string',
        //     'rawmaterials' => 'nullable|string',
        //     'byproducts' => 'nullable|string',
        // ]);
        // $data = new Product();
        // $data->name = $request->name;
        // $data->finishgoods = $request->finishgoods;
        // $data->rawmaterials = $request->rawmaterials;
        // $data->byproducts = $request->byproducts;
        // $data->save();
        // dd($data);

        $request->validate([
            'code' => 'nullable|integer',
            'name' => 'required|string',
            'category' => 'nullable|string',
            'tax' => 'nullable|string',
        ]);
        $data = new Product();
        $data->name = $request->name;
        $data->code = $request->code;
        $data->category = $request->category;
        $data->tax = $request->tax;
        $data->save();
        // dd($data);


        return redirect()->route('product.create')->with('success', 'Product Added Successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.create')->with('success', 'Product Deleted Successfully.');
    }
}
