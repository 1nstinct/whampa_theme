<div id="tab-{{$tabId}}" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
        @for ($i = 0; $i < count($tabsData); $i++)
            <li><a href="#tabs-{{$i+1}}">{{$tabsData[$i][0]}}</a></li>
        @endfor
    </ul>
    @for ($i = 0; $i < count($tabsData); $i++)
        <div id="tabs-{{$i+1}}">
            <p>{{$tabsData[$i][1]}}</p>
        </div>
    @endfor
</div>