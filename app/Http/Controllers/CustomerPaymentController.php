<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Customer;
use App\Models\CustomerPayment;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CustomerPaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomerPayment::query();

        if ($request->filled('name')) {
            # code...
            $query->where('name', $request->input('name'));
        }

        if ($request->filled('product')) {
            # code...
            $query->where('product', $request->input('product'));
        }
        // $payment = CustomerPayment::with('customer')->get();
        $payment = $query->get();
        $accounts = Accounts::with('accounts')->get();
        $customer = Customer::all();
        return view('admin.cusPayment.index', compact('payment', 'customer', 'accounts'));
    }


    public function AddNewCustomerPayment(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|exists:customers,name',
            'account' => 'nullable',
            'date' => 'nullable',
            'payreference' => 'nullable',
            'note' => 'nullable',
            'mode' => 'nullable',
            'entryno' => 'nullable',
            'amount' => 'nullable',

        ]);
        $data = new CustomerPayment();
        $data->name = $request->input('name');
        $data->payreference = $request->input('payreference');
        $data->note = $request->input('note');
        $data->date = $request->input('date');
        $data->mode = $request->input('mode');
        $data->entryno = $request->input('entryno');
        $data->account = $request->input('account');
        $data->amount = $request->input('amount');
        // $data->amount = $request->input('grandTotal');

        // dd($data);
        $data->save();
        return redirect()->route('cusPayment.create')->with('success', 'Customer Payment Added Successfully.');
    }


    public function UpdateCustomerPayment(Request $request)
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

        $data = CustomerPayment::findOrFail($request->input('id'));
        $data->name = $request->input('name');
        $data->payreference = $request->input('payreference');
        $data->note = $request->input('note');
        $data->date = $request->input('date');
        $data->mode = $request->input('mode');
        $data->entryno = $request->input('entryno');
        $data->account = $request->input('account');
        $data->amount = $request->input('amount');
        $data->save();

        return redirect()->route('cusPayment.create')->with('success', 'Customer Payment Updated Successfully.');
    }


    public function destroy($id)
    {
        $customer = CustomerPayment::find($id);
        $customer->delete();
        return redirect()->route('cusPayment.create')->with('error', 'Customer Payment Deleted Successfully.');
    }
}
