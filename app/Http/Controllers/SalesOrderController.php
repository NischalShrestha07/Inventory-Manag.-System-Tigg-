<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    public function index()
    {
        // $products = Customer::all();
        $hello = Customer::all();
        $salesOrder = SalesOrder::all();
        return view('admin.salesOrder.index', compact('salesOrder', 'hello'));
    }


    public function AddNewSalesOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'orderno' => 'nullable',
            'date' => 'nullable|string',
            'referenceno' => 'nullable|string',
            'deliverydate' => 'nullable',
            'stage' => 'nullable',
            'rate' => 'nullable',
            'discount' => 'nullable',
            'quantity' => 'nullable',
            'amount' => 'nullable',
            'vat' => 'nullable',
            'account' => 'nullable',


        ]);
        $data = new SalesOrder();

        $data->name = $request->input('name');
        $data->orderno = $request->input('orderno');
        $data->date = $request->input('date');
        $data->referenceno = $request->input('referenceno');
        $data->deliverydate = $request->input('deliverydate');
        $data->stage = $request->input('stage');
        $data->amount = $request->input('grandTotal');
        $data->rate = $request->input('rate');
        $data->quantity = $request->input('quantity');
        $data->vat = $request->input('vat');
        $data->discount = $request->input('discount');
        $data->save();

        return redirect()->route('salesOrder.create')->with('success', 'Sales Order Added Successfully.');
    }


    public function UpdateSalesOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'orderno' => 'nullable',
            'date' => 'nullable|string',
            'referenceno' => 'nullable|string',
            'deliverydate' => 'nullable',
            'stage' => 'nullable',
            'rate' => 'nullable',
            'discount' => 'nullable',
            'quantity' => 'nullable',
            'amount' => 'nullable',
            'vat' => 'nullable',

        ]);
        $data = SalesOrder::findOrFail($request->input('id'));

        $data->name = $request->name;
        $data->orderno = $request->orderno;
        $data->date = $request->date;
        $data->referenceno = $request->referenceno;
        $data->deliverydate = $request->deliverydate;
        $data->stage = $request->stage;
        $data->amount = $request->input('amount');
        $data->rate = $request->input('rate');
        $data->quantity = $request->input('quantity');
        $data->vat = $request->input('vat');
        $data->discount = $request->input('discount');
        $data->save();
        return redirect()->route('salesOrder.create')->with('success', 'Sales Order Updated Successfully.');
    }


    public function destroy($id)
    {
        $quotation = SalesOrder::find($id);
        $quotation->delete();
        return redirect()->route('salesOrder.create')->with('error', 'Sales Order Deleted Successfully.');
    }
}
