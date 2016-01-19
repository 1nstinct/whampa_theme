@if (isset($minified) && $minified == true)
    @if (isset($additionalCss) && count($additionalCss))
        {{ Theme::stylesheetArray($additionalCss); }}
    @endif
@else
    @if (isset($additionalCss) && count($additionalCss))
        @foreach ($additionalCss as $i => $lib)
            {{ HTML::style('packages/whampa/theme/css/'.$lib); }}
        @endforeach
    @endif
@endif

<script>
    // appending css class to body
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementsByTagName("body")[0].className = document.getElementsByTagName("body")[0].className+' {{$theme}}'
    }, false);
</script>
