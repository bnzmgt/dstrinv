<div class="section">

    <div class="small text-muted uppercase" style="margin-bottom:8px;">
        Payment Summary
    </div>

    @if($invoice->payments->isEmpty())

        <div
            style="
                border:1px solid #e5e7eb;
                background:#f9fafb;
                padding:18px;
                text-align:center;
                color:#6b7280;
                font-size: 12px;
            "
        >
            No payment has been recorded.
        </div>

    @else

        <table style="border:1px solid #e5e7eb;">

            <thead>

                <tr style="background:#f9fafb;">

                    <th style="width:150px;padding:10px 12px;border-bottom:1px solid #e5e7eb;text-align:left;font-size: 12px;">
                        Date
                    </th>

                    <th style="padding:10px 12px;border-bottom:1px solid #e5e7eb;text-align:left;font-size: 12px;">
                        Method
                    </th>

                    <th style="width:180px;padding:10px 12px;border-bottom:1px solid #e5e7eb;text-align:left;font-size: 12px;">
                        Reference
                    </th>

                    <th style="width:150px;padding:10px 12px;border-bottom:1px solid #e5e7eb;text-align:right;font-size: 12px;">
                        Amount
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($invoice->payments as $payment)

                    <tr>

                        <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size: 12px;">
                            {{ display_date($payment->payment_date) }}
                        </td>

                        <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size: 12px;">
                            {{ $payment->payment_method }}
                        </td>

                        <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;font-size: 12px;">
                            {{ $payment->reference_number ?: '-' }}
                        </td>

                        <td style="padding:10px 12px;border-bottom:1px solid #f1f5f9;text-align:right;white-space:nowrap;font-size: 12px;">
                            {{ money($payment->amount) }}
                        </td>

                    </tr>

                    @if($payment->notes)

                        <tr>

                            <td
                                colspan="4"
                                style="
                                    padding:10px 12px 14px;
                                    border-bottom:1px solid #f1f5f9;
                                    background:#fcfcfd;
                                    font-size: 12px;
                                "
                            >

                                <div
                                    class="small text-muted uppercase"
                                    style="margin-bottom:4px;font-size: 12px;"
                                >
                                    Notes
                                </div>

                                <div style="line-height:1.5;font-size: 12px;">
                                    {{ $payment->notes }}
                                </div>

                            </td>

                        </tr>

                    @endif

                @endforeach

            </tbody>

        </table>

        <table style="margin-top:10px;">

            <tr>

                <td class="small text-muted font-size: 12px;">

                    Total Payment Record

                    <strong>{{ $invoice->payments->count() }}</strong>

                </td>

                <td class="small text-muted text-right font-size: 12px;">

                    Paid

                    <strong>{{ money($invoice->payment_total) }}</strong>

                </td>

            </tr>

        </table>

    @endif

</div>