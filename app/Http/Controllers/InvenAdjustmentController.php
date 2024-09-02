<?php

namespace App\Http\Controllers;

use App\Models\InvenAdjustment;
use Illuminate\Http\Request;

class InvenAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adjustments = InvenAdjustment::all();
        return view('admin.inven_adjustments.index', compact('adjustments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function AddNewAdjustment(Request $request)
    {
        $request->validate([
            'date' => 'nullable',
            'entryNum' => 'required|integer',
            'refernce' => 'nullable|string',
            'amount' => 'nullable',
            'note' => 'nullable',
        ]);
        $data = new InvenAdjustment();
        $data->date = $request->input('date');
        $data->entryNum = $request->input('entryNum');
        $data->reference = $request->input('reference');
        $data->amount = $request->input('amount');
        $data->note = $request->input('note');
        $data->save();
        // dd($data);

        return redirect()->route('adjustment.create')->with('success', 'Product Adjustment Added Successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function UpdateAdjustment(Request $request, InvenAdjustment $invenAdjustment)
    {
        $request->validate([
            'date' => 'nullable',
            'entryNum' => 'required|integer',
            'refernce' => 'nullable|string',
            'amount' => 'nullable',
            'note' => 'nullable',
        ]);
        $data = InvenAdjustment::findOrFail($request->input('id'));
        $data->date = $request->input('date');
        $data->entryNum = $request->input('entryNum');
        $data->reference = $request->input('reference');
        $data->amount = $request->input('amount');
        $data->note = $request->input('note');
        $data->save();
        // dd($data);

        return redirect()->route('adjustment.create')->with('success', 'Product Adjustment Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvenAdjustment $invenAdjustment, $id)
    {
        $data = InvenAdjustment::findOrFail($id);
        $data->delete();

        return redirect()->route('adjustment.create')->with('success', 'Inventory Adjustment Deleted Successfully.');
    }
}
