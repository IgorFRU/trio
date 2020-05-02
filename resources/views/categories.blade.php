@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection
@section('content')

<section class="uk-section uk-section-small">
    <div class="uk-container">
        <div class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid=''>
            <div class="uk-text-center uk-first-column">
                <ul class="uk-breadcrumb uk-flex-center uk-margin-remove">
                    @component('components.breadcrumb')
                        @slot('main') <i class="fas fa-home"></i> @endslot     
                        @slot('active') Категории товаров @endslot
                    @endcomponent 
                </ul>
                <h1 class="uk-margin-small-top uk-margin-remove-bottom">Категории товаров</h1>
            </div>
            <div class="uk-card uk-card-default uk-card-small uk-padding">
                <div uk-filter="target: .js-filter" class="">
                    <ul class="uk-tab">
                        <li class="uk-active" uk-filter-control><a href="#">Все</a></li>
                        @foreach ($menus as $menu)
                            <li uk-filter-control="[data-style='{{ $menu->menu }}']"><a href="#">{{ $menu->menu }}</a></li>
                        @endforeach
                    </ul>
                    <ul class="js-filter uk-child-width-1-3@s uk-child-width-1-4@m" uk-grid="masonry:true" ui-grid>                    
                        @forelse ($menus as $menu)
                            @forelse ($menu->category as $category)
                                <li data-style="{{ $menu->menu }}">
                                    <div class="uk-inline">
                                        @if ($category->image)
                                            <img src="{{ asset('imgs/categories')}}/{{ $category->image  }}" alt="{{ $category->category }}">
                                        @else
                                            <img src="{{ asset('imgs/nopic.png') }}" alt="{{ $category->category }}">
                                        @endif
                                        <div class="uk-overlay uk-overlay-default uk-position-center uk-text-large uk-text-bolder">
                                            <p>
                                                <a href="/catalog/{{ $category->slug }}">{{ $category->category }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @empty
                            @endforelse
                        @empty
                        @endforelse
                    </ul>
                </div>

        </div>
    </div>
</section>
      
@endsection