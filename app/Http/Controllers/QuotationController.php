<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotation = Quotation::all();
        return view('admin.quotations.index', compact('quotation'));
    }


    public function AddNewQuotation(Quotation $quotation, Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'date' => 'nullable|string',
            'expiry_date' => 'nullable|string',
            'currency' => 'nullable',
            'credit_notes' => 'nullable',
            'product_name' => 'required|string',
            'terms' => 'nullable|string',

        ]);
        $data = new Quotation();

        $data->customer_name = $request->input('customer_name');
        $data->date = $request->input('date');
        $data->expiry_date = $request->input('expiry_date');
        $data->currency = $request->input('currency');
        $data->credit_notes = $request->input('credit_notes');
        $data->product_name = $request->input('product_name');
        $data->terms = $request->input('terms');
        $data->save();

        return redirect()->route('quotation.create')->with('success', 'Quotation Added Successfully.');
    }


    public function UpdateQuotation(Request $request, Quotation $quotation)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'date' => 'nullable|string',
            'expiry_date' => 'nullable|string',
            'currency' => 'nullable',
            'credit_notes' => 'nullable',
            'product_name' => 'required|string',
            'terms' => 'nullable|string',

        ]);
        $data = Quotation::findOrFail($request->input('id'));

        $data->customer_name = $request->input('customer_name');
        $data->date = $request->input('date');
        $data->expiry_date = $request->input('expiry_date');
        $data->currency = $request->input('currency');
        $data->credit_notes = $request->input('credit_notes');
        $data->product_name = $request->input('product_name');
        $data->terms = $request->input('terms');
        $data->save();

        return redirect()->route('quotation.create')->with('success', 'Quotation Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation, $id)
    {
        $quotation = Quotation::find($id);
        $quotation->delete();
        return redirect()->route('quotation.create')->with('error', 'Quotation Deleted Successfully.');
    }
}
