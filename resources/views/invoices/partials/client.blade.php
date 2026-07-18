<div class="section">
    <table>
        <tr>
            <td style="width:50%; vertical-align:top; padding-right:18px;">

                <div class="small text-muted uppercase" style="margin-bottom:8px;">
                    Bill To
                </div>

                <div style="font-size:12px; font-weight:bold; color:#111827;">
                    {{ $invoice->project->client->company_name }}
                </div>

                <div style="margin-top:4px;font-size:12px;">
                    {{ $invoice->project->client->contact_name }}
                </div>

                @if($invoice->project->client->email)
                    <div class="text-muted" style="margin-top:2px;font-size:12px;">
                        {{ $invoice->project->client->email }}
                    </div>
                @endif

                @if($invoice->project->client->phone)
                    <div class="text-muted" style="margin-top:2px;font-size:12px;">
                        {{ $invoice->project->client->phone }}
                    </div>
                @endif

                @if($invoice->project->client->address)
                    <div style="margin-top:10px; font-size:12px; line-height:1.5;">
                        {!! nl2br(e($invoice->project->client->address)) !!}
                    </div>
                @endif

            </td>

            <td style="width:50%; vertical-align:top; padding-left:18px;">

                <div class="small text-muted uppercase" style="margin-bottom:8px;">
                    From
                </div>

                <div style="font-size:12px; font-weight:bold; color:#111827;">
                    {{ config('app.name') }}
                </div>


            </td>

        </tr>
    </table>
</div>