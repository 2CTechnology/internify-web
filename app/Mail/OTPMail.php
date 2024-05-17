<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;
    private $param;
    /**
     * Create a new message instance.
     */
    public function __construct($param)
    {
        $this->param = $param;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'OTP Lupa Password Internify',
        );
    }

    public function build()
    {
        return $this->subject('Email Verification')
            ->view('mail.email', ['param' => $this->param]);
    }
}
