<?php

namespace App\Http\Controllers;

use App\Models\CreditNotes;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class CreditNotesController extends Controller
{
    public function index(Request $request)
    {

        $query = CreditNotes::query();

        if ($request->filled('name')) {
            $query->where('name', $request->input('name'));
            // fetching by the name column not by the id as in DB the name is of string type which means id can't be stored in string as it is integer.
        }

        if ($request->filled('product')) {
            $query->where('product', $request->input('product'));
        }

        // $creditnote = CreditNotes::with('customer')->get();
        $creditnote = $query->get();
        $products = Product::all();
        $supplier = Customer::all();
        return view('admin.creditnote.index', compact('creditnote', 'supplier', 'products'));
    }


    public function AddNewCreditNote(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|exists:customers,name',
            'referenceNo' => 'nullable|string',
            'date' => 'nullable',
            'product' => 'nullable|exists:products,name',
            'amount' => 'nullable',
            'noteno' => 'nullable',

        ]);
        $data = new CreditNotes();
        $data->name = $request->input('name');
        $data->referenceNo = $request->input('referenceNo');
        $data->date = $request->input('date');
        $data->product = $request->input('product');
        $data->amount = $request->input('grandTotal');
        $data->noteno = $request->input('noteno');

        // dd($data);
        $data->save();
        return redirect()->route('creditnote.create')->with('success', 'Credit Note Added Successfully.');
    }


    public function UpdateCreditNote(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'referenceNo' => 'nullable|string',
            'date' => 'nullable',
            'product' => 'nullable',
            'amount' => 'nullable',
            'noteno' => 'nullable',


        ]);

        $data = CreditNotes::findOrFail($request->input('id'));
        $data->name = $request->input('name');
        $data->referenceNo = $request->input('referenceNo');
        $data->date = $request->input('date');
        $data->product = $request->input('product');
        $data->noteno = $request->input('noteno');
        $data->amount = $request->input('amount'); // Store total after VAT
        // $data->amount = $request->input('grandTotal'); // Store total after VAT



        $data->save();

        return redirect()->route('creditnote.create')->with('success', ' Credit Note  Updated Successfully.');
    }


    public function destroy($id)
    {
        $customer = CreditNotes::find($id);
        $customer->delete();
        return redirect()->route('creditnote.create')->with('error', 'Credit Note Deleted Successfully.');
    }
}
