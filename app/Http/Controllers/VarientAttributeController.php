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
        $varients = VarientAttribute::with('options')->get();
        $attributes = VarientAttribute::all();
        return view('admin.variant_attributes.index', compact('attributes', 'varients'));
    }

    public function AddNewVarAttribute(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:260',
            'options' => 'nullable|array',
            'options.*' => 'required|string|max:260',

        ]);
        // dd($request->all());


        // Create the variant attribute
        $variant = VarientAttribute::create([
            'name' => $request->input('name'),
        ]);

        // // Create each option related to the variant attribute
        // foreach ($request->input('options') as $option) {
        //     VarientOption::create([
        //         'variant_attribute_id' => $variant->id,
        //         'option_name' => $option,
        //     ]);
        // }



        // Check if options are provided before running the foreach loop
        if ($request->has('options') && is_array($request->input('options'))) {
            foreach ($request->input('options') as $option) {
                VarientOption::create([
                    'varient_attribute_id' => $variant->id, // Make sure this matches your table column
                    'option_name' => $option,
                ]);
            }
        }

        // dd($request->all());

        return redirect()->back()->with('success', 'Variant Attribute and Options saved successfully!');
    }


    public function UpdateVarAttribute(Request $request, VarientAttribute $varientAttribute)
    {
        $request->validate([
            'name' => 'required|string',
            'options' => 'nullable|array',
            'options.*' => 'nullable|string|max:260',

        ]);

        //Update the Varient Attribute Name
        $varientAttribute->name = $request->input('name');
        $varientAttribute->save();

        if ($request->has('options')) {
            //clear the existing options to avoid duplicates
            $varientAttribute->options()->delete();



            //create or update options
            foreach ($request->input('options') as $option) {
                if (!empty($option)) {
                    VarientOption::create([
                        'varient_attribute_id' => $varientAttribute->id,
                        'option_name' => $option,
                    ]);
                }
            }
        }


        return redirect()->route('varAttribute.create')->with('success', 'Varient Attribute and Options Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VarientAttribute $varientAttribute, $id)
    {
        $data = VarientAttribute::find($id);
        $data->delete();
        return redirect()->route('varAttribute.create')->with('error', 'Varient Attribute Deleted Successfully.');
    }
}
