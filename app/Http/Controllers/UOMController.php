<?php

namespace App\Http\Controllers;

use App\Models\UOM;
use Illuminate\Http\Request;

class UOMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uoms = UOM::all();
        return view('admin.uom.index', compact('uoms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddNewUom(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'shortname' => 'nullable|string',
        ]);
        $data = new UOM();
        $data->name = $request->name;
        $data->shortname = $request->shortname;
        $data->save();
        // dd($data);

        return redirect()->route('uom.create')->with('success', 'Product Added Successfully.');
    }



    public function UpdateUOM(Request $request, UOM $uOM)
    {
        $request->validate([
            'name' => 'required|string',
            'shortname' => 'nullable|string',
        ]);
        $data = UOM::findOrFail($request->input('id'));
        $data->name = $request->name;
        $data->shortname = $request->shortname;
        $data->save();
        // dd($data);

        return redirect()->route('uom.create')->with('success', 'Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UOM $uOM, $id)
    {
        $uoms = UOM::findOrFail($id);
        $uoms->delete();

        return redirect()->route('uom.create')->with('error', 'UOM Deleted Successfully.');
    }
}
