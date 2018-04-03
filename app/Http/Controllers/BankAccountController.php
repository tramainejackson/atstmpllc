<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\UserAccount;
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
        $user = Auth::user();
		$user_id = Auth::id();
		$user_name = $user->firstname . " " . $user->lastname;
		$userAccounts = UserAccount::where("user_id", $user_id)->get();
		
        return view('banks.index', compact('user_name', 'userAccounts'));
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
		// dd($request);
		// Validate incoming data
		$this->validate($request, [
			'bank_name' => 'required|max:50',
		]);
		
		// Create a new bank account instance
		$newBank = new BankAccount();
		
		$newBank->company_id = Auth::user()->company_id;
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
			$newUserAccount->savings_share = $newBank->savings_balance;
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
    public function edit($id)
    {
		$company_banks = Auth::user()->company->bank_accounts;
		$bankAccount = $company_banks->where('id', $id)->first();
		
		if($bankAccount == null || $bankAccount == '') {
			return redirect()->back()->with('status', "<li class='errorItem red progress-bar-striped'>Whooops, doesn't look like that bank exist</li>");
		} else {
			// $bankAccount = BankAccount::find($id);
			$editBankUsers = UserAccount::where("bank_account_id", $bankAccount->id)->get();
			$bankTransactions = $bankAccount->transactions;
			$bankUsers = $bankAccount->user_accounts;
			
			return view('banks.edit', compact('bankAccount', 'editBankUsers', 'bankTransactions', 'bankUsers'));
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
		// dd($request);
		$message = "";
        $bankAccount = BankAccount::find($id);
		$bankAccount->bank_name = $request->bank_name;
		$bankAccount->account_num = $request->account_num;
		$bankAccount->checking_balance = $request->checking_balance;
		$bankAccount->savings_balance = $request->savings_balance;
		// $bankAccount->recreate_shares();

		if($bankAccount->save()) {
			$message .= "<li class='okItem green progress-bar-striped'>Bank information saved</li>";
		} else {
			$message .= "<li class='errorItem red progress-bar-striped'>Bank information not updated. Please try saving again</li>";
		}

		return redirect()->action('BankAccountController@edit', $bankAccount)->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$bankAccount = BankAccount::find($id);
		$message = "";

		if($bankAccount->delete()) {
			$message = "<li class='okItem green progress-bar-striped'>".$bankAccount->bank_name." Deleted Successfully</li>";
			
			if($bankAccount->user_accounts()->delete()) {
				$message = "<li class='okItem green progress-bar-striped'>Individual Accounts Deleted Successfully</li>";
			}
		} else {
			
		}
		
		return redirect()->action('BankAccountController@index')->with('status', $message);
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \App\UserAccount  $userAccount
     * @return \Illuminate\Http\Response
     */
    public function bank_accounts(BankAccount $bankAccount)
    {
		$company_banks = Auth::user()->company->bank_accounts;
		$bankAccount = $company_banks->where('id', $bankAccount->id)->first();
		
		if($bankAccount == null || $bankAccount == '') {
			return redirect()->back()->with('status', "<li class='errorItem red progress-bar-striped'>Whooops, doesn't look like that bank exist</li>");
		} else {
			$bank_accounts = $bankAccount->user_accounts;
			
			return view('banks.bank_users', compact('bank_accounts', 'bankAccount'));
		}
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \App\UserAccount  $userAccount
     * @return \Illuminate\Http\Response
     */
    public function bank_remove(BankAccount $bankAccount)
    {
		return view('banks.remove', compact('bankAccount'));
    }
}
