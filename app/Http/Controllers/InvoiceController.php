<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {

        $query = Invoice::query();

        if ($request->filled('name')) {
            $query->where('name', $request->input('name'));
            // fetching by the name column not by the id as in DB the name is of string type which means id can't be stored in string as it is integer.
        }

        if ($request->filled('product')) {
            $query->where('product', $request->input('product'));
        }
        $products = Customer::all();
        $product = Product::all();
        $invoice = $query->get();
        // $invoice = Invoice::with('customer')->get();
        return view('admin.invoice.index', compact('invoice', 'products', 'product'));
    }



    public function AddNewInvoice(Request $request)
    {
        $request->validate([
            'name' => 'required|string|exists:customers,name',
            'invoiceNo' => 'nullable',
            'referenceNo' => 'nullable',
            'invoiceDate' => 'nullable|string',
            'dueDate' => 'nullable|string',
            'rate' => 'nullable',
            'discount' => 'nullable',
            'quantity' => 'nullable',
            'amou   t' => 'nullable',
            'vat' => 'nullable',
            'product' => 'nullable',


        ]);
        $data = new Invoice();

        $data->name = $request->input('name');
        $data->invoiceNo = $request->input('invoiceNo');
        $data->referenceNo = $request->input('referenceNo');
        $data->invoiceDate = $request->input('invoiceDate');
        $data->dueDate = $request->input('dueDate');
        $data->amount = $request->input('grandTotal');
        $data->rate = $request->input('rate');
        $data->quantity = $request->input('quantity');
        $data->vat = $request->input('vat');
        $data->discount = $request->input('discount');
        $data->product = $request->input('product');

        $data->save();

        return redirect()->route('invoice.create')->with('success', 'Invoice Added Successfully.');
    }


    public function UpdateInvoice(Request $request)
    {
        $request->validate([
            'name' => 'required|string|exists:customers,name',
            'invoiceNo' => 'nullable',
            'referenceNo' => 'nullable',
            'invoiceDate' => 'nullable|string',
            'dueDate' => 'nullable|string',
            'rate' => 'nullable',
            'discount' => 'nullable',
            'quantity' => 'nullable',
            'amount' => 'nullable',
            'product' => 'nullable',
            'vat' => 'nullable',
        ]);
        $data = Invoice::findOrFail($request->input('id'));

        $data->name = $request->name;
        $data->invoiceNo = $request->invoiceNo;
        $data->referenceNo = $request->referenceNo;
        $data->invoiceDate = $request->invoiceDate;
        $data->dueDate = $request->dueDate;
        $data->amount = $request->input('amount');
        $data->rate = $request->input('rate');
        $data->quantity = $request->input('quantity');
        $data->vat = $request->input('vat');
        $data->product = $request->input('product');
        $data->discount = $request->input('discount');
        $data->save();
        return redirect()->route('invoice.create')->with('success', 'Invoice Updated Successfully.');
    }


    public function destroy($id)
    {
        $quotation = Invoice::find($id);
        $quotation->delete();
        return redirect()->route('invoice.create')->with('error', 'Invoice Deleted Successfully.');
    }
}
