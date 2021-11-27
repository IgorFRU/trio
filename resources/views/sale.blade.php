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
                        @slot('parent') Акции @endslot
                            @slot('parent_route') {{ route('sales') }} @endslot   
                        @slot('active') {{ $sale->discount }} {{ $sale->value }} {{ $sale->rus_type }} @endslot 
                    @endcomponent 
                </ul>
                <h1 class="uk-margin-small-top uk-margin-remove-bottom">{{ $sale->discount }} {{ $sale->value }} {{ $sale->rus_type }}</h1>
                <div class="card_info col-lg-12 @if($sale->it_actuality) uk-text-success uk-text-bold @else uk-text-danger @endif">{{ $sale->start_d_m_y }} - {{ $sale->d_m_y }} @if(!$sale->it_actuality) <br>(акция закончилась!) @endif</div>
            </div>
            @if ($sale->description != NULL)
                <div class="uk-card uk-card-default uk-card-body ">
                    
                    <div>{!! $sale->description !!}</div>

                    @if ($sale->product->count())
                    <hr>
                        <h3>Товары, участвующие в акции</h3>
                        <div class="uk-grid-margin uk-first-column">
                            <div class="uk-grid-collapse uk-child-width-1-4@l uk-child-width-1-2@s uk-child-width-1-3@m tm-products-grid js-products-grid uk-grid" uk-grid=''>
                                @foreach ($sale->product as $product)
                                    @if ($product->published)
                                        <article class="tm-product-card uk-first-column uk-padding-small">
                                            <div class="tm-product-card-media">
                                                <div class="tm-ratio tm-ratio-4-3">
                                                    <a class="tm-media-box" 
                                                        @if($product->category->parent_id) href="{{ route('product.subcategory', ['category' => $product->category->slug, 'subcategory' => $product->category->parent_id, 'product' => $product->slug]) }}"
                                                            @else href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}"
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
                                                        <a class="uk-link-heading" href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}">{{ $product->product }}{{ ', ' . $product->category->category ?? '' }}</a>
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
                                                </div>
                                            </div>
                                        </article>
                                    @endif
                                @endforeach
                        
                            </div>
                        </div>
                    @endif
                </div>                
            @endif
        </div>
    </div>
</section>
      
@endsection
