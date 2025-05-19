<?php

namespace Webkul\Shop\Mail;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;

class ProductRegistration extends Mailable
{
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $productRegistration) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: [
                new Address(
                    core()->getAdminEmailDetails()['email'],
                    core()->getAdminEmailDetails()['name']
                ),
            ],
            subject: 'Product Registration: '.$this->productRegistration['name'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'shop::emails.product-registration',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        if(isset($this->productRegistration['file_path'])) {
            return [
                Attachment::fromPath($this->productRegistration['file_path']),
            ];
        } else {
            return  [];
        }
    }
}
