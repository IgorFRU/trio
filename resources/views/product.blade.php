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
                        @isset($product->category)
                            @slot('parent2') {{ $product->category->category }} @endslot
                                @slot('parent2_route') {{ route('category', $product->category->slug) }} @endslot        
                        @endisset    
                        @slot('active') {{ $product->product }} @endslot
                    @endcomponent 
                </ul>
                <h1 class="uk-margin-small-top uk-margin-remove-bottom">{{ $product->product }} @isset($product->scu) (арт.: {{$product->scu}}) @endisset @isset($product->category->category)  - {{ $product->category->category }} @endisset @isset($product->manufacture->manufacture)  {{ $product->manufacture->manufacture }} @endisset</h1>
            </div>
            <div class="uk-grid-margin uk-first-column">
                <section class="product bg-light-grey">
                    <div class="white_card_global p10">
                        <div class="col-lg-12 row">
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
                            <div class="product__images col-xl-5 col-lg-6 row mb-4">
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
                                                        <img src="{{ asset('imgs/products')}}/{{ $image->image}}" alt="{{ $image->alt ?? '' }}">
                                                    @endif
                                                @endforeach
                                                @if ($main_img == 0)
                                                    <img src="{{ asset('imgs/products')}}/{{ $product->images['0']->image}}" alt="{{ $product->images['0']->alt ?? '' }}">
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
                                                        <img @if($image->main) class="main" @elseif($main_img == 0 && $loop->first) class="main" @endif src="{{ asset('imgs/products')}}/{{ $image->image}}" alt="{{ $image->alt ?? '' }}">
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
                                            <img src="{{ asset('imgs/products')}}/{{ $product->images['0']->image}}" alt="{{ $product->images['0']->alt ?? '' }}">
                                        </div>                    
                                    @endif
                                @else
                                    
                                @endif
                                <div class="product_superiorities">
                                    {{-- @if($product->pay_online)
                                        <div class="product_superiority">
                                            <span class="product_superiority__left">
                                                <i class="fas fa-credit-card"></i>
                                            </span>
                                            <span class="product_superiority__right">
                                                Можно оплатить онлайн
                                            </span>
                                        </div>
                                    @endif                     --}}
                                    @if($product->sample)
                                        <div class="product_superiority">
                                            <span class="product_superiority__left">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                            <span class="product_superiority__right">
                                                В магазине есть образец
                                            </span>
                                        </div>
                                    @endif
                                    {{-- @if($product->actually_discount)
                                        <div class="product_superiority">
                                            <span class="product_superiority__left">
                                                <i class="fas fa-percentage"></i>
                                            </span>
                                            <span class="product_superiority__right">
                                                Акция до {{ $product->discount->d_m_y }}
                                            </span>
                                        </div>
                                    @endif --}}
                                    
                                </div>
                            </div>
                            <div class="col-xl-3  col-lg-6 product__price mb-4">
                                <div class="properties_prices col-lg-12"> 
                                        <div class="product__price__value price">
                                            <div class="price_top">
                                                <div class="price__title">
                                                    <div class="normal_price">
                                                        @if ($product->actually_discount)
                                                            <div>
                                                                <div class="old_price_tooltip text-light bg-danger btn-sm disabled" data-toggle="tooltip" data-placement="top" title="Акция '{{ $product->discount->discount }}' до {{ $product->discount->d_m_y ?? '' }}">
                                                                    - <span class="price_value" >{{ $product->discount->value ?? '--' }}</span> {{ $product->discount->rus_type ?? '--' }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        Цена: @if ($product->actually_discount)
                                                            <span class="price_value product_price_value">{{ $product->discount_price }} </span>
                                                            <i class="fa fa-rub"></i>
                                                            <div class="old_price_value product_old_price_value price_value">
                                                                {{ $product->old_price }}
                                                            </div>
                                                            (за 1 {{$product->unit->unit ?? 'ед.' }})
                                                        @else
                                                            <span class="price_value product_price_value">{{ $product->old_price }} </span>
                                                            <i class="fa fa-rub"></i>             
                                                            (за 1 {{$product->unit->unit ?? 'ед.' }})
                                                        @endif
                                                    </div>
                                                    @if ($product->packaging)
                                                        <div class="product_price_package_value">
                                                            Цена за 1 упаковку ({{ round($product->unit_in_package, 3) ?? '-' }} {{$product->unit->unit ?? 'ед.' }}):
                                                            <span class="price_value bold">{{ $product->package_price }}</span> <i class="fa fa-rub"></i>
                                                            {{-- <div class="bg-light product_package_price_value">
                                                                <span class="price_value bold">{{ $product->package_price }}</span>
                                                                <i class="fa fa-rub"></i>
                                                            </div> --}}
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
                                                            к оплате: <span class="price_value" data-unit="{{ $product->unit->unit ?? 'ед.' }}">{{ round($product->discount_price * $product->unit_in_package, 2) }}</span> <i class="fa fa-rub"></i>
                                                        </div>
                                                        <div class="buttons">
                                                            @if ($product->discount_price > 0)
                                                                <div class="one_click btn">Купить в 1 клик</div>
                                                            @else
                                                                <div class="btn btn-warning">В данный момент этот товар нельзя приобрести</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="price__selector">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-4  col-lg-12 product_properties">
                                    @isset($product->delivery_time)
                                        <div class="italic product_properties__delivery" style="display: block;"><i class="far fa-calendar-alt"></i> срок поставки: {{ $product->delivery_time }}</div>
                                    @endisset
                                    @isset($product->category->property)
                                    <div>
                                        @isset($product->category->property)
                                            <h5>Характеристики</h5>
                                        @endisset
                                        @foreach ($product->category->property as $property)
                                            @if (isset($property->property) && isset($propertyvalues[$property->id]))
                                                <div class="product__property d-flex justify-content-between">
                                                    <span class="product__property__title">{{ $property->property }}</span> <span  class="product__property__value">{{ $propertyvalues[$property->id] ?? '' }}</span>
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
                </section>
            </div>
        </div>
    </div>
</section>

      
@endsection