<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchase = PurchaseOrder::with('supplier')->get();
        $accounts = Accounts::with('account')->get();
        $supplier = Supplier::all();
        return view('admin.purchaseOrder.index', compact('purchase', 'supplier', 'accounts'));
    }


    public function AddNewPurchaseOrder(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|exists:suppliers,name',
            'referenceNo' => 'nullable|string',
            'orderNo' => 'nullable|string',
            'date' => 'required',
            'cterms' => 'nullable',
            'account' => 'required',
            'amount' => 'nullable',
            'stage' => 'nullable',

        ]);
        $data = new PurchaseOrder();
        $data->name = $request->input('name');
        $data->referenceNo = $request->input('referenceNo');
        $data->orderNo = $request->input('orderNo');
        $data->date = $request->input('date');
        $data->cterms = $request->input('cterms');
        $data->stage = $request->input('stage');
        $data->amount = $request->input('grandTotal');
        // $data->amount = $request->input('grandTotal');
        $data->account = $request->input('account');

        // dd($data);
        $data->save();
        return redirect()->route('purchaseOrder.create')->with('success', 'Purchase Order Added Successfully.');
    }


    public function UpdatePurchaseOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'referenceNo' => 'nullable|string',
            'orderNo' => 'nullable|string',
            'date' => 'nullable',
            'cterms' => 'nullable',
            'stage' => 'nullable',
            'amount' => 'nullable',
            'account' => 'nullable',


        ]);

        $data = PurchaseOrder::findOrFail($request->input('id'));
        $data->name = $request->input('name');
        $data->referenceNo = $request->input('referenceNo');
        $data->orderNo = $request->input('orderNo');
        $data->date = $request->input('date');
        $data->cterms = $request->input('cterms');
        $data->stage = $request->input('stage');
        $data->amount = $request->input('amount'); // Store total after VAT
        // $data->amount = $request->input('grandTotal'); // Store total after VAT

        $data->account = $request->input('account');


        $data->save();

        return redirect()->route('purchaseOrder.create')->with('success', 'Purchase Order Updated Successfully.');
    }


    public function destroy($id)
    {
        $customer = PurchaseOrder::find($id);
        $customer->delete();
        return redirect()->route('purchaseOrder.create')->with('error', 'Purchase Order Deleted Successfully.');
    }
}
