<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SollecitoPrestito extends Mailable
{
    use Queueable, SerializesModels;

    public $prestito;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($prestito, $user)
    {
        $this->prestito = $prestito;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('test.sollecito@sticazzi.com', 'Bubula'),
            subject: 'Sollecito Prestito',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.sollecito',
            with: [
                'user' => $this->user,
                'prestito' => $this->prestito,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
