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

		// Recreate shares here
		//
		
        return view('bank.index', compact('bankAccount', 'new_user'));
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
    public function update(Request $request, UserAccount $userAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserAccount  $userAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAccount $userAccount)
    {
        //
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
		
		return view('accounts.bank.bank_users', compact('bank_accounts'));
    }

}
