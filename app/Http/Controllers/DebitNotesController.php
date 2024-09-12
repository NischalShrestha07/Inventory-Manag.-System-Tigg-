<?php

namespace App\Http\Controllers;

use App\Models\DebitNotes;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DebitNotesController extends Controller
{
    public function index()
    {
        $debitnote = DebitNotes::with('supplier')->get();
        $products = Product::all();
        $supplier = Supplier::all();
        return view('admin.debitnote.index', compact('debitnote', 'supplier', 'products'));
    }


    public function AddNewDebitNote(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|exists:suppliers,name',
            'referenceNo' => 'nullable|string',
            'date' => 'required',
            'product' => 'nullable|exists:products,name',
            'amount' => 'nullable',
            'noteno' => 'nullable',
            'quantity' => 'nullable',
            'rate' => 'nullable',
            'vat' => 'nullable',
            'discount' => 'nullable',

        ]);
        $data = new DebitNotes();
        $data->name = $request->input('name');
        $data->referenceNo = $request->input('referenceNo');
        $data->date = $request->input('date');
        $data->product = $request->input('product');
        $data->noteno = $request->input('noteno');
        $data->amount = $request->input('grandTotal');
        $data->rate = $request->input('rate');
        $data->quantity = $request->input('quantity');
        $data->vat = $request->input('vat');
        $data->discount = $request->input('discount');

        // dd($data);
        $data->save();
        return redirect()->route('debitnote.create')->with('success', 'Debit Note Added Successfully.');
    }


    public function UpdateDebitNote(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'referenceNo' => 'nullable|string',
            'date' => 'nullable',
            'product' => 'nullable',
            'amount' => 'nullable',
            'account' => 'nullable',
            'noteno' => 'nullable',
            'quantity' => 'nullable',
            'rate' => 'nullable',
            'vat' => 'nullable',
            'discount' => 'nullable',


        ]);

        $data = DebitNotes::findOrFail($request->input('id'));
        $data->name = $request->input('name');
        $data->referenceNo = $request->input('referenceNo');
        $data->date = $request->input('date');
        $data->product = $request->input('product');
        $data->noteno = $request->input('noteno');
        $data->amount = $request->input('amount'); // Store total after VAT
        $data->quantity = $request->input('quantity');
        $data->rate = $request->input('rate');
        $data->discount = $request->input('discount');
        $data->vat = $request->input('vat');



        // $data->amount = $request->input('grandTotal'); // Store total after VAT



        $data->save();

        return redirect()->route('debitnote.create')->with('success', 'Debit Note Updated Successfully.');
    }


    public function destroy($id)
    {
        $customer = DebitNotes::find($id);
        $customer->delete();
        return redirect()->route('debitnote.create')->with('error', 'Debit Note Deleted Successfully.');
    }
}
