<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice {{ $invoice->invoice_number }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            background: #eef2f7;
        }

        body {
            margin: 0;
            padding: 40px 0;
            background: #eef2f7;
            color: #1f2937;
            font-family: "Segoe UI", Arial, Helvetica, sans-serif;
            font-size: 13px;
            line-height: 1.6;
        }

        .invoice-document {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 18mm;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        img {
            max-width: 100%;
            height: auto;
            border: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0;
            padding: 0;
        }

        .section {
            margin-bottom: 24px;
        }

        .section:last-child {
            margin-bottom: 0;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-top {
            vertical-align: top;
        }

        .text-middle {
            vertical-align: middle;
        }

        .text-bottom {
            vertical-align: bottom;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-semibold {
            font-weight: 600;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .text-muted {
            color: #6b7280;
        }

        .small {
            font-size: 12px;
        }

        .xs {
            font-size: 11px;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border: 1px solid #d1d5db;
            border-radius: 999px;
            font-size: 11px;
            line-height: 1.3;
        }

        .border-top {
            border-top: 1px solid #d1d5db;
        }

        .border-bottom {
            border-bottom: 1px solid #d1d5db;
        }

        .mb-4 {
            margin-bottom: 4px;
        }

        .mb-8 {
            margin-bottom: 8px;
        }

        .mb-12 {
            margin-bottom: 12px;
        }

        .mb-16 {
            margin-bottom: 16px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mb-24 {
            margin-bottom: 24px;
        }

        .mt-8 {
            margin-top: 8px;
        }

        .mt-12 {
            margin-top: 12px;
        }

        .mt-16 {
            margin-top: 16px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .mt-24 {
            margin-top: 24px;
        }

        .avoid-break {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .keep-together {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .page-break {
            break-before: page;
            page-break-before: always;
        }

        @page {
            size: A4;
            margin: 18mm;
        }

        @media print {

            html,
            body {
                background: #ffffff;
                padding: 0;
                margin: 0;
            }

            .invoice-document {
                width: auto;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
        }

        @media (max-width: 960px) {

            body {
                padding: 16px;
            }

            .invoice-document {
                width: 100%;
                min-height: auto;
                padding: 24px;
            }
        }
    </style>

</head>

<body>

<div class="invoice-document">

    @include('invoices.partials.header')

    @include('invoices.partials.client')

    @include('invoices.partials.project')

    @include('invoices.partials.items-table')

    @include('invoices.partials.totals')

    @include('invoices.partials.payment-summary')

    @include('invoices.partials.footer')

</div>

</body>

</html>