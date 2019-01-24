<?php

namespace App\Http\Controllers;

use App\Website;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\PaymentReminder;

class WebsiteController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$websites = Website::all();

        return view('websites.index', compact('websites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('websites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $website = new Website();

        $website->name = $request->name;
        $website->link = $request->link;
        $website->owner = $request->owner;
	    $website->owner_email = $request->owner_email;
        $website->renew_date = $request->renew_date;

    	if($website->save()) {
		    return redirect()->action('WebsiteController@edit', ['website' => $website->id])->with('status', 'New Website Added Successfully');
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
	    return view('websites.edit', compact('website'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
	    $website->name = $request->name;
	    $website->link = $request->link;
	    $website->owner = $request->owner;
	    $website->owner_email = $request->owner_email;
	    $website->renew_date = $request->renew_date;
	    $website->last_paid_date = $request->last_paid_date;

	    if($website->save()) {
		    return redirect()->back()->with('status', 'Website Info Updated Successfully');
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function payment_reminder(Website $website)
    {
	    // Send Email to Admin and Recipient
	    \Mail::to($website->owner_email)->send(new PaymentReminder($website));

        return redirect()->back()->with('status', 'Email Sent Successfulle');
    }
}
