<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Customer::all();
        $product = Product::all();
        $quotation = Quotation::all();
        return view('admin.quotations.index', compact('quotation', 'products', 'product'));
    }


    public function AddNewQuotation(Quotation $quotation, Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|exists:customers,id',
            'code' => 'nullable',
            'date' => 'nullable|string',
            'expiry_date' => 'nullable|string',
            'currency' => 'nullable',
            'credit_notes' => 'nullable',
            'terms' => 'nullable|string',
            'product_name' => 'nullable|string',
            'status' => 'nullable|string',

        ]);
        $data = new Quotation();

        $data->customer_name = $request->input('customer_name');
        $data->code = $request->input('code');
        $data->date = $request->input('date');
        $data->expiry_date = $request->input('expiry_date');
        $data->currency = $request->input('currency');
        $data->credit_notes = $request->input('credit_notes');
        $data->product_name = $request->input('product_name');
        $data->terms = $request->input('terms');
        $data->status = $request->input('status');
        $data->save();

        return redirect()->route('quotation.create')->with('success', 'Quotation Added Successfully.');
    }


    public function UpdateQuotation(Request $request, Quotation $quotation)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'code' => 'nullable',
            'date' => 'nullable|string',
            'expiry_date' => 'nullable|string',
            'currency' => 'nullable',
            'credit_notes' => 'nullable',
            'product_name' => 'nullable|string',
            'terms' => 'nullable|string',
            'status' => 'nullable|string',

        ]);
        $data = Quotation::findOrFail($request->input('id'));

        $data->customer_name = $request->customer_name;
        $data->code = $request->code;
        $data->date = $request->date;
        $data->expiry_date = $request->expiry_date;
        $data->currency = $request->currency;
        $data->credit_notes = $request->credit_notes;
        $data->product_name = $request->product_name;
        $data->terms = $request->terms;
        $data->status = $request->status;
        $data->save();
        return redirect()->route('quotation.create')->with('success', 'Quotation Updated Successfully.');
    }


    public function destroy($id)
    {
        $quotation = Quotation::find($id);
        $quotation->delete();
        return redirect()->route('quotation.create')->with('error', 'Quotation Deleted Successfully.');
    }
}
