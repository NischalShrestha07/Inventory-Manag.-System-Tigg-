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

        return redirect()->route('adjustment.create')->with('success', 'Product Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InvenAdjustment $invenAdjustment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvenAdjustment $invenAdjustment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvenAdjustment $invenAdjustment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvenAdjustment $invenAdjustment)
    {
        //
    }
}
