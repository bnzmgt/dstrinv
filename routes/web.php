<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoicePreviewController;
use App\Http\Controllers\InvoicePrintController;
use App\Http\Controllers\InvoicePdfController;
use App\Http\Controllers\InvoiceDownloadController;
use App\Http\Controllers\InvoiceWhatsappController;
use App\Http\Controllers\InvoicePublicController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/share/invoices/{invoice}', InvoicePublicController::class)
    ->middleware('signed')
    ->name('invoices.share');

Route::middleware(['auth'])
    ->prefix('invoices')
    ->name('invoices.')
    ->group(function () {

        Route::get('{invoice}/preview', InvoicePreviewController::class)
            ->name('preview');

        Route::get('{invoice}/print', InvoicePrintController::class)
            ->name('print');

        Route::get('{invoice}/pdf', InvoicePdfController::class)
            ->name('pdf');
        
        Route::get('{invoice}/download', InvoiceDownloadController::class)
            ->name('download');

      

        Route::get('{invoice}/whatsapp', InvoiceWhatsappController::class)
            ->name('whatsapp');

    });