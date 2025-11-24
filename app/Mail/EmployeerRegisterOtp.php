<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmployeerRegisterOtp extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $otp;  // Ensure OTP is public to be accessed in the Blade file

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $otp)
    {
        

        $this->subject = $subject;
        $this->otp = $otp;
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.employeerregisterotp',
            with: [
                'otp' => $this->otp, // Ensure OTP is passed correctly
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
