<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();
		$user_accounts = \App\UserAccount::where('user_id', Auth::id())->get();
		$transactions = \App\Transaction::where('user_id', Auth::id())->get();
		$user_photo = $user->picture;
		$user_name = $user->firstname . " " . $user->lastname;
		$last_login = $user->last_login != null ? $user->last_login : $user->created_at;
		
        return view('home', compact('user_accounts', 'transactions', 'user_photo', 'last_login', 'user_name'));
    }
}
