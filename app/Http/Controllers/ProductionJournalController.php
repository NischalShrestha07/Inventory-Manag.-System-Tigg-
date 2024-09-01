<?php

namespace App\Http\Controllers;

use App\Models\ProductionJournal;
use Illuminate\Http\Request;

class ProductionJournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journal = ProductionJournal::all();
        return view('admin.production_journal.index', compact('journal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function AddNewProductionJournal(Request $request)
    {
        $request->validate([
            'date' => 'nullable',
            'code' => 'nullable',
            'reference' => 'nullable',
            'product' => 'required',
            'quantity' => 'nullable',
        ]);

        $data = new ProductionJournal();
        $data->date = $request->date;
        $data->code = $request->code;
        $data->reference = $request->reference;
        $data->product = $request->product;
        $data->quantity = $request->quantity;
        $data->save();

        return redirect()->route('journal.create')->with('success', 'Production Journal Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductionJournal $productionJournal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionJournal $productionJournal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionJournal $productionJournal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionJournal $productionJournal)
    {
        //
    }
}
