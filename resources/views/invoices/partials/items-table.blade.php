<div class="section">

    <div class="small text-muted uppercase" style="margin-bottom:8px;">
        Invoice Items
    </div>

    <table style="border:1px solid #e5e7eb;">

        <thead>

        <tr style="background:#f9fafb;">

            <th style="width:42px;padding:10px 8px;border-bottom:1px solid #e5e7eb;text-align:center; font-size: 12px;">
                #
            </th>

            <th style="padding:10px 12px;border-bottom:1px solid #e5e7eb;text-align:left;font-size: 12px;">
                Description
            </th>

            <th style="width:80px;padding:10px 8px;border-bottom:1px solid #e5e7eb;text-align:center;font-size: 12px;">
                Qty
            </th>

            <th style="width:135px;padding:10px 12px;border-bottom:1px solid #e5e7eb;text-align:right;font-size: 12px;">
                Unit Price
            </th>

            <th style="width:145px;padding:10px 12px;border-bottom:1px solid #e5e7eb;text-align:right;font-size: 12px;">
                Amount
            </th>

        </tr>

        </thead>

        <tbody>

        @forelse($invoice->items as $item)

            <tr>

                <td style="padding:12px 8px;border-bottom:1px solid #f1f5f9;text-align:center;font-size: 12px;">
                    {{ $loop->iteration }}
                </td>

                <td style="padding:12px 12px;border-bottom:1px solid #f1f5f9;font-size: 12px;">

                    <div style="font-weight:bold;color:#111827;font-size: 12px;">
                        {{ $item->item_name }}
                    </div>

                    @if($item->description)

                        <div
                            class="text-muted"
                            style="margin-top:5px;font-size:10px;line-height:1.45;"
                        >
                            {!! nl2br(e($item->description)) !!}
                        </div>

                    @endif

                </td>

                <td style="padding:12px 8px;border-bottom:1px solid #f1f5f9;text-align:center;font-size: 12px;">
                    {{ number_format($item->qty, 2) }}
                </td>

                <td style="padding:12px;border-bottom:1px solid #f1f5f9;text-align:right;white-space:nowrap;font-size: 12px;">
                    {{ money($item->unit_price) }}
                </td>

                <td style="padding:12px;border-bottom:1px solid #f1f5f9;text-align:right;white-space:nowrap;font-weight:bold;font-size: 12px;">
                    {{ money($item->total) }}
                </td>

            </tr>

        @empty

            <tr>

                <td
                    colspan="5"
                    style="padding:28px;text-align:center;color:#9ca3af;font-size: 12px;"
                >
                    No invoice items.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    <table style="margin-top:10px;">

        <tr>

            <td class="small text-muted" style="font-size: 12px;">

                <strong>{{ $invoice->total_items }}</strong>

                item(s)

                &nbsp;&nbsp;•&nbsp;&nbsp;

                Quantity

                <strong>{{ number_format($invoice->total_quantity,2) }}</strong>

            </td>

            <td class="small text-muted text-right">

                Generated

                {{ now()->format('d M Y H:i') }}

            </td>

        </tr>

    </table>

</div>