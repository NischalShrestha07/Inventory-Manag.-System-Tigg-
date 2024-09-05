<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\UOM;
use App\Models\VarientProduct;
use Illuminate\Http\Request;

class VariantProductController extends Controller
{
    //
    public function index()
    {
        $varProducts = VarientProduct::all();
        $categories = ProductCategory::all();
        $primary_unit = UOM::all();
        return view('admin.variant_products.index', compact('varProducts', 'categories', 'primary_unit'));
    }

    public function AddNewVarProduct(Request $request)
    {
        $request->validate([
            'code' => 'nullable|string',
            'name' => 'required|string',
            'category' => 'nullable|string',
            'tax' => 'nullable|string',
            'selling_price' => 'nullable|string',
            'purchase_price' => 'nullable|string',
        ]);
        $data = new VarientProduct();

        $data->code = $request->input('code');
        $data->name = $request->input('name');
        $data->category = $request->input('category');
        $data->tax = $request->input('tax');
        $data->selling_price = $request->input('selling_price');
        $data->purchase_price = $request->input('purchase_price');


        $data->save();
        // dd($data);

        return redirect()->route('varProduct.create')->with('success', 'Varient Product Added Successfully.');
    }


    public function UpdateVarProduct(Request $request)
    {
        $request->validate([
            'code' => 'nullable|string',
            'name' => 'required|string',
            'category' => 'nullable|string',
            'tax' => 'nullable|string',
            'selling_price' => 'nullable|string',
            'purchase_price' => 'nullable|string',
        ]);
        $data = VarientProduct::findOrFail($request->input('id'));

        $data->code = $request->input('code');
        $data->name = $request->input('name');
        $data->category = $request->input('category');
        $data->tax = $request->input('tax');
        $data->selling_price = $request->input('selling_price');
        $data->purchase_price = $request->input('purchase_price');

        $data->save();
        // dd($data);

        return redirect()->route('varProduct.create')->with('success', ' Varient Product Updated Successfully.');
    }



    public function destroy($id)
    {
        $data = VarientProduct::findOrFail($id);
        $data->delete();

        return redirect()->route('varProduct.create')->with('error', 'Variant Product Deleted Successfully.');
    }
}
