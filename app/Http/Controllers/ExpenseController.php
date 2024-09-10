<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Expense;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expense = Expense::with('supplier')->get();
        $accounts = Accounts::with('account')->get();
        $supplier = Supplier::all();
        return view('admin.expense.index', compact('expense', 'supplier', 'accounts'));
    }


    public function AddNewExpense(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|exists:suppliers,name',
            'invoiceNo' => 'nullable|string',
            'date' => 'nullable|date',
            'dueDate' => 'nullable|date',
            'account' => 'required',
            'amount' => 'nullable',
            'note' => 'nullable',

        ]);
        $data = new Expense();
        $data->name = $request->input('name');
        $data->invoiceNo = $request->input('invoiceNo');
        $data->date = $request->input('date');
        $data->dueDate = $request->input('dueDate');
        $data->amount = $request->input('grandTotal');
        $data->account = $request->input('account');
        $data->note = $request->input('note');

        // dd($data);
        $data->save();
        return redirect()->route('expense.create')->with('success', 'Expense Added Successfully.');
    }


    public function UpdateExpense(Request $request)
    {
        $request->validate([
            'name' => 'required|string|exists:suppliers,name',
            'invoiceNo' => 'nullable|string',
            'date' => 'nullable|date',
            'dueDate' => 'nullable|date',
            'account' => 'required',
            'amount' => 'nullable',
            'note' => 'nullable',


        ]);

        $data = Expense::findOrFail($request->input('id'));
        $data->name = $request->input('name');
        $data->invoiceNo = $request->input('invoiceNo');
        $data->date = $request->input('date');
        $data->dueDate = $request->input('dueDate');
        $data->amount = $request->input('amount'); // Store total after VAT
        $data->account = $request->input('account');
        $data->note = $request->input('note');
        $data->save();

        return redirect()->route('expense.create')->with('success', 'Expense Updated Successfully.');
    }


    public function destroy($id)
    {
        $customer = Expense::find($id);
        $customer->delete();
        return redirect()->route('expense.create')->with('error', 'Expense Deleted Successfully.');
    }
}
