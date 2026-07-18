<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\RedirectResponse;

class InvoiceWhatsappController extends Controller
{
    public function __invoke(Invoice $invoice): RedirectResponse
    {
        $invoice->loadMissing('project.client');

        $message = implode("\n", [
            "Hello {$invoice->project->client->contact_name},",
            "",
            "Please find your invoice details below:",
            "",
            "Invoice : {$invoice->invoice_number}",
            "Issue Date : " . display_date($invoice->issue_date),
            "Due Date : " . display_date($invoice->due_date),
            "Total : " . money($invoice->total),
        ]);

        $url = sprintf(
            'https://wa.me/%s?text=%s',
            preg_replace('/\D+/', '', $invoice->project->client->phone),
            urlencode($message),
        );

        return redirect()->away($url);
    }
}