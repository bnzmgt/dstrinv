<div class="section">

    <table>

        <tr>

            <td style="width:56%; vertical-align:top;">

            </td>

            <td style="width:44%; vertical-align:top;">

                <table style="border:1px solid #e5e7eb;">

                    <tr>

                        <td style="padding:10px 12px;font-size: 12px;">
                            Subtotal
                        </td>

                        <td style="padding:10px 12px; text-align:right; white-space:nowrap;font-size: 12px;">
                            {{ money($invoice->subtotal) }}
                        </td>

                    </tr>

                    <tr>

                        <td style="padding:10px 12px; border-top:1px solid #f1f5f9;font-size: 12px;">
                            Total Payment
                        </td>

                        <td style="padding:10px 12px; border-top:1px solid #f1f5f9; text-align:right; white-space:nowrap;font-size: 12px;">
                            {{ money($invoice->payment_total) }}
                        </td>

                    </tr>

                    <tr>

                        <td style="padding:10px 12px; border-top:1px solid #f1f5f9;font-size: 12px;">
                            Outstanding
                        </td>

                        <td style="padding:10px 12px; border-top:1px solid #f1f5f9; text-align:right; white-space:nowrap;font-size: 12px;">

                            @if($invoice->outstanding_amount > 0)

                                <span style="font-weight:bold;">
                                    {{ money($invoice->outstanding_amount) }}
                                </span>

                            @else

                                -

                            @endif

                        </td>

                    </tr>

                    <tr>

                        <td colspan="2" style="padding:0; border-top:2px solid #d1d5db;"></td>

                    </tr>

                    <tr style="background:#f9fafb;">

                        <td style="padding:14px 12px; font-weight:bold; font-size:12px;font-size: 12px;">
                            GRAND TOTAL
                        </td>

                        <td style="padding:14px 12px; text-align:right; white-space:nowrap;font-size: 12px;">

                            <span style="font-size:16px; font-weight:bold; color:#111827;">
                                {{ money($invoice->total) }}
                            </span>

                        </td>

                    </tr>

                </table>

                <table style="margin-top:10px;">

                    <tr>

                        <td class="small text-muted" style="width:40%;font-size: 12px;">
                            Status
                        </td>

                        <td style="text-align:right;font-size: 12px;">

                            <span class="badge">
                                {{ $invoice->status?->label() ?? '-' }}
                            </span>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

</div>