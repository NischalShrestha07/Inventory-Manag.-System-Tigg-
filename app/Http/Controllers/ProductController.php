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
        $categories = ProductCategory::all();
        return view('admin.products.products', compact('products', 'categories'));
    }
    public function AddNewProduct(Request $request)
    {
        $request->validate([
            'code' => 'nullable',
            'name' => 'required',
            'category' => 'required',
            'tax' => 'nullable',
        ]);

        $data = new Product();
        $data->name = $request->name;
        $data->code = $request->code;
        $data->category = $request->category;
        $data->tax = $request->tax;
        $data->save();

        return redirect()->route('product.create')->with('success', 'Product Added Successfully.');
    }


    public function AddCategory(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $category = new ProductCategory();
        $category->name = $request->category;
        $category->save();

        return redirect()->route('product.create')->with('success', 'Category Added Successfully.');
    }



    public function UpdateProduct(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'nullable',
            'name' => 'required',
            'category' => 'required',
            'tax' => 'nullable',


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
