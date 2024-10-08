<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Expense;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();

        if ($request->filled('name')) {
            $query->where('name', $request->input('name'));
            // fetching by the name column not by the id as in DB the name is of string type which means id can't be stored in string as it is integer.
        }

        if ($request->filled('account')) {
            $query->where('account', $request->input('account'));
        }



        // $expense = $query->with('supplier')->get();
        $expense = $query->get();
        // $accounts = Accounts::with('account')->get();
        $accounts = Accounts::all();
        $supplier = Supplier::all();
        // dd($query->toSql(), $query->getBindings());

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
            'account' => 'nullable',
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
            'account' => 'nullable',
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
