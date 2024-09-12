<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseBill;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseBillController extends Controller
{
    public function index()
    {
        $purchaseBill = PurchaseBill::with('supplier')->get();
        $products = Product::all();
        $supplier = Supplier::all();
        return view('admin.purchaseBill.index', compact('purchaseBill', 'supplier', 'products'));
    }


    public function AddNewPurchaseBill(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|exists:suppliers,name',
            'referenceNo' => 'nullable|string',
            'billDate' => 'nullable',
            'billNo' => 'nullable',
            'dueDate' => 'nullable',
            'invoReferenceNo' => 'nullable',
            'product' => 'nullable|exists:products,name',
            'amount' => 'nullable',
            'quantity' => 'nullable',
            'rate' => 'nullable',
            'discount' => 'nullable',
            'vat' => 'nullable',

        ]);
        $data = new PurchaseBill();
        $data->name = $request->input('name');
        $data->referenceNo = $request->input('referenceNo');
        $data->billDate = $request->input('billDate');
        $data->billNo = $request->input('billNo');
        $data->dueDate = $request->input('dueDate');
        $data->invoReferenceNo = $request->input('invoReferenceNo');
        $data->product = $request->input('product');
        $data->amount = $request->input('grandTotal');
        $data->quantity = $request->input('quantity');
        $data->rate = $request->input('rate');
        $data->vat = $request->input('vat');
        $data->discount = $request->input('discount');

        // dd($data);
        $data->save();
        return redirect()->route('purchaseBill.create')->with('success', 'Purchase Bill Added Successfully.');
    }


    public function UpdatePurchaseBill(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'referenceNo' => 'nullable|string',
            'billDate' => 'nullable',
            'billNo' => 'nullable',
            'dueDate' => 'nullable',
            'invoReferenceNo' => 'nullable',
            'product' => 'nullable',
            'amount' => 'nullable',
            'quantity' => 'nullable',
            'rate' => 'nullable',
            'discount' => 'nullable',
            'vat' => 'nullable',


        ]);

        $data = PurchaseBill::findOrFail($request->input('id'));
        $data->name = $request->input('name');
        $data->referenceNo = $request->input('referenceNo');
        $data->billDate = $request->input('billDate');
        $data->billNo = $request->input('billNo');
        $data->dueDate = $request->input('dueDate');
        $data->invoReferenceNo = $request->input('invoReferenceNo');
        $data->product = $request->input('product');
        $data->amount = $request->input('amount'); // Store total after VAT
        $data->quantity = $request->input('quantity');
        $data->rate = $request->input('rate');
        $data->discount = $request->input('discount');
        $data->vat = $request->input('vat');

        // $data->amount = $request->input('grandTotal'); // Store total after VAT
        $data->save();
        // dd($data);
        return redirect()->route('purchaseBill.create')->with('success', 'Purchase Bill Updated Successfully.');
    }


    public function destroy($id)
    {
        $customer = PurchaseBill::find($id);
        $customer->delete();
        return redirect()->route('purchaseBill.create')->with('error', 'Purchase Bill Deleted Successfully.');
    }
}
