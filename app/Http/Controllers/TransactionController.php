<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\BankAccount;
use App\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;

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
		
		// Get user account selected and logged in User
		$bank_account = BankAccount::find($request->bank_id);
		
		// Get user account selected and logged in User
		$user_account = UserAccount::where([
			['bank_account_id', '=', $bank_account->id],
			['user_id', '=', Auth::id()]
		])->first();

		// Create a new transaction instance
		$trans = new Transaction();
		$date = date_create($request->trans_date);
		$trans->user_account_id = $user_account->id;
		$trans->user_id = $user_account->user_id;
		$trans->amount = $request->trans_amount;
		$trans->transaction_date = date_format($date, "Y/m/d");
		$trans->company_id = $user_account->user->company_id;
		$trans->type = $request->type;
		$message = "";
		$error = "";

		// Do if transaction type is a transfer
		if($trans->type == 'Transfer') {
			$trans->transfer_type = $request->transfer_type;
			$trans->transfer_to = $request->transfer_to;
			$trans->transfer_from = $request->transfer_from;
		} else {

			// Store picture if one was uploaded
			if($request->hasFile('receipt_photo')) {
				foreach($request->file('receipt_photo') as $newImage) {
					$fileName = $newImage->getClientOriginalName();
					
					// Check to see if images is too large
					if($newImage->getError() == 1) {
						$error .= "The file " . $fileName . " is too large and could not be uploaded";
					} elseif($newImage->getError() == 0) {
						// Check to see if images is about 25MB
						// If it is then resize it
						if($newImage->getClientSize() < 25000000) {
							if($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {
								$image = Image::make($newImage->getRealPath())->orientate();
								$path = $newImage->store('public/images');
								$image->save(storage_path('app/' . $path));

								$trans->receipt = 'Y';
								$trans->receipt_photo = str_ireplace('public/images/', '', $path);
							} else {
								$error .= "<li class='errorItem'>The file " . $fileName . " could not be added bcause it is the wrong image type</li>";
							}
						} else {
							// Resize the image before storing. Will need to hash the filename first
							$path = $newImage->store('public/images');
							$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
								$constraint->aspectRatio();
								$constraint->upsize();
							});
							$image->save(storage_path('app/'. $path));
						}
					} else {
						$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
					}
				}
			} else {
				$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
			}
			
			if($trans->type == 'Deposit') {
				$trans->account_type = $request->account_type;
				$trans->deposit_type = $request->deposit_type;
			} elseif($trans->type == 'Withdrawl') {
				$trans->account_type = $request->account_type;
				$trans->withdrawl_type = $request->withdrawl_type;
			}
		}
		
		if($trans->save()) {
			$message .= "<li class='okItem'>Transaction Added Successfully</li>";
			
			// Successful
			if($trans->type == "Purchase") {
				$message .= "<li class='okItem'>Purchase of $".$trans->amount." was saved successfully.</li>";
				$user_account->make_purchase($trans->amount, $trans->user_account_id);
			} elseif($trans->type == "Refund") {
				$message .= "<li class='okItem'>Refund of $".$trans->amount." was saved successfully.</li>";
				$user_account->make_refund($trans->amount);
			} elseif($trans->type == "Withdrawl") {
				$message .= "<li class='okItem'>Withdrawl of $".$trans->amount." was saved successfully.</li>";
				$user_account->make_withdrawl($trans->amount, $trans->withdrawl_type, $trans->user_account_id);
			} elseif($trans->type == "Deposit") {
				$message .= "<li class='okItem'>Deposit of $".$trans->amount." was saved successfully.</li>";
				$user_account->make_deposit($trans->amount, $trans->deposit_type, $trans->account_type, $trans->user_account_id);
			} elseif($trans->type == "Transfer") {
				$message .= "<li class='okItem'>Transfer of $".$trans->amount." was saved successfully.</li>";
				$user_account->make_transfer($trans->amount, $trans->transfer_type, $trans->transfer_to, $trans->transfer_from, $trans->user_account_id);
			} else {
				$message .= "<li class='errorItem'>Transaction type unrecognized.</li>";
			}
			return redirect()->action('TransactionController@show', $trans)->with('status', $message);
		} else {
			// Failure
			$message = "<li class='errorItem'>Transaction unsuccessful.</li>";
			redirect()->back()->with('status', $message);
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
        $user = Auth::user();
		$user_id = UserAccount::where('user_id', Auth::id())->first();
		$user_name = $user->firstname . " " . $user->lastname;
		$user_transactions = Transaction::where('user_account_id', $user_id->id)->get();
		
		return view('transactions.show', compact('user_name', 'user_transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $user = Auth::user();
		$user_id = Auth::id();
		$user_name = $user->firstname . " " . $user->lastname;
        $companyTransactions = Transaction::where('company_id', $user->company_id)->get();
		
		return view('transactions.edit', compact('user', 'companyTransactions'));
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
