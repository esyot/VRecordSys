<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendAuthentication extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $code;

    public function __construct($name, $email, $code)
    {
        $this->name = $name;
        $this->email = $email;
        $this->code = $code;
    }

    public function build()
    {
        return $this->view('emails.authentication')->with(['name' => $this->name, 'email' => $this->email, 'code' => $this->code])
            ->subject('Authentication Code');
    }


}
