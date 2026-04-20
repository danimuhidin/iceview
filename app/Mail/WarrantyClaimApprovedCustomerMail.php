<?php

namespace App\Mail;

use App\Models\WarrantyItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WarrantyClaimApprovedCustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public WarrantyItem $warrantyItem;

    /**
     * Create a new message instance.
     */
    public function __construct(WarrantyItem $warrantyItem)
    {
        $this->warrantyItem = $warrantyItem;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Warranty Claim Approved Customer Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.warranties.customer_approved',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
