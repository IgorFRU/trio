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
                        @slot('parent') Категории товаров @endslot
                            @slot('parent_route') {{ route('categories') }} @endslot 
                        @isset($category->parents)
                            @slot('parent2') {{ $category->parents->category }} @endslot
                                @slot('parent2_route') {{ route('category', $category->parents->slug) }} @endslot        
                        @endisset    
                        @slot('active') {{ $category->category }} @endslot
                    @endcomponent 
                </ul>
                <h1 class="uk-margin-small-top uk-margin-remove-bottom">{{ $category->category }}</h1>
                
                <ul uk-accordion="multiple: true">
                    <li>
                        <a class="uk-accordion-title" href="#">Описание категории</a>
                        <div class="uk-accordion-content">
                            {!! $category->description !!}
                        </div>
                    </li>
                    @if (count($category->children) > 0)
                        <li>
                            <a class="uk-accordion-title" href="#">Дочерние категории</a>
                            <div class="uk-accordion-content">
                                <div class="uk-child-width-1-3@s uk-child-width-1-4@m" ui-grid  uk-grid="masonry:true">
                                    @forelse ($category->children as $children)
                                        <div>
                                            <div class="uk-inline">
                                                @if ($children->image)
                                                    <img src="{{ asset('imgs/categories')}}/{{ $children->image  }}" alt="{{ $children->category }}">
                                                @else
                                                    <img src="{{ asset('imgs/nopic.png') }}" alt="{{ $children->category }}">
                                                @endif
                                                <div class="uk-overlay uk-overlay-default uk-position-center uk-text-large uk-text-bolder">
                                                    <p>
                                                        <a href="/catalog/{{ $children->slug }}">{{ $children->category }}</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </li>
                    @endif
                    
                </ul>

                <div class="uk-text-meta uk-margin-xsmall-top">{{ $category->products_count }} товаров</div>
            </div>
            <div class="uk-grid-margin uk-first-column">
                <div class="uk-grid-medium uk-grid" uk-grid="">
                    <div class="uk-width-expand">
                        <div class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack" uk-grid="">
                            <div class="uk-first-column">
                                <div class="uk-card uk-card-default uk-card-small tm-ignore-container">
                                    <div class="uk-grid-collapse uk-child-width-1-1 uk-grid uk-grid-stack" id="products" uk-grid="">
                                        <div class="uk-card-header uk-first-column">
                                            <div class="uk-grid-small uk-flex-middle uk-grid" uk-grid="">
                                                <div class="uk-width-1-1 uk-width-expand@s uk-flex uk-flex-center uk-flex-left@s uk-text-small uk-first-column">
                                                    <span class="uk-margin-small-right uk-text-muted">Sort by:</span>
                                                    <ul class="uk-subnav uk-margin-remove">
                                                        <li class="uk-active uk-padding-remove">
                                                            <a class="uk-text-lowercase" href="#">relevant<span class="uk-margin-xsmall-left uk-icon" uk-icon="icon: chevron-down; ratio: .5;"></span>
                                                            </a>
                                                        </li>
                                                        <li><a class="uk-text-lowercase" href="#">price</a></li>
                                                        <li><a class="uk-text-lowercase" href="#">newest</a></li>
                                                    </ul>
                                                </div>
                                                <div class="uk-width-1-1 uk-width-auto@s uk-flex uk-flex-center uk-flex-middle">
                                                    <button class="uk-button uk-button-default uk-button-small uk-hidden@m" uk-toggle="target: #filters"><span class="uk-margin-xsmall-right uk-icon" uk-icon="icon: settings; ratio: .75;"></span>Фильтр</button>
                                                    <div class="tm-change-view uk-margin-small-left">
                                                        <ul class="uk-subnav uk-iconnav js-change-view" uk-switcher="">
                                                            <li aria-expanded="true" class="uk-active"><a class="uk-active uk-icon" data-view="grid" uk-icon="grid" uk-tooltip="Grid" title="" aria-expanded="false"></a></li>
                                                            <li aria-expanded="false"><a data-view="list" uk-icon="list" uk-tooltip="List" class="uk-icon" title="" aria-expanded="false"></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                

        </div>
    </div>
</section>
      
@endsection


