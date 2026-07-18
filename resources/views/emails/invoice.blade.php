<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.7; color: #374151;">

    <h2>Invoice {{ $invoice->invoice_number }}</h2>

    <p>
        Hello {{ $invoice->project->client->contact_name }},
    </p>

    <p>
        Please find your invoice attached to this email.
    </p>

    <table cellpadding="6">

        <tr>
            <td><strong>Invoice</strong></td>
            <td>{{ $invoice->invoice_number }}</td>
        </tr>

        <tr>
            <td><strong>Issue Date</strong></td>
            <td>{{ display_date($invoice->issue_date) }}</td>
        </tr>

        <tr>
            <td><strong>Due Date</strong></td>
            <td>{{ display_date($invoice->due_date) }}</td>
        </tr>

        <tr>
            <td><strong>Total</strong></td>
            <td>{{ money($invoice->total) }}</td>
        </tr>

    </table>

    <p>
        Thank you.
    </p>

    <p>
        {{ config('app.name') }}
    </p>

</body>

</html>