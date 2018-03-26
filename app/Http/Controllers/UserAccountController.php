<?php

namespace App\Http\Controllers;

use App\UserAccount;
use App\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;

class UserAccountController extends Controller
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
    public function create(BankAccount $bankAccount)
    {
		$company_users = $bankAccount->company->users;

        return view('accounts.bank.create', compact('bankAccount', 'company_users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BankAccount $bankAccount)
    {
		$new_user = $bankAccount->user_accounts()->create([
			'user_id' => $request->user_id,
			'edit_bank' => $request->edit_bank,
		]);
		
        return redirect()->action('BankAccountController@bank_accounts', compact('bankAccount'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserAccount  $userAccount
     * @return \Illuminate\Http\Response
     */
    public function show(UserAccount $userAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserAccount  $userAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAccount $userAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserAccount  $userAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
		$bank_accounts = $bankAccount->user_accounts;
		$totalCurrentShare = 0;
		$message = "";
		
		foreach($request->ownership as $share_pct) {
			$totalCurrentShare += $share_pct;
		}
		
		if($totalCurrentShare > 100) {
			$message .= "<li class='errorItem'>Total percent share cannot total more than 100%</li>";
			
			return redirect()->back()->with(['status' => $message]);
		} else {
			foreach($request->user as $key => $value) {
				// Get user account
				$userAccount = UserAccount::find($value);
				$userAccount->share_pct = number_format($request->ownership[$key] / 100, 2);
				$userAccount->edit_bank = $request->edit_bank[$key];
				$userAccount->checking_share = $userAccount->share_pct * $bankAccount->checking_balance;
				$userAccount->savings_share = $userAccount->share_pct * $bankAccount->savings_balance;

				if($userAccount->save()) {
					$message .= "<li class='okItem'>Updates made to user " . $userAccount->user->firstname . "</li>";
				} else {
					$message .= "<li class='errorItem'>No changes made to user " . $userAccount->user->firstname . "</li>";
				}
			}
			
			// Recreate shares here
			$bankAccount->recreate_shares();
			
			return redirect()->back()->with(['status' => $message, 'bank_accounts' => $bank_accounts, 'bankAccount' => $bankAccount]);
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserAccount  $userAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAccount $userAccount)
    {
        if($userAccount->delete()) {
			$message = "<li class='okItem'>".$userAccount->user->firstname." Remove From Bank Successfully</li>";
		} else {
			$message = "<li class='errorItem'>".$userAccount->user->firstname." Unable To Be Removed From Bank. Please Try Again</li>";
			return redirect()->action('UserAccountController@bank_accounts')->with('status', $message);
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
		$bank_accounts = $bankAccount->user_accounts;
		
		return view('accounts.bank.bank_users', compact('bank_accounts', 'bankAccount'));
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \App\UserAccount  $userAccount
     * @return \Illuminate\Http\Response
     */
    public function user_account_remove(UserAccount $userAccount)
    {
		return view('accounts.bank.remove_user', compact('userAccount'));
    }

	/**
     * Get the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function user_transactions(UserAccount $userAccount)
    {
        $user_transactions = $userAccount->transactions->sortByDesc('transaction_date');
		$user_name = $userAccount->user->full_name();

		return view('transactions.show', compact('user_transactions', 'user_name'));
    }
}
