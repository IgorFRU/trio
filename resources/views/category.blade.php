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
                        <div class="uk-accordion-content uk-text-left">
                            {!! $category->description !!}
                        </div>
                    </li>
                    @if (count($category->children) > 0)
                        <li>
                            <a class="uk-accordion-title" href="#">Дочерние категории</a>
                            <div class="uk-accordion-content">
                                <div class="uk-child-width-1-2 uk-child-width-1-4@s uk-child-width-1-6@m uk-child-width-1-8@l" ui-grid  uk-grid="masonry:true">
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

                <div class="uk-text-meta uk-margin-xsmall-top">Товаров - {{ $category->products_count }}</div>
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
                                                    <div class="uk-width-1-1 uk-width-auto@s uk-flex uk-flex-center uk-flex-middle uk-margin-right">
                                                        <span class="uk-margin-small-right uk-visible@s">Сортировка:</span>
                                                        <div class="uk-form-controls">
                                                            <select class="uk-select uk-form-small" id="products_sort">
                                                                <option @if ($sort == "nameAZ" || $sort == NULL) selected @endif value="nameAZ">По названию (А-Я)</option>
                                                                <option @if ($sort == "nameZA") selected @endif value="nameZA">По названию (Я-А)</option>
                                                                <option @if ($sort == "popular") selected @endif value="popular">По популярности</option>
                                                                <option @if ($sort == "new_up") selected @endif value="new_up">Сначала новые</option>
                                                                <option @if ($sort == "new_down") selected @endif value="new_down">Сначала старые</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="uk-width-1-1 uk-width-auto@s uk-flex uk-flex-center uk-flex-middle">
                                                        <span class="uk-margin-small-right uk-visible@s">Товаров на странице:</span>
                                                        <div class="uk-form-controls">
                                                            <select class="uk-select uk-form-small uk-form-width-xsmall" id="products_per_page">
                                                                <option @if ($products_per_page == "12") selected @endif value="12">12</option>
                                                                <option @if ($products_per_page == "24") selected @endif value="24">24</option>
                                                                <option @if ($products_per_page == "48" || $products_per_page == NULL) selected @endif value="48">48</option>
                                                                <option @if ($products_per_page == "96") selected @endif value="96">96</option>
                                                            </select>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                                {{-- <div class="uk-width-1-1 uk-width-auto@s uk-flex uk-flex-center uk-flex-middle">
                                                    <button class="uk-button uk-button-default uk-button-small uk-hidden@m" uk-toggle="target: #filters"><span class="uk-margin-xsmall-right uk-icon" uk-icon="icon: settings; ratio: .75;"></span>Фильтр</button>
                                                    <div class="tm-change-view uk-margin-small-left">
                                                        <ul class="uk-subnav uk-iconnav js-change-view" uk-switcher="">
                                                            <li aria-expanded="true" class="uk-active"><a class="uk-active uk-icon" data-view="grid" uk-icon="grid" uk-tooltip="Мелкая сетка" title="" aria-expanded="false"></a></li>
                                                            <li aria-expanded="true" class="uk-active"><a class="uk-active uk-icon" data-view="grid" uk-icon="thumbnails" uk-tooltip="Крупная сетка" title="" aria-expanded="false"></a></li>
                                                            <li aria-expanded="false"><a data-view="list" uk-icon="list" uk-tooltip="List" class="uk-icon" title="" aria-expanded="false"></a></li>
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="uk-grid-margin uk-first-column">
                                            <div class="uk-grid-collapse uk-child-width-1-4@l uk-child-width-1-2@s uk-child-width-1-3@m tm-products-grid js-products-grid uk-grid" uk-grid=''>
                                                @foreach ($products as $product)
                                                    @if ($product->published)
                                                        <article class="tm-product-card uk-first-column uk-padding-small">
                                                            <div class="tm-product-card-media">
                                                                <div class="tm-ratio tm-ratio-4-3">
                                                                    <a class="tm-media-box" 
                                                                        @if($category->parent_id) href="{{ route('product.subcategory', ['category' => $category->slug, 'subcategory' => $category->parent_id, 'product' => $product->slug]) }}"
                                                                            @else href="{{ route('product', ['category' => $category->slug, 'product' => $product->slug]) }}"
                                                                        @endif
                                                                    >
                                                                        <div class="tm-product-card-labels">
                                                                            @if ($product->recomended)
                                                                                <span uk-tooltip="Рекомендуем" class="uk-label uk-label-warning"><i class="far fa-thumbs-up"></i> Рекомендуем</span>
                                                                            @endif 
                                                                            @if ($product->actually_discount)
                                                                                <span class="uk-label uk-label-danger" uk-tooltip="Скидка {{ $product->discount->value ?? '--' }} {{ $product->discount->rus_type ?? '--' }}">&minus; {{ $product->discount->value ?? '--' }} {{ $product->discount->rus_type ?? '--' }}</span>
                                                                            @endif
                                                                            @if($product->sample)
                                                                                <span class="uk-label uk-label-primary" uk-tooltip="В магазине есть образец этого товара">Есть образец</span>
                                                                            @endif
                                                                        </div>
                                                                        <figure class="tm-media-box-wrap">
                                                                            @if (count($product->images) > 0)
                                                                                <img class="normal_product_image img-fluid" src="{{ asset('imgs/products/thumbnails/')}}/{{ $product->main_or_first_image->thumbnail}}" alt="{{ $product->product }}">
                                                                                
                                                                            @else
                                                                                <img src="{{ asset('imgs/nopic.png')}}" alt="">
                                                                            @endif
                                                                        </figure>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="tm-product-card-body">
                                                                <div class="tm-product-card-info">
                                                                    <h3 class="tm-product-card-title">
                                                                        {{-- @if($category->parent_id) --}}
                                                                            {{-- <a class="uk-link-heading" href="{{ route('product.subcategory', ['category' => $category->slug, 'subcategory' => $category->parent_id, 'product' => $product->slug]) }}">{{ $product->product }}{{ ', ' . $product->category->category ?? '' }}</a> --}}
                                                                            {{-- @else --}}
                                                                            <a class="uk-link-heading" href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}">{{ $product->product }}{{ ', ' . $product->category->category ?? '' }}</a>
                                                                        {{-- @endif --}}
                                                                    </h3>
                                                                    <ul class="uk-list uk-text-small tm-product-card-properties">
                                                                        <li>
                                                                            <span class="uk-text-muted">арт: </span>
                                                                            <span>{{ $product->scu ?? ' - '}}</span>
                                                                        </li>
                                                                        @if ($product->manufacture != '' || $product->manufacture != NULL)
                                                                            <li>
                                                                                <span class="uk-text-muted">производитель: </span>
                                                                                <a href="{{ route('manufacture', $product->manufacture->slug) }}"><span class="uk-text-meta uk-margin-xsmall-bottom">{{ $product->manufacture->manufacture ?? '' }}</span></a>
                                                                            </li>
                                                                        @endif                                                                        
                                                                    </ul>
                                                                </div>
                                                                <div class="tm-product-card-shop">
                                                                    <div class="tm-product-card-prices uk-margin">
                                                                        @if ($product->actually_discount)
                                                                            <del class="uk-text-meta"><span class="price_value">{{ $product->old_price }}</span> <i class="fa fa-rub"></i></del>
                                                                        @endif
                                                                        <div class="tm-product-card-price"><span class="price_value">{{ $product->discount_price }}</span> <i class="fa fa-rub"></i>
                                                                            <span class="uk-text-muted uk-text-small uk-margin-left-small">за 1 {{ $product->unit->unit ?? 'ед.' }}</span>
                                                                        </div>
                                                                    </div>
                                                                    {{-- <div class="tm-product-card-add">
                                                                        <div class="uk-text-meta tm-product-card-actions">
                                                                            <a class="tm-product-card-action js-add-to js-add-to-favorites tm-action-button-active js-added-to" title="Add to favorites">
                                                                                <span uk-icon="icon: heart; ratio: .75;" class="uk-icon"></span>
                                                                                <span class="tm-product-card-action-text">Add to favorites</span>
                                                                            </a>
                                                                            <a class="tm-product-card-action js-add-to js-add-to-compare tm-action-button-active js-added-to" title="Add to compare">
                                                                                <span uk-icon="icon: copy; ratio: .75;" class="uk-icon"></span>
                                                                                <span class="tm-product-card-action-text">Add to compare</span>
                                                                            </a>
                                                                        </div>
                                                                        <button class="uk-button uk-button-primary tm-product-card-add-button tm-shine js-add-to-cart">
                                                                            <span class="tm-product-card-add-button-icon uk-icon" uk-icon="cart"></span>
                                                                            <span class="tm-product-card-add-button-text">в корзину</span>
                                                                        </button>
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                        </article>
                                                    @endif
                                                @endforeach
                                                
                                            </div>
                                            <div class="paginate uk-margin-left uk-margin-right uk-margin">
                                                {{ $products->appends(request()->input())->links('layouts.pagination') }}
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


