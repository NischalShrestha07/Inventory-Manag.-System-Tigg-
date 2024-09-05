<?php

namespace App\Http\Controllers;

use App\Models\VarientAttribute;
use App\Models\VarientOption;
use App\Models\VarientProduct;
use Illuminate\Http\Request;

class VarientAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = VarientAttribute::all();
        return view('admin.variant_attributes.index', compact('attributes'));
    }

    public function AddNewVarAttribute(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:260',
            'option' => 'nullable|array',
            'options.*' => 'required|string|max:260',

        ]);


        // Create the variant attribute
        $variant = VarientAttribute::create([
            'name' => $request->input('name'),
        ]);

        // Create each option related to the variant attribute
        foreach ($request->input('options') as $option) {
            VarientOption::create([
                'variant_attribute_id' => $variant->id,
                'option_name' => $option,
            ]);
        }

        return redirect()->back()->with('success', 'Variant Attribute and Options saved successfully!');

        // $data = new VarientAttribute();
        // $data->name = $request->input('name');
        // $data->option = $request->input('option');
        // $data->save();

        // return redirect()->route('varAttribute.create')->with('success', 'Varient Attribute Added Successfully.');
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
