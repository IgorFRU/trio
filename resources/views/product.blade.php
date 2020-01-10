@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection
@section('content')

<section id="firstsection">
    @component('components.breadcrumb')
        @slot('main') <i class="fas fa-home"></i> @endslot
        @slot('parent') Категории товаров @endslot
            @slot('parent_route') {{ route('categories') }} @endslot 
        @isset($product->category)
            @slot('parent2') {{ $product->category->category }} @endslot
                @slot('parent2_route') {{ route('category', $product->category->slug) }} @endslot        
        @endisset 
        
        @slot('active') {{ $product->product }} @endslot
    @endcomponent 
</section>
<section class="product bg-light-grey">
    <div class="wrap">
    <div class="white_card_global p10">
        <div class="col-lg-12 row">
                <h1>{{ $product->product }} @isset($product->scu) (арт.: {{$product->scu}}) @endisset @isset($product->category->category)  - {{ $product->category->category }} @endisset @isset($product->manufacture->manufacture)  {{ $product->manufacture->manufacture }} @endisset</h1>
                <div class="col-lg-12 row product__subtitle">
                    @isset($product->autoscu)
                        <span class="product_card__content__category">артикул: <span class="c-black">{{ $product->autoscu ?? '' }} @isset($product->scu) ({{ $product->scu }}) @endisset </span></span>
                    @endisset
                    @isset($product->category->slug)
                        <span class="product_card__content__category"> | категория: <a href="{{ route('category', $product->category->slug) }}"><span class="c-black">{{ $product->category->category ?? '' }}</span></a></span>
                    @endisset
                    @isset($product->manufacture->slug)
                        <span class="product_card__content__manufacture"> | производитель: <a href="{{ route('manufacture', $product->manufacture->slug) }}"><span class="c-black">{{ $product->manufacture->manufacture ?? '' }}</span></a></span>             
                    @endisset
                </div>
            <div class="product__images col-lg-5 row">
                @if (isset($product->images))
                    @if (count($product->images) > 1)
                        <div class="product__images__many">
                            <div class="main_product_image">
                                @foreach ($product->images as $image)
                                    @php
                                        $main_img = 0;
                                    @endphp
                                    @if ($image->main)
                                    @php $main_img = 1; @endphp
                                        <img src="{{ asset('imgs/products/thumbnails')}}/{{ $image->thumbnail}}" alt="{{ $image->alt ?? '' }}">
                                    @endif
                                @endforeach
                                @if ($main_img == 0)
                                    <img src="{{ asset('imgs/products/thumbnails')}}/{{ $product->images['0']->thumbnail}}" alt="{{ $product->images['0']->alt ?? '' }}">
                                @endif
                            </div>
                            <div class="images__container">
                                @if (count($product->images) > 4)
                                    <span class="up">&uarr;</span>
                                    <span class="down">&darr;</span>
                                @endif
                                <div class="column">
                                    @forelse ($product->images as $image)
                                    <div class="images__container__item">
                                        <img @if($image->main) class="main" @elseif($main_img == 0 && $loop->first) class="main" @endif src="{{ asset('imgs/products/thumbnails')}}/{{ $image->thumbnail}}" alt="{{ $image->alt ?? '' }}">
                                    </div>                                        
                                    @empty
                                        
                                    @endforelse
                                </div>
                                
                            </div>
                        </div>
                    @elseif (count($product->images) == 0)
                        <div class="product__images__one">
                            <img src="{{ asset('imgs/nopic.png')}}" alt="">
                        </div>
                    @else
                        <div class="product__images__one">
                            <img src="{{ asset('imgs/products/thumbnails')}}/{{ $product->images['0']->thumbnail}}" alt="{{ $product->images['0']->alt ?? '' }}">
                        </div>                    
                    @endif
                @else
                    
                @endif
                <div class="product_superiorities">
                    @if($product->pay_online)
                        <div class="product_superiority">
                            <span class="product_superiority__left l-green">
                                <i class="fas fa-credit-card"></i>
                            </span>
                            <span class="product_superiority__right m-green">
                                Этот товар можно оплатить онлайн
                            </span>
                        </div>
                    @endif                    
                    @if($product->sample)
                        <div class="product_superiority">
                            <span class="product_superiority__left l-green">
                                <i class="fas fa-eye"></i>
                            </span>
                            <span class="product_superiority__right m-green">
                                В магазине есть образец товара
                            </span>
                        </div>
                    @endif
                    @if($product->actually_discount)
                        <div class="product_superiority">
                            <span class="product_superiority__left l-red">
                                <i class="fas fa-percentage"></i>
                            </span>
                            <span class="product_superiority__right m-red">
                                Акция до {{ $product->discount->d_m_y }}
                            </span>
                        </div>
                    @endif
                    
                </div>
            </div>
            <div class="col-lg-7">
                <div class="properties_prices col-lg-12"> 
                        <div class="product__price__value price">
                            <div class="price_top">
                                <div class="price__title">
                                    <div class="normal_price">
                                        Цена: @if ($product->actually_discount)
                                            <span class="price_value product_price_value">{{ $product->discount_price }} </span>
                                            <i class="fa fa-rub"></i>
                                            <div class="old_price_value product_old_price_value">
                                                {{ $product->old_price }}
                                                <span class="old_price_tooltip btn text-dark bg-warning btn-sm">экономия <span class="price_value">{{ $product->old_price - $product->discount_price }} руб.</span></span>
                                            </div>
                                            
                                            (за 1 {{$product->unit->unit ?? 'ед.' }})
                                        @else
                                            <span class="price_value product_price_value">{{ $product->old_price }} </span>
                                            <i class="fa fa-rub"></i>             
                                            (за 1 {{$product->unit->unit ?? 'ед.' }})
                                        @endif
                                    </div>
                                    @if ($product->packaging)
                                        Цена за 1 упаковку ({{ round($product->unit_in_package, 3) ?? '-' }} {{$product->unit->unit ?? 'ед.' }})
                                        <div class="bg-light product_package_price_value">
                                            <span class="price_value bold">{{ $product->package_price }}</span>
                                            <i class="fa fa-rub"></i>
                                        </div>
                                    @endif

                                    <div class="products__card__buttons">
                                        <div class="products__card__buttons__input">
                                            <span class="minus"><i class="fa fa-minus"></i></span>
                                            <input type="text" name="count" id="count" 
                                            data-price="{{ round($product->discount_price * $product->unit_in_package, 2) }}" 
                                            data-count="{{ round($product->unit_in_package, 2) }}"
                                            data-countpackage="1"
                                            @if($product->packaging) value="{{ round($product->unit_in_package, 2) }} {{ $product->unit->unit ?? 'ед.' }}" @endif >
                                            <span class="plus"><i class="fa fa-plus"></i></span>
                                        </div>
                                        <div class="for_payment">
                                            к оплате: <span data-unit="{{ $product->unit->unit ?? 'ед.' }}">{{ round($product->discount_price * $product->unit_in_package, 2) }}</span> <i class="fa fa-rub"></i>
                                        </div>
                                        <div class="buttons">
                                            <div class="one_click btn">Купить в 1 клик</div>
                                        </div>
                                    </div>
                                </div>
                            <div class="price__selector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-12">
            <div class="product__properties color_l_grey col-lg-5">
                @isset($product->delivery_time)
                    <div class="italic" style="display: block;"><i class="far fa-calendar-alt"></i> срок поставки: {{ $product->delivery_time }}</div>
                @endisset
                @isset($product->category->property)
                <div>
                    @foreach ($product->category->property as $property)
                        @if (isset($property->property) && isset($propertyvalues[$property->id]))
                            <div class="product__property d-flex justify-content-between">
                                <span class="product__property__title">{{ $property->property }}</span> <span>{{ $propertyvalues[$property->id] ?? '' }}</span>
                            </div>
                        @endif
                        
                    @endforeach
                </div>
                @endisset
                <p>{{ $product->short_description ?? '' }}</p>
            </div>
        </div>
        @isset($product->description)
        <hr>
        <div class="col-lg-12">
            {!! $product->description ?? '' !!}
        </div>
        @endisset
        
    </div>
</div>
</section>
    
<div class="modal_oneclick">
    <div class="modal_oneclick__header">
        Быстрый заказ
        <div class="modal_oneclick__header__close">

        </div>
    </div>
    <form id="modal_oneclick">
        <input type="text" id="modal_oneclick_name" name="name" placeholder="Имя" required>
        <input type="text" id="modal_oneclick_phone" name="phone" placeholder="Номер телефона" required>
        <input type="text" id="modal_oneclick_quantity" name="quantity" placeholder="Количество" readonly>
        <input type="text" id="modal_oneclick_price" name="price" placeholder="Сумма заказа" readonly>
        
        <input type="hidden" id="modal_oneclick_product" name="product">
        <input type="hidden" id="modal_oneclick_url" name="url">
        <div id="modal_oneclick_btn">Отправить</div>
    </form>
</div>
      
@endsection