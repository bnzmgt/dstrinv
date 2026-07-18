<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Invoice {{ $invoice->invoice_number }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 12mm;
        }



        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
            padding: 10mm;
            color: #1f2937;
            background: #ffffff;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 18px;
            box-sizing: border-box;
        }

        .invoice-document {
            max-width: 210mm;
            min-height: 297mm;
            margin: auto;
            font-size: 16px;
            line-height: 18px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
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

        h1{
            font-size:26px;
        }

        h2{
            font-size:18px;
        }

        h3{
            font-size:14px;
        }

        .section {
            margin-bottom: 18px;
            max-width: 210mm;
            box-sizing: border-box;
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
            font-weight: bold;
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
            font-size: 10px;
        }

        .xs {
            font-size: 9px;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border: 1px solid #d1d5db;
            border-radius: 20px;
            font-size: 10px;
            line-height: 1.2;
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

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        tr {
            page-break-inside: avoid;
        }

        td,
        th {
            vertical-align:top;
        }

        .avoid-break {
            page-break-inside: avoid;
        }

        .page-break {
            page-break-before: always;
        }

        .keep-together {
            page-break-inside: avoid;
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