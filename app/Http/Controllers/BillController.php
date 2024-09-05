<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::all();
        return view('admin.bills.bill', compact('bills'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function AddNewBill(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'finishgoods' => 'required|string',
            'rawmaterials' => 'required|string',
            'byproducts' => 'required|string',

        ]);

        $data = new Bill();
        $data->name = $request->name;
        $data->finishgoods = $request->finishgoods;
        $data->rawmaterials = $request->rawmaterials;
        $data->byproducts = $request->byproducts;
        $data->save();

        return redirect()->route('bill.create')->with('success', 'Bill Added Successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function UpdateBill(Request $request, Bill $bill)
    {
        $request->validate([
            'name' => 'required|string',
            'finishgoods' => 'nullable|string',
            'rawmaterials' => 'nullable|string',
            'byproducts' => 'nullable|string',

        ]);

        $data = Bill::findOrFail($request->input('id'));
        $data->name = $request->name;
        $data->finishgoods = $request->finishgoods;
        $data->rawmaterials = $request->rawmaterials;
        $data->byproducts = $request->byproducts;
        $data->save();

        return redirect()->route('bill.create')->with('success', 'Bill Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill, $id)
    {
        $data = Bill::find($id);
        $data->delete();

        return redirect()->route('bill.create')->with('error', 'Bill Deleted Successfully.');
    }
}
