@php
    $logo = str_contains(request()->route()?->getName() ?? '', 'pdf')
        ? public_path('images/logo.png')
        : asset('images/logo.png');
@endphp



<div class="section">

    <table>

        <tr>

            <td style="width:58%; vertical-align:top; padding-right:24px;">

                <img src="{{ $logo }}" alt="Company Logo" style="width: 200px;">

            </td>

            <td style="width:42%; vertical-align:top;" class="text-right">

                <div style="font-size:26px; font-weight:bold; letter-spacing:1px; color:#111827;">
                    INVOICE
                </div>

                <table style="margin-top:14px; width:100%; border-collapse:collapse;">

                    <tr>
                        <td class="small text-muted" style="padding:4px 0; width:42%;">
                            Invoice No
                        </td>

                        <td class="text-right" style="padding:4px 0;">
                            <strong>{{ $invoice->invoice_number }}</strong>
                        </td>
                    </tr>

                    <tr>
                        <td class="small text-muted" style="padding:4px 0;">
                            Status
                        </td>

                        <td class="text-right" style="padding:4px 0;">
                            <span class="badge">
                                {{ $invoice->status?->label() ?? '-' }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="small text-muted" style="padding:4px 0;">
                            Issue Date
                        </td>

                        <td class="text-right" style="padding:4px 0;">
                            {{ display_date($invoice->issue_date) }}
                        </td>
                    </tr>

                    <tr>
                        <td class="small text-muted" style="padding:4px 0;">
                            Due Date
                        </td>

                        <td class="text-right" style="padding:4px 0;">
                            {{ display_date($invoice->due_date) }}
                        </td>
                    </tr>

                </table>

            </td>

        </tr>

    </table>

</div>