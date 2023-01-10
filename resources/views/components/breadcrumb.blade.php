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
    <li class="" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="{{route('index')}}" itemprop="item"><span itemprop="name">{{$main}}</span></a></li>
    @isset($parent)
        <li class="" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="{{ $parent_route }}"><span itemprop="name">{{$parent}}</span></a></li>
    @endisset
    
    @isset($parents)
        @forelse ($parents as $parent => $slug)
            <li class="" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="{{ route('category', $slug) }}"><span itemprop="name">{{ $parent }}</span></a></li>
        @empty
            
        @endforelse
    @endisset

    @isset($category)
        <li class="" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="{{ route('category', $category->slug) }}"><span itemprop="name">{{ $category->category }}</span></a></li>
    @endisset
    

    @isset($parent2)
        <li class="" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="{{ $parent2_route }}"><span itemprop="name">{{$parent2}}</span></a></li>
    @endisset

    <li><span itemprop="name">{{$active}}</span></li>
