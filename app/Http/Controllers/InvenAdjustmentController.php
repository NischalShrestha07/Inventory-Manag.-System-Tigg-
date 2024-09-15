<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InvenAdjustment;
use App\Models\Product;
use Illuminate\Http\Request;

class InvenAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adjustments = InvenAdjustment::with('product')->get();
        $products = Product::all();

        return view('admin.inven_adjustments.index', compact('adjustments', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function AddNewAdjustment(Request $request)
    {
        $request->validate([
            'date' => 'nullable',
            'entryNo' => 'required|integer',
            'refernce' => 'nullable|string',
            'amount' => 'nullable',
            'note' => 'nullable',
            'rate' => 'nullable',
            'discount' => 'nullable',
            'quantity' => 'nullable',
            'product' => 'nullable',
            'vat' => 'nullable',
        ]);
        $data = new InvenAdjustment();
        $data->date = $request->input('date');
        $data->entryNo = $request->input('entryNo');
        $data->reference = $request->input('reference');
        $data->amount = $request->input('amount');
        $data->note = $request->input('note');
        $data->amount = $request->input('grandTotal');
        $data->rate = $request->input('rate');
        $data->product = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->vat = $request->input('vat');
        $data->discount = $request->input('discount');
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
            'entryNo' => 'required|integer',
            'refernce' => 'nullable|string',
            'amount' => 'nullable',
            'note' => 'nullable',
            'rate' => 'nullable',
            'discount' => 'nullable',
            'quantity' => 'nullable',
            'product' => 'nullable',
            'vat' => 'nullable',
        ]);
        $data = InvenAdjustment::findOrFail($request->input('id'));
        $data->date = $request->input('date');
        $data->entryNo = $request->input('entryNo');
        $data->reference = $request->input('reference');
        $data->amount = $request->input('amount');
        $data->note = $request->input('note');
        $data->amount = $request->input('amount');
        $data->rate = $request->input('rate');
        $data->product = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->vat = $request->input('vat');
        $data->discount = $request->input('discount');
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

        return redirect()->route('adjustment.create')->with('error', 'Inventory Adjustment Deleted Successfully.');
    }
}
