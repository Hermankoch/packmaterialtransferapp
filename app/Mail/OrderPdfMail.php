<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPdfMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $logo;
    /**
     * Create a new message instance.
     */
    public function __construct($order, $logo)
    {
        $this->order = $order;
        $this->logo = $logo;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Pdf Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $content = new Content(
            view: 'emails.order',
        );
        return $content;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = PDF::loadView('pdf.order-pdf', ['order' => $this->order, 'logo' => $this->logo]);
        $name = $this->order->reference;

        return [
            Attachment::fromData(fn () => $pdf->output(), $name.'.pdf')->withMime('application/pdf')
        ];
    }
}
