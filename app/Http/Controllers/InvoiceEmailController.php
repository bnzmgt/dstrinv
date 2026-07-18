<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class InvoiceEmailController extends Controller
{
    public function __invoke(Invoice $invoice): RedirectResponse
    {
        Mail::to($invoice->project->client->email)
            ->send(new InvoiceMail($invoice));

        return back()->with(
            'success',
            'Invoice email sent successfully.'
        );
    }
}