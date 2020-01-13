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
    @isset($category->parents)
        @slot('parent2') {{ $category->parents->category }} @endslot
            @slot('parent2_route') {{ route('category', $category->parents->slug) }} @endslot        
    @endisset
    
    @slot('active') {{ $category->category }} @endslot
@endcomponent 
</section>
<section class="bg-light-grey products">
<div class="wrap">
    <section class="white_card_global">   
        <h1>{{ $category->category }}</h1>
        {!! $category->description !!}
    @if(count($category->children) > 0)
        <div class="category_cards row wrap">
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
        </div> 
    @endif
    
    
   @if(isset($products) && count($products) > 0)
    <div class="last_products row">
        @if (isset($category->property) && count($category->property) > 0)
            <div class="col-lg-3">
                {{-- @component('components.propertiesbar')
                    @slot('min_price') {{ $products->min('price') }}
                @endcomponent --}}
                @include('components.propertiesbar', ['min_price' =>$products->min('price'), 'category_properties' => $category->property, 'properties' => $properties ])
            </div>
        @else
            
        @endif
    </div>      
        <div class="products__cards col-lg-12">
            @foreach ($products as $product)
                {{-- @if (isset($checked_properties) && $product->property_active_product($checked_properties) ) --}}
                    <div class="products__card col-lg-3">
                        <div class="products__card__image row">
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
                                @if ($product->manufacture != '' || $product->manufacture != NULL)
                                    <span class="manufacture">
                                        <a href="{{ route('manufacture', $product->manufacture->slug) }}"><span class="c-black">{{ $product->manufacture->manufacture ?? '' }}</span></a>
                                    </span>
                                @endif                                
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
                {{-- @endif --}}
            @endforeach
        </div>
    
    @else 
        <div class="wrap">
            В данной категории нет товаров
        </div>
    @endif

    </section>
</div>

</section>    
@endsection