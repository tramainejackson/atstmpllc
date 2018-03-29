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
		$user_name = $user->full_name();
        $companyTransactions = Transaction::where('company_id', $user->company_id)->orderBy('created_at', 'desc')->paginate('15');
        $totalCompanyTransactions = Transaction::where('company_id', $user->company_id)->count();
		
		return view('transactions.index', compact('user', 'companyTransactions', 'totalCompanyTransactions'));
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
			'trans_amount' => 'required|min:0.01|numeric',
			'trans_date' => 'required',
		]);
		
		// Get user account selected and bank account
		$bank_account = BankAccount::find($request->bank_id);
		$user_account = UserAccount::where([
			['bank_account_id', '=', $bank_account->id],
			['user_id', '=', Auth::id()]
		])->first();

		// Create a new transaction instance
		$trans = new Transaction();
		$trans->user_account_id = $user_account->id;
		$trans->bank_account_id = $bank_account->id;
		$trans->user_id = $user_account->user_id;
		$trans->amount = $request->trans_amount;
		$trans->description = $request->description;
		$trans->transaction_date = $request->trans_date_submit;
		$trans->company_id = $user_account->user->company_id;
		$trans->type = $request->type;
		$message = "";
		$error = "";

		// Do if transaction type is a transfer
		if($trans->type == 'Transfer') {
			$trans->transfer_type = $request->transfer_type;
			
			if($trans->transfer_type == 'user') {
				$trans->transfer_to = $request->transfer_to;
				$trans->transfer_from = 'checking';
			} else {
				$trans->transfer_to = substr_count($request->transfer_to, 's') > 0 ? 'savings' : 'checking';
				$trans->transfer_from = substr_count($request->transfer_from, 's') > 0 ? 'savings' : 'checking';
			}
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
				$error .= "<li class='errorItem'>The uploaded file may be corrupt and could not be uploaded</li>";
			}
			
			if($trans->type == 'Deposit') {
				$trans->account_type = $request->account_type;
			} elseif($trans->type == 'Withdrawl') {
				$trans->withdrawl_type = $request->withdrawl_type;
			}
		}
		
		if($trans->save()) {
			$message .= "<li class='okItem'>Transaction Added Successfully</li>";
			
			// Successful
			if($trans->type == "Purchase") {
				$message .= "<li class='okItem'>Purchase of $".$trans->amount." was saved successfully.</li>";
				$bank_account->make_purchase($trans->amount);
			} elseif($trans->type == "Refund") {
				$message .= "<li class='okItem'>Refund of $".$trans->amount." was saved successfully.</li>";
				$bank_account->make_refund($trans->amount);
			} elseif($trans->type == "Withdrawl") {
				$message .= "<li class='okItem'>Withdrawl of $".$trans->amount." was saved successfully.</li>";
				$bank_account->make_withdrawl($trans->amount, $trans->withdrawl_type);
			} elseif($trans->type == "Deposit") {
				$message .= "<li class='okItem'>Deposit of $".$trans->amount." was saved successfully.</li>";
				$bank_account->make_deposit($trans->amount, $trans->account_type);
			} elseif($trans->type == "Transfer") {
				$message .= "<li class='okItem'>Transfer of $".$trans->amount." was saved successfully.</li>";
				$bank_account->make_transfer($trans->amount, $trans->transfer_type, $trans->transfer_to, $trans->transfer_from, $trans->user_account_id);
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
		$user_account = $transaction->user_account;
		$user_name = $user_account->user->full_name();
		$user_transactions = $user_account->transactions->sortBy('transaction_date');
		$totalUserTransactions = $user_account->user->transactions->count();
		
		return view('transactions.show', compact('user_name', 'user_transactions', 'totalUserTransactions'));
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
    public function destroy(Request $request)
    {
		$removed_transactions = $request->removeTransaction;
		$counter = 0;
		
		// Remove each transaction. Add the amount of the transaction back to
		// the bank or remove the amount if transaction is deposit. Then 
		// recreate the bank shares
		foreach($removed_transactions as $trans) {
			// Get the transaction
			$trans = Transaction::find($trans);
			
			// Delete the transaction
			if($trans->delete()) {
				$counter++;
				$bank = $trans->bank_account;
				$type = $trans->type;
				
				if($type == 'Deposit') {
					$bank->checking_balance -= $trans->amount;
				} elseif($type == 'Transfer') {
					
					if($trans->transfer_type == 'user') {
						// Get the user that the money was transfered to
						$transferedTo = $bank->user_accounts()->find($trans->transfer_to);
						$transferedTo->checking_share -= $trans->amount;
						$trans->user_account->checking_share += $trans->amount;
						
						if($transferedTo->save()) {
							if($trans->user_account->save()) {}
						}
					} else {
						if($trans->transfer_to == 'checking' && $trans->transfer_from == 'savings') {
							$bank->checking_balance -= $trans->amount;
							$bank->savings_balance += $trans->amount;
						} elseif($trans->transfer_from == 'checking' && $trans->transfer_to == 'savings') {
							$bank->checking_balance += $trans->amount;
							$bank->savings_balance -= $trans->amount;
						}
					}
				} else {
					$bank->checking_balance += $trans->amount;
				}
				
				// Save bank after balance adjested
				if($bank->save()) {
					$bank->recreate_shares();
				}
			}
		}
		
		return redirect()->back()->with('status', $counter . ' transaction(s) removed successfully');
    }
}
