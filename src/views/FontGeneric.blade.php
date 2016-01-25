<style>
    @font-face {
        font-family: 'glyphicons-halflings-regular';
        src: url('packages/whampa/theme/fonts/glyphicons-halflings-regular.eot');
        src: url('packages/whampa/theme/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url('packages/whampa/theme/fonts/glyphicons-halflings-regular.woff') format('woff'), url('packages/whampa/theme/fonts/glyphicons-halflings-regular.ttf') format('truetype'), url('packages/whampa/theme/fonts/glyphicons-halflings-regular.svg#glyphicons-halflings-regular') format('svg');
        font-weight: normal;
        font-style: normal;
    }
    @media all and (-webkit-min-device-pixel-ratio:0) { @font-face { font-family: 'glyphicons-halflings-regular'; src: url('packages/whampa/theme/fonts/glyphicons-halflings-regular.svg#glyphicons-halflings-regular') format('svg'); font-weight: normal; font-style: normal; } }

    @font-face {
        font-family: 'fontawesome-webfont';
        src: url('packages/whampa/theme/fonts/fontawesome-webfont.eot');
        src: url('packages/whampa/theme/fonts/fontawesome-webfont.eot?#iefix') format('embedded-opentype'), url('packages/whampa/theme/fonts/fontawesome-webfont.woff') format('woff'), url('packages/whampa/theme/fonts/fontawesome-webfont.ttf') format('truetype'), url('packages/whampa/theme/fonts/fontawesome-webfont.svg#fontawesome-webfont') format('svg');
        font-weight: normal;
        font-style: normal;
    }
    @media all and (-webkit-min-device-pixel-ratio:0) { @font-face { font-family: 'fontawesome-webfont'; src: url('packages/whampa/theme/fonts/fontawesome-webfont.svg#fontawesome-webfont') format('svg'); font-weight: normal; font-style: normal; } }

    @if (isset($additionalFonts) && count($additionalFonts))
        @foreach ($additionalFonts as $i => $font)
            @font-face {
                font-family: '{{$font}}';
                src: url('packages/whampa/theme/fonts/{{$font}}.eot');
                src: url('packages/whampa/theme/fonts/{{$font}}.eot?#iefix') format('embedded-opentype'), url('packages/whampa/theme/fonts/{{$font}}.woff') format('woff'), url('packages/whampa/theme/fonts/{{$font}}.ttf') format('truetype'), url('packages/whampa/theme/fonts/{{$font}}.svg#{{$font}}') format('svg');
                font-weight: normal;
                font-style: normal;
            }
            @media all and (-webkit-min-device-pixel-ratio:0) { @font-face { font-family: '{{$font}}'; src: url('packages/whampa/theme/fonts/{{$font}}.svg#{{$font}}') format('svg'); font-weight: normal; font-style: normal; } }
        @endforeach
    @endif
</style>
