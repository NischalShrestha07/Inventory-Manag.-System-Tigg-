<?php

namespace App\Http\Controllers;

use App\Models\VarientProduct;
use Illuminate\Http\Request;

class VariantProductController extends Controller
{
    //
    public function index()
    {
        $varProducts = VarientProduct::all();
        return view('admin.variant_products.index', compact('varProducts'));
    }

    public function AddNewVarProduct(Request $request)
    {
        $request->validate([
            'code' => 'nullable|string',
            'name' => 'required|string',
            'category' => 'nullable|string',
            'tax' => 'nullable|string',
        ]);
        $data = new VarientProduct();
        // $data->code = $data->code;
        // $data->name = $data->name;
        // $data->category = $data->category;
        // $data->tax = $data->tax;
        $data->code = $request->input('code');  // Assigning 'code' input to 'code' attribute
        $data->name = $request->input('name');  // Assigning 'name' input to 'name' attribute
        $data->category = $request->input('category');  // Assigning 'category' input to 'category' attribute
        $data->tax = $request->input('tax');  // Assigning 'tax' input to 'tax' attribute

        $data->save();
        // dd($data);

        return redirect()->route('varProduct.create')->with('success', 'Product Added Successfully.');
    }



    public function destroy($id)
    {
        $data = VarientProduct::findOrFail($id);
        $data->delete();

        return redirect()->route('varProduct.create')->with('success', 'Variant Product Deleted Successfully.');
    }
}
