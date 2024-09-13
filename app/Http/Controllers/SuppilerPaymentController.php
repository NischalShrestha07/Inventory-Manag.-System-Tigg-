<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\SuppilerPayment;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppilerPaymentController extends Controller
{
    public function index()
    {
        $payment = SuppilerPayment::with('supplier')->get();
        $accounts = Accounts::with('account')->get();
        $supplier = Supplier::all();
        return view('admin.payment.index', compact('payment', 'supplier', 'accounts'));
    }


    public function AddNewSupplierPayment(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|exists:suppliers,name',
            'account' => 'nullable',
            'date' => 'nullable',
            'payreference' => 'nullable',
            'note' => 'nullable',
            'mode' => 'nullable',
            'entryno' => 'nullable',
            'amount' => 'nullable',

        ]);
        $data = new SuppilerPayment();
        $data->name = $request->input('name');
        $data->payreference = $request->input('payreference');
        $data->note = $request->input('note');
        $data->date = $request->input('date');
        $data->mode = $request->input('mode');
        $data->entryno = $request->input('entryno');
        $data->account = $request->input('account');
        $data->amount = $request->input('amount');
        // $data->amount = $request->input('grandTotal');


        // $data->amount = $request->input('grandTotal');

        // dd($data);
        $data->save();
        return redirect()->route('payment.create')->with('success', 'Supplier Payment Added Successfully.');
    }


    public function UpdateSupplierPayment(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'date' => 'nullable',
            'amount' => 'nullable',
            'account' => 'nullable',
            'payreference' => 'nullable',
            'note' => 'nullable',
            'entryno' => 'nullable',
            'mode' => 'nullable',
        ]);

        $data = SuppilerPayment::findOrFail($request->input('id'));
        $data->name = $request->input('name');
        $data->payreference = $request->input('payreference');
        $data->note = $request->input('note');
        $data->date = $request->input('date');
        $data->mode = $request->input('mode');
        $data->entryno = $request->input('entryno');
        $data->account = $request->input('account');
        $data->amount = $request->input('amount');
        $data->save();

        return redirect()->route('payment.create')->with('success', 'Supplier Payment Updated Successfully.');
    }


    public function destroy($id)
    {
        $customer = SuppilerPayment::find($id);
        $customer->delete();
        return redirect()->route('payment.create')->with('error', 'Supplier Payment Deleted Successfully.');
    }
}
