<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;

class InvoicePreviewController extends Controller
{
    public function __invoke(Invoice $invoice): View
    {
        $invoice->loadMissing([
            'project.client',
            'items',
            'payments',
        ]);

        return view('invoices.preview', [
            'invoice' => $invoice,
        ]);
    }
}