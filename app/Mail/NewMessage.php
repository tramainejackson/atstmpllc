<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

	public $subject;
	public $name;
	public $email;
	public $body;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject="", $name="", $email="", $body="")
    {
        $this->subject = $subject == null ? 'ATSTMPLLC New Message' : $subject;
        $this->name = $subject == null ? 'New Message Name Was Empty' : $name;
        $this->email = $subject == null ? 'New Message Email Was Empty' : $email;
        $this->body = $subject == null ? 'New Message Was Empty' : $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('emails.new_message', compact('email', 'body', 'name'));
    }
}
