@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection
@section('content')
<section id="firstsection">
@component('components.breadcrumb')
    @slot('main') <i class="fas fa-home"></i> @endslot
    @slot('parent') Акции @endslot
        @slot('parent_route') {{ route('articles') }} @endslot   
    @slot('active'){{ $article->article }}@endslot    
@endcomponent 
</section>
<section class="bg-light-grey products">
<div class="wrap">
    <section class="white_card_global">   
        <h1>{{ $article->article }}</h1>
    <div>
        {!! $article->description !!}
    </div>
        @if($article->products && count($article->products) > 0)
            <section class="col-lg-12">
                <div class="section_title">
                    <h3>Товары, указанные в статье</h3>
                </div>
            
                <div class="products__cards col-lg-12">
                    @foreach ($article->products as $product)
                        @if ($product->published)   
                        {{-- @if (isset($checked_properties) && $product->property_active_product($checked_properties) ) --}}
                            <div class="col-lg-3">
                                <div class="products__card">
                                    <div class="products__card__image">
                                        @if (count($product->images) > 0)
                                            <img class="normal_product_image img-fluid" src="{{ asset('imgs/products/thumbnails/')}}/{{ $product->main_or_first_image->thumbnail}}" alt="">
                                            
                                        @else
                                            <img src="{{ asset('imgs/nopic.png')}}" alt="">
                                        @endif
                                    </div>                    
                                    <div class="products__card__info">
                                        <div class="products__card__scu">
                                            <span class="scu">
                                                арт.: {{ $product->scu ?? ' - '}}
                                            </span>   
                                            @if ($product->manufacture != '' || $product->manufacture != NULL)
                                                <span class="manufacture">
                                                    <a href="{{ route('manufacture', $product->manufacture->slug) }}"><span class="c-black">{{ $product->manufacture->manufacture ?? '' }}</span></a>
                                                </span>
                                            @endif                                
                                        </div>
                                        <div class="products__card__maininfo">
                                            <div class="products__card__title">
                                                @if($product->category->parent_id)
                                                <h3><a href="{{ route('product.subcategory', ['category' => $product->category->slug, 'subcategory' => $product->category->parent_id, 'product' => $product->slug]) }}">{{ $product->product }}</a></h3>
                                                @else
                                                <h3><a href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}">{{ $product->product }}</a></h3>
                                                @endif
                                            </div>
                
                                        </div>
                                    </div>
                                    <div class="products__card__price">                            
                                        @if ($product->actually_discount)
                                            <span class="products__card__price__old price_value">
                                                {{ $product->old_price }} 
                                            </span>
                                            <i class="fa fa-rub"></i>
                                            <span class="old_price_tooltip text-light bg-danger btn-sm disabled" data-toggle="tooltip" data-placement="top" title="Акция '{{ $product->discount->discount }}' до {{ $product->discount->d_m_y ?? '' }}">
                                                - <span class="price_value" >{{ $product->discount->value ?? '--' }}</span> {{ $product->discount->rus_type ?? '--' }}
                                            </span>
                                        @endif
                                        <div class="products__card__price__new">
                                            <div>
                                                <span class="price_value">
                                                    @if ($product->actually_discount)
                                                        {{ $product->discount_price }}
                                                    @else
                                                        {{ $product->old_price }}
                                                    @endif
                                                </span>
                                                <i class="fa fa-rub"></i>
                                            </div>
                
                                            <div class="products__card__price__new__package">
                                                <div class="active" data-price="{{ $product->discount_price ?? $product->old_price }}"> за 1 {{ $product->unit->unit ?? 'ед.' }}</div>
                                                @if ($product->packaging)
                                                <div data-price="{{ $product->package_price }}"> за 1 уп. ({{ round($product->unit_in_package, 3) }} {{ $product->unit->unit  ?? 'ед.'}})</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="products__card__buttons">
                                        <div class="products__card__buttons__input">
                                            <input type="text" name="count" id="count" 
                                            data-price="{{ $product->package_price }}" 
                                            data-count="{{ round($product->unit_in_package, 2) }}"
                                            data-countpackage="1"
                                            @if($product->packaging) value="{{ round($product->unit_in_package, 2) }} {{ $product->unit->unit ?? 'ед.' }}" @endif >
                                            <span class="plus"><i class="fa fa-plus"></i></span>
                                            <span class="minus"><i class="fa fa-minus"></i></span>
                                        </div>
                                        <div class="for_payment">
                                            к оплате: <span class="price_value" data-unit="{{ $product->unit->unit ?? 'ед.' }}"> {{ $product->package_price }}</span> <i class="fa fa-rub"></i>
                                        </div>
                                        <div class="buttons">
                                            <div class="buy">В корзину</div>
                                            <div class="one_click">Купить в 1 клик</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- @endif --}}
                        @endif
                    @endforeach
                </div>
            </section>
        @endif
    </section>
</div>
    
    
      
@endsection