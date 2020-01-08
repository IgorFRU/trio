@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection
@section('content')

{{-- @php
    dd($category->parents);
@endphp --}}
<section id="firstsection">
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
</section>
   <section class="wrap">
        <h1>{{ $category->category }}</h1>
        {!! $category->description !!}
   </section>
   @if(count($category->children) > 0)
      <section class="category_cards row wrap">
    @foreach ($category->children as $subcategory)
        <div class="category_card white_box w23per">
            <div class="category_card__img">
                <img  class="img-fluid"
                @if(isset($subcategory->image))
                    src="{{ asset('imgs/categories/')}}/{{ $subcategory->image }}"
                @else 
                    src="{{ asset('imgs/nopic.png')}}"
                @endif >
            </div> 
            <div class="category_card__title p10">
                <h4><a href="{{ route('category', $subcategory->slug) }}">{{ $subcategory->category }}</a></h4>
            </div>
        </div>
    @endforeach
    </section> 
   @endif
    
    
   @if(isset($products) && count($products) > 0)
    <section class="last_products wrap row">
        @if (isset($category->property) && count($category->property) > 0)
            <div class="col-lg-3">
                {{-- @component('components.propertiesbar')
                    @slot('min_price') {{ $products->min('price') }}
                @endcomponent --}}
                @include('components.propertiesbar', ['min_price' =>$products->min('price'), 'category_properties' => $category->property, 'properties' => $properties ])
            </div>
        @else
            
        @endif
    </section>
    <section class="products wrap">
            <div class="section_title">
                Товары
            </div>
        
            <div class="products__cards col-lg-12 row">
                @foreach ($products as $product)
                    {{-- @if (isset($checked_properties) && $product->property_active_product($checked_properties) ) --}}
                        <div class="products__card col-lg-3">
                            <div class="products__card__image">
                                @forelse ($product->images as $image)
                                    @if ($image->main)
                                        <img class="normal_product_image img-fluid" src="{{ asset('imgs/products/thumbnails/')}}/{{ $image->thumbnail}}" alt="">
                                    @endif
                                @empty
                                    <img src="{{ asset('imgs/nopic.png')}}" alt="">
                                @endforelse
                            </div>                    
                            <div class="products__card__info">
                                <div class="products__card__scu">
                                    <span class="scu">
                                        арт.: {{ $product->scu ?? ' - '}}
                                    </span>                                  
                                    <span class="manufacture">
                                        <a href="#">{{ $product->manufacture->manufacture ?? ''}}</a>
                                    </span>
                                </div>
                                <div class="products__card__maininfo">
                                    <div class="products__card__title">
                                        @if($category->parent_id)
                                        <h3><a href="{{ route('product.subcategory', ['category' => $category->category, 'subcategory' => $category->parent_id, 'product' => $product->slug, 'parameter' => '']) }}">{{ $product->product }}</a></h3>
                                        @else
                                        <h3><a href="{{ route('product', ['category' => $category->category, 'product' => $product->slug, 'parameter' => '']) }}">{{ $product->product }}</a></h3>
                                        @endif
                                    </div>
        
                                </div>
                            </div>
                            <div class="products__card__price">
                                <span class="products__card__price__old">
        
                                </span>
                                <div class="products__card__price__new">
                                    <div>
                                        <span class="value">
                                            @if ($product->currency->to_update)
                                                @php
                                                    $oneUnit = floatToInt($product->price * $currencyrates[$product->currency->id]);
                                                    $oneUnitNumeric = $oneUnit;
                                                    echo ($oneUnitNumeric);
                                                @endphp
                                            @else
                                                @php
                                                    $oneUnit = floatToInt($product->price);
                                                    $oneUnitNumeric = $oneUnit;
                                                    echo ($oneUnitNumeric);
                                                @endphp
                                            @endif
                                        </span>
                                        <i class="fa fa-rub"></i>
                                    </div>
        
                                    <div class="products__card__price__new__package">
                                        <div class="active" data-price="{{ $oneUnit }}"> за 1 {{ $product->unit->unit ?? 'ед.' }}</div>
                                        @if ($product->packaging)
                                        <div data-price="{{ round($oneUnitNumeric * $product->unit_in_package, 2) }}"> за 1 уп. ({{ round($product->unit_in_package, 3) }} {{ $product->unit->unit  ?? 'ед.'}})</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="products__card__buttons">
                                <div class="products__card__buttons__input">
                                    <input type="text" name="count" id="count" 
                                    data-price="{{ round($oneUnitNumeric * $product->unit_in_package, 2) }}" 
                                    data-count="{{ round($product->unit_in_package, 2) }}"
                                    data-countpackage="1"
                                    @if($product->packaging_sales) value= @php echo (round($product->unit_in_package, 2)); @endphp {{ $product->unit->unit ?? 'ед.' }} @endif >
                                    <span class="plus"><i class="fa fa-plus"></i></span>
                                    <span class="minus"><i class="fa fa-minus"></i></span>
                                </div>
                                <div class="for_payment">
                                    к оплате: <span>@php echo (round($oneUnitNumeric * $product->unit_in_package, 2)); @endphp</span> <i class="fa fa-rub"></i>
                                </div>
                                <div class="buttons">
                                    <div class="buy">В корзину</div>
                                    <div class="one_click">Купить в 1 клик</div>
                                </div>
                            </div>
                        </div>
                    {{-- @endif --}}
                @endforeach
            </div>
    </section>
    
    @else 
        <div class="wrap">
            В данной категории нет товаров
        </div>
    @endif

    @php 
    function floatToInt($number) { 
        $floor = floor($number);
        if ($number == $floor) { 
            return number_format($number, 0, '.', ''); 
        }
        else {
            return number_format(round($number, 2), 2, '.', '');
        } 
    } 
    @endphp 
    
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