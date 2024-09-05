<?php

namespace App\Http\Controllers;

use App\Models\VarientAttribute;
use App\Models\VarientProduct;
use Illuminate\Http\Request;

class VarientAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attribute = VarientAttribute::all();
        return view('admin.variant_attributes.index', compact('attribute'));
    }

    public function AddNewVarAttribute(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'option' => 'nullable|string',

        ]);
        $data = new VarientAttribute();
        $data->name = $request->input('name');
        $data->option = $request->input('option');
        $data->save();

        return redirect()->route('varAttribute.create')->with('success', 'Varient Attribute Added Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function UpdateVarAttribute(Request $request, VarientAttribute $varientAttribute)
    {
        $request->validate([
            'name' => 'required|string',
            'option' => 'nullable|string',

        ]);
        $data = VarientAttribute::findOrFail('id');;
        $data->name = $request->input('name');
        $data->option = $request->input('option');
        $data->save();


        return redirect()->route('varAttribute.create')->with('success', 'Varient Attribute Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VarientAttribute $varientAttribute, $id)
    {
        $data = VarientAttribute::find($id);
        $data->delete();

        return redirect()->route('varAttribute.create')->with('error', 'Varient Attribute Updated Successfully.');
    }
}
