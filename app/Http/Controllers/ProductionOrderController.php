<?php

namespace App\Http\Controllers;

use App\Models\ProductionOrder;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class ProductionOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = ProductionOrder::all();
        return view('admin.production_order.index', compact('order'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function AddNewProductionOrder(Request $request)
    {
        $request->validate([
            'date' => 'nullable',
            'code' => 'nullable',
            'reference' => 'nullable|string',
            'product' => 'required|string',
            'quantity' => 'nullable',
            'status' => 'nullable',
        ]);

        $data = new ProductionOrder();
        $data->date = $request->input('date');
        $data->code = $request->input('code');
        $data->reference = $request->input('reference');
        $data->product = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->status = $request->input('status');
        $data->save();

        return redirect()->route('order.create')->with('success', 'Production Order Added Successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function UpdateProductionOrder(Request $request, ProductionOrder $productionOrder)
    {
        $request->validate([
            'date' => 'nullable',
            'code' => 'nullable',
            'reference' => 'nullable|string',
            'product' => 'required|string',
            'quantity' => 'nullable',
            'status' => 'nullable',
        ]);

        $data = ProductionOrder::find($request->input('id'));
        $data->date = $request->input('date');
        $data->code = $request->input('code');
        $data->reference = $request->input('reference');
        $data->product = $request->input('product');
        $data->quantity = $request->input('quantity');
        $data->status = $request->input('status');
        $data->save();

        return redirect()->route('order.create')->with('success', 'Production Order Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionOrder $productionOrder, $id)
    {
        $data = ProductionOrder::find($id);
        $data->delete();

        return redirect()->route('order.create')->with('success', 'Production Order Deleted Successfully.');
    }
}
