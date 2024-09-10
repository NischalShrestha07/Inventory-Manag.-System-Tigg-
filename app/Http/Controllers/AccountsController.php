<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{

    public function index()
    {
        $accounts = Accounts::all();
        return view('admin.account.index', compact('accounts'));
    }


    public function AddNewAccount(Accounts $account, Request $request)
    {
        $request->validate([
            'account' => 'required|string',


        ]);
        $data = new Accounts();
        $data->account = $request->input('account');

        // dd($data);
        $data->save();
        return redirect()->route('account.create')->with('success', 'account Added Successfully.');
    }


    public function UpdateAccount(Request $request, Accounts $account)
    {
        $request->validate([
            'account' => 'required|string',


        ]);
        $data = Accounts::findOrFail($request->input('id'));

        $data->account = $request->input('account');

        $data->save();

        return redirect()->route('account.create')->with('success', 'Account Updated Successfully.');
    }


    public function destroy(Accounts $account, $id)
    {
        $account = Accounts::find($id);
        $account->delete();
        return redirect()->route('account.create')->with('error', 'Account Deleted Successfully.');
    }
}
