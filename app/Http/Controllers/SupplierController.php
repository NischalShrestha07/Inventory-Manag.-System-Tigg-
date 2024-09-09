<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.index', compact('suppliers'));
    }


    public function AddNewSupplier(Request $request)
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
        $data = new Supplier();
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
        return redirect()->route('supplier.create')->with('success', 'Supplier Added Successfully.');
    }


    public function UpdateSupplier(Request $request)
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
        $data = Supplier::findOrFail($request->input('id'));

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

        return redirect()->route('supplier.create')->with('success', 'Supplier Updated Successfully.');
    }


    public function destroy(Supplier $supplier, $id)
    {
        $customer = Supplier::find($id);
        $customer->delete();
        return redirect()->route('supplier.create')->with('error', 'Supplier Deleted Successfully.');
    }
}
