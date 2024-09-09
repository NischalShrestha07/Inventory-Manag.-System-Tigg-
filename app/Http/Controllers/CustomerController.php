<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        return view('admin.customer.index', compact('customers'));
    }


    public function AddNewCustomer(Customer $customer, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
            'code' => 'nullable|string',
            'pan' => 'required',
            'phoneno' => 'required',
            'email' => 'required',
            'group' => 'nullable|string',
            'cterms' => 'nullable|string',
            'climit' => 'nullable|string',

        ]);
        $data = new Customer();
        $data->name = $request->input('name');
        $data->address = $request->input('address');
        $data->code = $request->input('code');
        $data->pan = $request->input('pan');
        $data->phoneno = $request->input('phoneno');
        $data->email = $request->input('email');
        $data->group = $request->input('group');
        $data->cterms = $request->input('cterms');
        $data->climit = $request->input('climit');
        // dd($data);
        $data->save();
        return redirect()->route('customer.create')->with('success', 'Customer Added Successfully.');
    }


    public function UpdateCustomer(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
            'code' => 'nullable|string',
            'pan' => 'required',
            'phoneno' => 'required',
            'email' => 'required',
            'group' => 'nullable|string',
            'cterms' => 'nullable|string',
            'climit' => 'nullable|string',

        ]);
        $data = Customer::findOrFail($request->input('id'));

        $data->name = $request->input('name');
        $data->address = $request->input('address');
        $data->code = $request->input('code');
        $data->pan = $request->input('pan');
        $data->phoneno = $request->input('phoneno');
        $data->email = $request->input('email');
        $data->group = $request->input('group');
        $data->cterms = $request->input('cterms');
        $data->climit = $request->input('climit');
        $data->save();

        return redirect()->route('customer.create')->with('success', 'Customer Updated Successfully.');
    }


    public function destroy(Customer $customer, $id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customer.create')->with('error', 'Customer Deleted Successfully.');
    }
}
