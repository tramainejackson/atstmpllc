<?php

namespace App\Mail;

use App\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentReminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
	* The website instance
	*
	* @var website
	*/
	public $website;
	public $renew_date;
	public $last_paid_date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Website $website)
    {
        $this->website = $website;
	    $this->renew_date = new Carbon($website->renew_date);
	    $this->last_paid_date = new Carbon($website->last_paid_date);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->view('emails.payment_reminder', compact('website', 'renew_date', 'last_paid_date'));
    }
}
