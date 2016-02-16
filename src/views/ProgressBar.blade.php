<div class="bar-holder">
    <div class="progress {{$rightAlignment}}{{$verticalPosition}}@if ($verticalPosition){{$wideVertical}}@else {{$horizontalSize}}@endif {{$addCssClasses}}" @if ($progressTooltipHtml) rel="tooltip" data-original-title="{{$progressTooltipHtml}}" data-placement="{{$progressTooltipPosition}}" @endif>
        <div class="progress-bar bg-color-teal" aria-valuetransitiongoal="{{$percents}}" style="@if (!$verticalPosition) width: {{$percents}}@else height: {{$percents}}@endif%;" aria-valuenow="{{$percents}}">@if (!$verticalPosition && ($horizontalSize == '' || $horizontalSize == 'progress-lg')){{$progressText}}@endif</div>
    </div>
</div>