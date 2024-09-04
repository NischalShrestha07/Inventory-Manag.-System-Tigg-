<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
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
    public function AddNewProduct(Request $request)
    {
        $request->validate([
            'code' => 'nullable',
            'name' => 'required|string',
            'category' => 'nullable|string',
            'tax' => 'nullable|string',
            // 'selling_price' => 'nullable|numeric', // Validate as a numeric field
            // 'purchase_price' => 'nullable|numeric',
            // 'primary_unit' => 'nullable|string',
        ]);

        $data = new Product();
        $data->name = $request->name;
        $data->code = $request->code;
        $data->category = $request->category;
        $data->tax = $request->tax;

        // // Set a default value if selling_price is not provided
        // $data->selling_price = $request->selling_price ?? 0;
        // $data->purchase_price = $request->purchase_price ?? 0;
        // $data->primary_unit = $request->primary_unit;
        $data->save();

        return redirect()->route('product.create')->with('success', 'Product Added Successfully.');
    }



    // public function UpdateProduct(Request $request, Product $product)
    // {
    //     $request->validate([
    //         'code' => 'nullable',
    //         'name' => 'required|string',
    //         'category' => 'nullable|string',
    //         'tax' => 'nullable|string',
    //         'selling_price' => 'nullable',
    //         'purchase_price' => 'nullable',
    //         'primary_unit' => 'nullable',

    //     ]);
    //     $data = Product::findOrFail($request->input('id'));
    //     $data->name = $request->name;
    //     $data->code = $request->code;
    //     $data->category = $request->category;
    //     $data->tax = $request->tax;
    //     $data->selling_price = $request->selling_price;
    //     $data->purchase_price = $request->purchase_price;
    //     $data->primary_unit = $request->primary_unit;
    //     $data->save();
    //     // dd($data);
    //     return redirect()->route('product.create')->with('success', 'Product Updated Successfully.');
    // }


    public function UpdateProduct(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'nullable',
            'name' => 'required|string',
            'category' => 'nullable|string',
            'tax' => 'nullable|string',
            // 'selling_price' => 'nullable|numeric', // Validate as a numeric field
            // 'purchase_price' => 'nullable|numeric',
            // 'primary_unit' => 'nullable|string',
        ]);

        $data = Product::findOrFail($request->input('id'));
        $data->code = $request->code;
        $data->name = $request->name;
        $data->category = $request->category;
        $data->tax = $request->tax;

        // Set a default value if selling_price is not provided
        // $data->selling_price = $request->selling_price ?? $data->selling_price;
        // $data->purchase_price = $request->purchase_price ?? $data->purchase_price;
        // $data->primary_unit = $request->primary_unit;
        $data->save();

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
