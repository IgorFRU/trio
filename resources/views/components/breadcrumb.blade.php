{{-- <ol class="breadcrumbs wrap">
        <li class=""><a href="{{route('index')}}">{{$main}}</a></li>
        @isset($parent)
            <li class=""><a href="{{ $parent_route }}">{{$parent}}</a></li>
        @endisset
        
        @isset($parent2)
            <li class=""><a href="{{ $parent2_route }}">{{$parent2}}</a></li>
        @endisset
        <li class="active">{{$active}}</li>
    </ol> --}}
    <li class=""><a href="{{route('index')}}">{{$main}}</a></li>
        @isset($parent)
            <li class=""><a href="{{ $parent_route }}">{{$parent}}</a></li>
        @endisset
        
        @isset($parent2)
            <li class=""><a href="{{ $parent2_route }}">{{$parent2}}</a></li>
        @endisset
    <li><span>{{$active}}</span></li>
