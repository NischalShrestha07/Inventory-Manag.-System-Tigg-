<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\UOM;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = ProductCategory::all();
        $primary_unit = UOM::all();
        return view('admin.products.products', compact('products', 'categories', 'primary_unit'));
    }
    public function AddNewProduct(Request $request)
    {
        $request->validate([
            'code' => 'nullable',
            'name' => 'required',
            'category' => 'required',
            'tax' => 'nullable',
            'primary_unit' => 'required',
            'hscode' => 'nullable',
        ]);

        $data = new Product();
        $data->name = $request->name;
        $data->code = $request->code;
        $data->category = $request->category;
        $data->tax = $request->tax;
        $data->primary_unit = $request->primary_unit;
        $data->hscode = $request->hscode;

        $data->save();

        return redirect()->route('product.create')->with('success', 'Product Added Successfully.');
    }


    public function AddCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category = new ProductCategory();
        $category->name = $request->name;
        $category->save();

        // return redirect()->route('product.create')->with('success', 'Category Added Successfully.');
    }



    public function UpdateProduct(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'nullable',
            'name' => 'required',
            'category' => 'required',
            'tax' => 'nullable',
            'primary_unit' => 'required',
            'hscode' => 'nullable',


        ]);
        $data = Product::findOrFail($request->input('id'));
        $data->name = $request->name;
        $data->code = $request->code;
        $data->category = $request->category;
        $data->tax = $request->tax;
        $data->primary_unit = $request->primary_unit;
        $data->hscode = $request->hscode;
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
