<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\Response;

class InvoicePdfController extends Controller
{
    public function __invoke(Invoice $invoice): Response
    {
        $invoice->loadMissing([
            'project.client',
            'items',
            'payments',
        ]);

        $pdf = Pdf::loadView('invoices.pdf', [
            'invoice' => $invoice,
        ]);

        return $pdf->stream(
            $invoice->download_filename
        );
    }
}