<?php

namespace App\Mail;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public Invoice $invoice,
    ) {
        $this->invoice->loadMissing([
            'project.client',
            'items',
            'payments',
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Invoice {$this->invoice->invoice_number}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
        );
    }

    public function attachments(): array
    {
        $pdf = Pdf::loadView('invoices.pdf', [
            'invoice' => $this->invoice,
        ]);

        return [
            Attachment::fromData(
                fn () => $pdf->output(),
                "{$this->invoice->invoice_number}.pdf",
            )->withMime('application/pdf'),
        ];
    }
}