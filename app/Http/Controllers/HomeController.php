<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;
use App\User;

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
     * Show the users dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$active_user = Auth::user();
		$users = \App\User::where('company_id', $active_user->company_id)->get();
		$user_photo = $active_user->picture;
		$user_name = $active_user->firstname . " " . $active_user->lastname;
		
        return view('users.index', compact('active_user', 'user_name', 'user_photo', 'users'));
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function home()
    {
		$user = Auth::user();
		$user_accounts = \App\UserAccount::where('user_id', Auth::id())->get();
		$transactions = \App\Transaction::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(10)->get();
		$user_name = $user->firstname . " " . $user->lastname;
		$date = explode('-', $user->last_login != null ? str_ireplace(' ', '-', $user->last_login) : str_ireplace(' ', '-', $user->created_at));
		$last_login = \Carbon\Carbon::createFromDate($date[0], $date[1], $date[2]);
		
        return view('home', compact('user_accounts', 'transactions', 'user_name', 'user', 'last_login'));
    }
	
	/**
     * Show the create page.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {		
        return view('users.create');
    }
	
	/**
     * Show the create page.
     *
     * @return \Illuminate\Http\Response
    */
    public function show()
    {		
        return view('users.create');
    }
	
	/**
     * Show the edit page for selected user
    */
    public function edit($id)
    {		
		$user = User::find($id);
		
        return view('users.edit', compact('user'));
    }
	
	/**
     * Show the edit page for selected user
    */
    public function update(Request $request, $id)
    {		
		// Validate incoming data
		$message = "";
		$this->validate($request, [
			'email' => 'required|max:50|unique:users,email,'.$id,
			'firstname' => 'required|max:30',
			'lastname' => 'required|max:30',
		]);
		
		// Find current user instance
		$current_user = Auth::user();
		$user = User::find($id);
		
		$user->email = $request->email;
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->editable = $request->editable;
		
		if($request->password != null) {
			$user->password = bcrypt($request->password);			
		}

		if($user->save()) {
			$message .= "<li class='okItem'>User Saved Successfully</li>";
		} else {
			$message .= "<li class='okItem'>User Account Not Updated. Please Try Updating Again</li>";
		}

		return redirect()->action('HomeController@edit', $user)->with('status', $message);			
    }
	
	/**
     * Show the edit page for selected user
    */
    public function update_image(Request $request, User $user)
    {		
		$message = "";
		
		// Store picture if one was uploaded
		if($request->hasFile('profile_img')) {
			$newImage = $request->file('profile_img');
			$fileName = $newImage->getClientOriginalName();
			
			// Check to see if images is too large
			if($newImage->getError() == 1) {
				$message .= "The file " . $fileName . " is too large and could not be uploaded";
			} elseif($newImage->getError() == 0) {
				// Check to see if images is about 25MB
				// If it is then resize it
				if($newImage->getClientSize() < 25000000) {
					if($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {
						$image = Image::make($newImage->getRealPath())->orientate();
						$path = $newImage->store('public/images');
						$image->save(storage_path('app/' . $path));

						$user->picture = str_ireplace('public/images/', '', $path);
					} else {
						$message .= "<li class='errorItem'>The file " . $fileName . " could not be added bcause it is the wrong image type</li>";
					}
				} else {
					// Resize the image before storing. Will need to hash the filename first
					$path = $newImage->store('public/images');
					$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});
					
					$image->save(storage_path('app/'. $path));
					$user->picture = str_ireplace('public/images/', '', $path);
				}
				
				if($user->save()) {
					$message .= "<li class='okItem'>Images changed successfully</li>";
				}
			} else {
				$message .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
			}
		} else {
			$message .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
		}

		return redirect()->action('HomeController@home')->with('status', $message);			
    }
	
	/**
     * Store the new user.
     *
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
		$message = "";
		// Validate incoming data
		$this->validate($request, [
			'email' => 'required|max:50|unique:users',
			'username' => 'required|max:30|unique:users',
			'firstname' => 'required|max:30',
			'lastname' => 'required|max:30',
			'password' => 'required|min:6',
		]);
		
		$current_user = Auth::user();

		// Create new user instance
		$newUser = new User();
		$newUser->username = $request->username;
		$newUser->password = bcrypt($request->password);
		$newUser->email = $request->email;
		$newUser->firstname = $request->firstname;
		$newUser->lastname = $request->lastname;
		$newUser->editable = $request->editable;
		$newUser->company_id = $current_user->company_id;

		if($newUser->save()) {
			$message .= "<li class='okItem'>User Saved Successfully</li>";
		} else {
			$message .= "<li class='errorItem'>Unable to add user</li>";
		}
		
		return redirect()->action('HomeController@edit', $newUser)->with('status', $message);
    }
	
	/**
     * Show the create page.
     *
     * @return \Illuminate\Http\Response
    */
    public function destroy(User $user)
    {		
		$message = "";
		
		if($user->delete()) {
			$message .= "<li class='okItem'>User Deleted Successfully.</li>";
			
			if($user->user_accounts()->delete()) {
				$message .= "<li class='okItem'>User Bank Accounts Deleted Successfully.</li>";
				
				if($user->transactions()->delete()) {
					$message .= "<li class='okItem'>User Transactions Deleted Successfully.</li>";

					return redirect()->action('HomeController@index')->with('status', $message);
				} else {
					$message .= "<li class='errorItem'>Unable to Delete User Transactions.</li>";

					return redirect()->action('HomeController@index')->with('status', $message);
				}
			} else {
				$message .= "<li class='errorItem'>Unable to Delete User Bank Accounts.</li>";

				return redirect()->action('HomeController@index')->with('status', $message);
			}
		} else {
			$message .= "<li class='errorItem'>Unable to Delete User .</li>";

			return redirect()->action('HomeController@edit', $user)->with('status', $message);
		}
    }
}
