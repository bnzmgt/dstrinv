<div class="section" style="margin-top:28px;">

    <table>

        <tr>

            <td style="width:60%; vertical-align:top; padding-right:20px;">

                @if($invoice->notes)

                    <div class="small text-muted uppercase" style="margin-bottom:8px;">
                        Notes
                    </div>

                    <div
                        style="
                            border:1px solid #e5e7eb;
                            background:#f9fafb;
                            padding:14px;
                            min-height:72px;
                            line-height:1.6;
                        "
                    >

                        {!! nl2br(e($invoice->notes)) !!}

                    </div>

                @endif

            </td>

            <td style="width:40%; vertical-align:top; padding-left:20px;">

                <div class="small text-muted uppercase" style="margin-bottom:8px;">
                    Message
                </div>

                <div
                    style="
                        border:1px solid #e5e7eb;
                        padding:14px;
                        min-height:72px;
                    "
                >

                    <div
                        style="
                            font-size:14px;
                            font-weight:bold;
                            color:#111827;
                            margin-bottom:8px;
                        "
                    >
                        Thank You
                    </div>

                    <div style="line-height:1.6;">

                        Thank you for your business and trust.

                        <br><br>

                        We appreciate the opportunity to work with you and
                        look forward to working together again.

                    </div>

                </div>

            </td>

        </tr>

    </table>

    <div
        style="
            margin-top:24px;
            border-top:1px solid #e5e7eb;
            padding-top:10px;
        "
    >

        <table>

            <tr>

                <td class="small text-muted">

                    Invoice

                    <strong>{{ $invoice->invoice_number }}</strong>

                </td>

                <td class="small text-muted text-right">

                    Generated

                    {{ now()->format('d M Y H:i') }}

                </td>

            </tr>

        </table>

    </div>

</div>