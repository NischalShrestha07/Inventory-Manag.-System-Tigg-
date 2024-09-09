<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $products = Customer::all();
        $product = Product::all();
        $invoice = Invoice::with('customer')->get();
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
            'terms' => 'nullable|string',

        ]);
        $data = new Invoice();

        $data->name = $request->input('name');
        $data->invoiceNo = $request->input('invoiceNo');
        $data->referenceNo = $request->input('referenceNo');
        $data->invoiceDate = $request->input('invoiceDate');
        $data->dueDate = $request->input('dueDate');
        $data->terms = $request->input('terms');
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
            'terms' => 'nullable|string',

        ]);
        $data = Invoice::findOrFail($request->input('id'));

        $data->name = $request->name;
        $data->invoiceNo = $request->invoiceNo;
        $data->referenceNo = $request->referenceNo;
        $data->invoiceDate = $request->invoiceDate;
        $data->dueDate = $request->dueDate;
        $data->terms = $request->terms;
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
