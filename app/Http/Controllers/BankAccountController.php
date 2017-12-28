<?php

namespace App\Http\Controllers;

use App\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$user = Auth::user();
		$user_name = $user->firstname . " " . $user->lastname;
		$user_id = Auth::id();
		
        return view('banks.create', compact('user_name', 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Validate incoming data
		$this->validate($request, [
			'bank_name' => 'required|max:50',
		]);
		
		// Create a new bank account instance
		$newBank = new BankAccount();
		
		$newBank->bank_name = $request->bank_name;
		$newBank->account_num = $request->account_num;
		$newBank->checking_balance = $request->checking_balance;
		$newBank->savings_balance = $request->savings_balance;
		$newBank->created_by = $request->added_by;
		
		if($newBank->save()) {
			// Create a new user account instance
			$newUserAccount = new \App\UserAccount();
			$newUserAccount->bank_account_id = $newBank->id;
			$newUserAccount->user_id = $newBank->created_by;
			$newUserAccount->checking_share = $newBank->checking_balance;
			$newUserAccount->savings_share = $newBank->savings_share;
			$newUserAccount->share_pct = 1;
			
			if($newUserAccount->save()) {
				return redirect()->action('BankAccountController@edit', $newBank)->with('status', 'Bank Added Successfully');
			}
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount, $id)
    {
		$bankAccount = BankAccount::find($id);
        return view('banks.edit', compact('bankAccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        //
    }
}
