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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UOM $uOM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UOM $uOM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UOM $uOM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UOM $uOM)
    {
        //
    }
}