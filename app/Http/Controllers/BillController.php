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
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill, $id)
    {
        $data = Bill::find($id);
        $data->delete();

        return redirect()->route('bill.create')->with('success', 'Bill Deleted Successfully.');
    }
}
