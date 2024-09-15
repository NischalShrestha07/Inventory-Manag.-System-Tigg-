<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\UOM;
use App\Models\VarientAttribute;
use App\Models\VarientOption;
use App\Models\VarientProduct;
use Illuminate\Http\Request;

class VariantProductController extends Controller
{
    //
    public function index()
    {
        $attributes = VarientAttribute::all();
        $products = Product::all();
        $varProducts = VarientProduct::all();
        $categories = ProductCategory::all();
        $primary_unit = UOM::all();
        return view('admin.variant_products.index', compact('varProducts', 'products', 'categories', 'primary_unit', 'attributes'));
    }

    public function AddNewVarProduct(Request $request)
    {
        $request->validate([
            'code' => 'nullable|string',
            'name' => 'required|string',
            'category' => 'nullable|string',
            'tax' => 'nullable|string',
            'primary_unit' => 'required|string',
            'selling_price' => 'nullable|string',
            'purchase_price' => 'nullable|string',
        ]);
        $data = new VarientProduct();

        $data->code = $request->input('code');
        $data->name = $request->input('name');
        $data->category = $request->input('category');
        $data->tax = $request->input('tax');
        $data->primary_unit = $request->input('primary_unit');
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
            'primary_unit' => 'required|string',
            'purchase_price' => 'nullable|string',
        ]);
        $data = VarientProduct::findOrFail($request->input('id'));

        $data->code = $request->input('code');
        $data->name = $request->input('name');
        $data->category = $request->input('category');
        $data->tax = $request->input('tax');
        $data->primary_unit = $request->input('primary_unit');
        $data->selling_price = $request->input('selling_price');
        $data->purchase_price = $request->input('purchase_price');

        $data->save();
        // dd($data);

        return redirect()->route('varProduct.create')->with('success', ' Varient Product Updated Successfully.');
    }


    public function fetchOptions($attribute)
    {
        // Fetch attribute model based on the attribute name
        $attributeModel = VarientAttribute::where('name', $attribute)->first();

        // If the attribute is not found, return an empty array of options
        if (!$attributeModel) {
            return response()->json(['options' => []]);
        }

        // Retrieve the related options for the attribute
        $options = $attributeModel->options;

        // Format options for response
        $formattedOptions = $options->map(function ($option) {
            return [
                'value' => $option->id, // Use the option's ID or another unique value
                'label' => $option->option_name // Display name for the option
            ];
        });

        // Return the options as JSON
        return response()->json(['options' => $formattedOptions]);
    }

    public function destroy($id)
    {
        $data = VarientProduct::findOrFail($id);
        $data->delete();

        return redirect()->route('varProduct.create')->with('error', 'Variant Product Deleted Successfully.');
    }
}
