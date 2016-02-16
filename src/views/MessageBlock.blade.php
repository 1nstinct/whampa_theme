<div class="alert alert-{{$type}} alert-block">
    @if($showCloseBtn)
        <button class="close" data-dismiss="alert" href="#">×</button>
    @endif
    <h4 class="alert-heading">{{$heading}}</h4>
    {{$bodyHtml}}
</div>