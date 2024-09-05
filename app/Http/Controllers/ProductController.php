<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\UOM;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
            'code' => 'nullable|string',
            'name' => 'required|string',
            'category_id' => 'nullable|string|exists:product_categories,id',
            'tax' => 'nullable',
            'primary_unit' => 'nullable|exists:u_o_m_s,id',
            'hscode' => 'nullable',
        ]);
        $data = new Product();
        // $dem = new ProductCategory();
        // $rem = new UOM();

        $data->name = $request->input('name');
        $data->code = $request->input('code');
        $data->category_id = $request->input('category_id');
        $data->tax = $request->input('tax');
        $data->primary_unit = $request->input('primary_unit');
        $data->hscode = $request->input('hscode');
        $data->save();
        // dd($request->all());

        // $data->name = $request->name;
        // $data->code = $request->code;
        // $data->category_id = $request->category_id;
        // $data->tax = $request->tax;
        // $data->primary_unit = $request->primary_unit;
        // $data->hscode = $request->hscode;

        // $data->save();

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
            'category_id' => 'required',
            'tax' => 'nullable',
            'primary_unit' => 'required',
            'hscode' => 'nullable',
        ]);
        $data = Product::findOrFail($request->input('id'));
        $data->name = $request->name;
        $data->code = $request->code;
        $data->category_id = $request->category_id;
        $data->tax = $request->tax;
        $data->primary_unit = $request->primary_unit;
        $data->hscode = $request->hscode;
        $data->save();
        // dd($data);
        return redirect()->route('product.create')->with('success', 'Product Updated Successfully.');
    }

    public function destroy(Product $product, $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.create')->with('success', 'Product Deleted Successfully.');
    }
}
