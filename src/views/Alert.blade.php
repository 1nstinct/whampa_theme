<div class="alert alert-{{$type}} fade in">
    @if($showCloseBtn)
    <button class="close" data-dismiss="alert">
        ×
    </button>
    @endif
    <i class="fa-fw fa fa-{{$icon}}"></i>
    <strong>{{$boldText}}</strong> {{$text}}
</div>