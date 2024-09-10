<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchase = PurchaseOrder::with('supplier')->get();
        $supplier = Supplier::all();
        return view('admin.purchaseOrder.index', compact('purchase', 'supplier'));
    }


    public function AddNewPurchaseOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|exists:suppliers,name',
            'referenceNo' => 'nullable|string',
            'orderNo' => 'nullable|string',
            'date' => 'required',
            'cterms' => 'nullable',
            'stage' => 'nullable',

        ]);
        $data = new PurchaseOrder();
        $data->name = $request->input('name');
        $data->referenceNo = $request->input('referenceNo');
        $data->orderNo = $request->input('orderNo');
        $data->date = $request->input('date');
        $data->cterms = $request->input('cterms');
        $data->stage = $request->input('stage');

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
            'date' => 'required',
            'cterms' => 'nullable',
            'stage' => 'nullable',

        ]);

        $data = PurchaseOrder::findOrFail($request->input('id'));
        $data->name = $request->input('name');
        $data->referenceNo = $request->input('referenceNo');
        $data->orderNo = $request->input('orderNo');
        $data->date = $request->input('date');
        $data->cterms = $request->input('cterms');
        $data->stage = $request->input('stage');
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
