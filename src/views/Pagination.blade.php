@if($pager == true)
    <ul class="pager">
        <li class="previous
                @if($current == 1)disabled
                @endif
                ">

            <a href="javascript:void(0);">← Older</a>
        </li>
        <li class="next
            @if($current >= $count)disabled
            @endif
                ">
            <a href="javascript:void(0);">Newer →</a>
        </li>
    </ul>
@else
    @if($alt == true)
        @if($size == 'pagination-sm')
            <ul class="pagination pagination-sm pagination-alt">
                <li>
                    <a href="javascript:void(0);">«</a>
                </li>
                @for ($i = 1; $i <= $count ; $i++)
                    <li @if($i == $current)class="active"@endif>
                        <a href="javascript:void(0);">{{$i}}</a>
                    </li>
                @endfor
                <li>
                    <a href="javascript:void(0);">»</a>
                </li>
            </ul>
        @elseif($size == 'pagination-lg')
            <ul class="pagination pagination-alt pagination-lg">
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-angle-left"></i></a>
                </li>
                @for ($i = 1; $i <= $count ; $i++)
                    <li @if($i == $current)class="active"@endif>
                        <a href="javascript:void(0);">{{$i}}</a>
                    </li>
                @endfor
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-angle-right"></i></a>
                </li>
            </ul>
        @else
            <ul class="pagination pagination-alt">
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-angle-left"></i></a>
                </li>
                @for ($i = 1; $i <= $count ; $i++)
                    <li @if($i == $current)class="active"@endif>
                        <a href="javascript:void(0);">{{$i}}</a>
                    </li>
                @endfor
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-angle-right"></i></a>
                </li>
            </ul>
        @endif
    @else
        @if($size == 'pagination-sm')
            <ul class="pagination pagination-sm">
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-angle-left"></i></a>
                </li>
                @for ($i = 1; $i <= $count ; $i++)
                    <li @if($i == $current)class="active"@endif>
                        <a href="javascript:void(0);">{{$i}}</a>
                    </li>
                @endfor
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-angle-right"></i></a>
                </li>
            </ul>
        @elseif($size == 'pagination-lg')
            <ul class="pagination pagination-lg">
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a>
                </li>
                @for ($i = 1; $i <= $count ; $i++)
                    <li @if($i == $current)class="active"@endif>
                        <a href="javascript:void(0);">{{$i}}</a>
                    </li>
                @endfor
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a>
                </li>
            </ul>
        @else
            <ul class="pagination">
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-arrow-left"></i></a>
                </li>
                @for ($i = 1; $i <= $count ; $i++)
                    <li @if($i == $current)class="active"@endif>
                        <a href="javascript:void(0);">{{$i}}</a>
                    </li>
                @endfor
                <li>
                    <a href="javascript:void(0);"><i class="fa fa-arrow-right"></i></a>
                </li>
            </ul>
        @endif
    @endif
@endif