<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class InvoicePublicController extends Controller
{
    public function __invoke(Request $request, Invoice $invoice): View
    {
        if (! $request->hasValidSignature()) {
            throw new AccessDeniedHttpException('Invalid or expired invoice link.');
        }

        $invoice->loadMissing([
            'project.client',
            'items',
            'payments',
        ]);

        return view('invoices.public', [
            'invoice' => $invoice,
        ]);
    }
}