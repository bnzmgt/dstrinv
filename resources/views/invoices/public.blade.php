<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Invoice {{ $invoice->invoice_number }}
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px;
            background: #f4f4f5;
            color: #222;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }

        .container {
            max-width: 960px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border: 1px solid #ddd;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            margin: 0;
        }

        p {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .section {
            margin-bottom: 32px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #666;
        }

        .small {
            font-size: 12px;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            font-size: 12px;
            font-weight: bold;
        }

        @media print {

            body {
                background: white;
                padding: 0;
            }

            .container {
                border: none;
                max-width: 100%;
                padding: 0;
            }
        }
    </style>

</head>

<body>

<div class="mx-auto max-w-5xl bg-white p-10 shadow-sm">

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