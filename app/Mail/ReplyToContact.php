<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyToContact extends Mailable
{
    use Queueable, SerializesModels;
    
    public $replyMessage;

    public function __construct($message)
    {
        $this->replyMessage = $message; // Rename property to avoid conflict
    }

    public function build()
    {
        return $this->subject('Reply from The Unfiltered, Global News Agency')
                    ->view('emails.replyToContact');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reply To Contact',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.replyToContact',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
