<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\BankAccount;
use App\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
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
        $companyTransactions = Transaction::where('company_id', $user->company_id)->get();
		
		return view('transactions.index', compact('user', 'companyTransactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
		$user_id = Auth::id();
		$user_name = $user->firstname . " " . $user->lastname;
        $userAccounts = UserAccount::where('user_id', $user_id)->get();
        $companyTransactions = Transaction::where('company_id', $user->company_id)->get();
		
		return view('transactions.create', compact('user', 'userAccounts', 'companyTransactions'));
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
			'trans_amount' => 'min:0.01|numeric',
		]);
		
		// Get bank selected and logged in User
		$bank = BankAccount::find($request->bank_id);
		$current_user = Auth::user();

		// Create a new transaction instance
		$trans = new Transaction();
		$trans->user_id = Auth::id();
		$trans->company_id = $current_user->company_id;
		$trans->bank_account_id = $bank->id;
		$trans->amount = $request->trans_amount;
		$trans->date = $request->trans_date;
		$trans->type = $request->type;

		// Do if transaction type is a transfer
		if($trans->type == 'Transfer') {
		$trans->account_type = $request->account_type;
		$trans->transfer_type = $request->transfer_type;
		$trans->transfer_to = isset($_POST["transfer_to"]) ? (substr_count($_POST["transfer_to"], "user") > 0 ? str_ireplace("user_", "", $_POST["transfer_to"]) : str_ireplace("account_", "", $_POST["transfer_to"])) : null;
			
		} else {
			// $trans->receipt_photo   = isset($_FILES["receipt_photo"]) ? $trans->checkNewPicture($_FILES["receipt_photo"]) : "";

			// if($trans->receipt_photo != "" || $trans->receipt_photo != false) {
				// $trans->receipt_photo = $trans->receipt_photo[1];
				// $trans->receipt = "Y";
			// } else {
				// $trans->receipt = "N";
			// }
			
			if($trans->type == 'Deposit') {
				$trans->deposit_type = $request->deposit_type;
			} elseif($trans->type == 'Withdrawl') {
				$trans->withdrawl_type = $request->withdrawl_type;
			}
		}
		

        dd($trans);
		if($trans->save()) {
			// Successful
			$message = "Transaction added successfully.";
			if($trans->type == "Purchase") {
				$message = "Purchase of $".$trans->amount." was saved successfully.";
				$session->message("<li class='okItem'>Purchase of $".$trans->amount." was saved successfully.</li>");
				$bank->make_purchase($trans->amount);
				redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
			} elseif($trans->type == "Refund") {
				$message = "Refund of $".$trans->amount." was saved successfully.";
				$session->message("<li class='okItem'>Refund of $".$trans->amount." was saved successfully.</li>");
				$bank->make_refund($trans->amount);
				redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
			} elseif($trans->type == "Withdrawl") {
				$message = "Withdrawl of $".$trans->amount." was saved successfully.";
				$session->message("<li class='okItem'>Withdrawl of $".$trans->amount." was saved successfully.</li>");
				$bank->make_withdrawl($trans->amount, $trans->withdrawl_type, $trans->account_type, $session->user_id);
				redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
			} elseif($trans->type == "Deposit") {
				$message = "Deposit of $".$trans->amount." was saved successfully.";
				$session->message("<li class='okItem'>Deposit of $".$trans->amount." was saved successfully.</li>");
				$bank->make_deposit($trans->amount, $trans->deposit_type, $trans->account_type, $session->user_id);
				redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
			} elseif($trans->type == "Transfer") {
				$message = "Transfer of $".$trans->amount." was saved successfully.";
				$session->message("<li class='okItem'>Transfer of $".$trans->amount." was saved successfully.</li>");
				$bank->make_transfer($trans->amount, $trans->transfer_type, $trans->transfer_to, $trans->account_type, $session->user_id);
				redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
			} else {
				$session->message("<li class='errorItem'>Transaction type unrecognized.</li>");
				redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
			}
		} else {
			// Failure
			$session->message("<li class='errorItem'>Transaction unsuccessful.</li>");
			redirect_to("transactions.php?view_transactions&id=" . $current_user->user_id);
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
