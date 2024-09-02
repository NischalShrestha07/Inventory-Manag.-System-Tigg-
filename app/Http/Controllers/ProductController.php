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



    public function UpdateProduct(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'nullable|integer',
            'name' => 'required|string',
            'category' => 'nullable|string',
            'tax' => 'nullable|string',
        ]);
        $data = Product::findOrFail($request->input('id'));
        $data->name = $request->name;
        $data->code = $request->code;
        $data->category = $request->category;
        $data->tax = $request->tax;
        $data->save();
        // dd($data);


        return redirect()->route('product.create')->with('success', 'Product Updated Successfully.');
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
