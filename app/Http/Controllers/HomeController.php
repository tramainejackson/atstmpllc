<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;
use Carbon\Carbon;
use App\User;
use App\Mail\NewMessage;

class HomeController extends Controller
{	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('about_us', 'welcome', 'portfolio', 'message');
    }

    /**
     * Show the users dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
	    return view('welcome');
    }

    /**
     * Show the users dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$active_user = Auth::user();
		$users = User::where('company_id', $active_user->company_id)->get();
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
		$user_accounts = $user->user_accounts;
		$transactions = $user->transactions()->orderBy('created_at', 'desc')->take(10)->get();
		$last_login = session('last_login') == 'First Time Loggin In' ? session('last_login') : new Carbon(session('last_login'));
		// dd($user_accounts->isNotEmpty());
        return view('home', compact('user_accounts', 'transactions', 'user', 'last_login'));
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
		$company_users = Auth::user()->company->users;
		$user = $company_users->where('id', $id)->first();

		if($user == null || $user == '') {
			return redirect()->back()->with('status', "<li class='errorItem red progress-bar-striped'>Whooops, doesn't look like that user exist</li>");
		} else {
			return view('users.edit', compact('user'));
		}
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
			$message .= "<li class='okItem green progress-bar-striped'>User Saved Successfully</li>";
		} else {
			$message .= "<li class='okItem green progress-bar-striped'>User Account Not Updated. Please Try Updating Again</li>";
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
						$message .= "<li class='errorItem red progress-bar-striped'>The file " . $fileName . " could not be added bcause it is the wrong image type</li>";
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
					$message .= "<li class='okItem green progress-bar-striped'>Images changed successfully</li>";
				}
			} else {
				$message .= "<li class='errorItem red progress-bar-striped'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
			}
		} else {
			$message .= "<li class='errorItem red progress-bar-striped'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
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
			$message .= "<li class='okItem green progress-bar-striped'>User Saved Successfully</li>";
		} else {
			$message .= "<li class='errorItem red progress-bar-striped'>Unable to add user</li>";
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
			$message .= "<li class='okItem green progress-bar-striped'>User Deleted Successfully.</li>";
			
			if($user->user_accounts()->delete()) {
				$message .= "<li class='okItem green progress-bar-striped'>User Bank Accounts Deleted Successfully.</li>";
				
				if($user->transactions()->delete()) {
					$message .= "<li class='okItem green progress-bar-striped'>User Transactions Deleted Successfully.</li>";

					return redirect()->action('HomeController@index')->with('status', $message);
				} else {
					$message .= "<li class='errorItem red progress-bar-striped'>Unable to Delete User Transactions.</li>";

					return redirect()->action('HomeController@index')->with('status', $message);
				}
			} else {
				$message .= "<li class='errorItem red progress-bar-striped'>Unable to Delete User Bank Accounts.</li>";

				return redirect()->action('HomeController@index')->with('status', $message);
			}
		} else {
			$message .= "<li class='errorItem red progress-bar-striped'>Unable to Delete User .</li>";

			return redirect()->action('HomeController@edit', $user)->with('status', $message);
		}
    }
	
	/**
     * Show the about us page.
     *
     * @return \Illuminate\Http\Response
    */
    public function about_us()
    {
		return view('about_us');
	}

	/**
     * Show Tramaine's portfolio page.
     *
     * @return \Illuminate\Http\Response
    */
    public function portfolio()
    {
    	$now = Carbon::now();
    	$dmbDevStart = Carbon::create(2018, 8,1);
    	$freelanceDevStart = Carbon::create(2013, 1);

    	$dmbDevTime = $dmbDevStart->diffInYears($now) > 0 ? $dmbDevStart->diffInYears($now) . ' Years' : '';
    	$dmbDevTime .= $dmbDevTime != '' ? ' ' . ($dmbDevStart->diffInMonths($now) - ($dmbDevStart->diffInYears($now)*12)) . ' Months' : $dmbDevStart->diffInMonths($now) . ' Months' ;

    	$freelanceDevTime = $freelanceDevStart->diffInYears($now) . ' Years';

		return view('portfolio', compact('dmbDevTime', 'freelanceDevTime'));
	}
	
	/**
     * Send email from message left on about us page.
     *
     * @return \Illuminate\Http\Response
    */
    public function message(Request $request)
    {
		// Validate incoming data
		$this->validate($request, [
			'message_email' => 'required|max:50',
			'message_name' => 'required|max:50',
			'message_subject' => 'required|max:100',
			'message_body' => 'required|max:500',
		]);
		
		if(DB::table('messages')->insert([
			[
				'email' => $request->message_email,
				'name' => $request->message_name,
				'subject' => $request->message_subject,
				'message' => $request->message_body,
			]
		])) {
			// Send Email to Admin and Recipient
			\Mail::to($request->message_email)->send(new NewMessage($request->message_subject, $request->message_name, $request->message_email, $request->message_body));
			// \Mail::to('atstmpllc@gmail.com')->send(new NewContact($contact));
				
			return redirect()->back()->with('status', "<li class='okItem green progress-bar-striped'>Message Sent Successfully</li>");
		}
	}
}
