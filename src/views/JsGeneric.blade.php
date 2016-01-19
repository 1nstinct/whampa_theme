@if (isset($minified) && $minified == true)
    @if (isset($additionalJs) && count($additionalJs))
        {{ Theme::javascriptArray($additionalJs); }}
    @endif
@else
    @if (isset($additionalJs) && count($additionalJs))
        @foreach ($additionalJs as $i => $lib)
            {{ HTML::script('packages/whampa/theme/js/'.$lib); }}
        @endforeach
    @endif
@endif