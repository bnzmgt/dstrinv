<div class="section">

    <div class="small text-muted uppercase" style="margin-bottom:8px;">
        Project Information
    </div>

    <table style="border:1px solid #e5e7eb;">

        <tr>

            <td style="width:28%; padding:8px 10px; background:#f9fafb;" class="font-semibold">
                Project
            </td>

            <td style="padding:8px 12px;font-size:12px;">
                {{ $invoice->project->name }}
            </td>

        </tr>

        <tr>

            <td style="padding:8px 10px; background:#f9fafb;" class="font-semibold">
                Status
            </td>

            <td style="padding:8px 12px;font-size:12px;">
                {{ $invoice->project->status?->label() ?? '-' }}
            </td>

        </tr>

        <tr>

            <td style="padding:8px 10px; background:#f9fafb;" class="font-semibold">
                Period
            </td>

            <td style="padding:8px 12px;">

                {{ display_date($invoice->project->start_date) }}

                @if($invoice->project->end_date)

                    &nbsp;&ndash;&nbsp;

                    {{ display_date($invoice->project->end_date) }}

                @endif

            </td>

        </tr>

        @if($invoice->project->description)

            <tr>

                <td style="padding:8px 10px; background:#f9fafb;" class="font-semibold">
                    Description
                </td>

                <td style="padding:8px 12px; line-height:1.5;">
                    {!! nl2br(e($invoice->project->description)) !!}
                </td>

            </tr>

        @endif

    </table>

</div>