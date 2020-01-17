@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection
@section('content')
<section id="firstsection">
@component('components.breadcrumb')
    @slot('main') <i class="fas fa-home"></i> @endslot
    @slot('parent') Производители @endslot
        @slot('parent_route') {{ route('manufactures') }} @endslot     
    @slot('active') {{ $manufacture->manufacture }} @endslot
@endcomponent 
</section>
<section class="bg-light-grey products">
    <div class="wrap"><div class="col-lg-12 row">
        <div class="col-lg-3">
            @include('components.categories-sidebar')
        </div>
        <div class="col-lg-9">
            <section class="white_card_global">   
                <h1>{{ $manufacture->manufacture }} @if ($manufacture->country != '' || $manufacture->country != NULL)
                    ({{ $manufacture->country }})
                @endif</h1>
                {!! $manufacture->description !!}    
            
                @if(isset($products) && count($products) > 0)    
                    <div class="products__cards col-lg-12">
                        <div class="col-lg-12 row justify-content-end products_top_bar">
                            <div class="col-lg-6">
                                <div class="row">                            
                                    <div class="col">
                                        <div class="form-group row">
                                            <label for="products_sort" class="col-lg-4">Сортировать</label>
                                            <div class="col-md-8">
                                                <select class="form-control custom-select custom-select-sm" id="products_sort">
                                                    {{-- <option value="discount">Сначала со скидкой</option> --}}
                                                    <option @if ($sort == "nameAZ" || $sort == NULL) selected @endif value="nameAZ">По названию (А-Я)</option>
                                                    <option @if ($sort == "nameZA") selected @endif value="nameZA">По названию (Я-А)</option>
                                                    <option @if ($sort == "popular") selected @endif value="popular">По популярности</option>
                                                    <option @if ($sort == "new_up") selected @endif value="new_up">Сначала новые</option>
                                                    <option @if ($sort == "new_down") selected @endif value="new_down">Сначала старые</option>
                                                  </select>
                                            </div> 
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                            <div class="col-lg-5">
                                <div class="row">                            
                                    <div class="col">
                                        <div class="form-group row">
                                            <label for="products_per_page" class="col-lg-7">Товаров на странице</label>
                                            <div class="col-lg-5">
                                                <select class="form-control custom-select custom-select-sm" id="products_per_page">
                                                    <option @if ($products_per_page == "12") selected @endif value="12">12</option>
                                                    <option @if ($products_per_page == "24") selected @endif value="24">24</option>
                                                    <option @if ($products_per_page == "48" || $products_per_page == NULL) selected @endif value="48">48</option>
                                                    <option @if ($products_per_page == "96") selected @endif value="96">96</option>
                                                  </select>
                                            </div> 
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                        @foreach ($products as $product)
                            @if ($product->published)   
                                <div class="col-lg-4">
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
                                                    <h3><a href="{{ route('product.subcategory', ['category' => $product->category->slug, 'subcategory' => $product->category->parent_id, 'product' => $product->slug, 'parameter' => '']) }}">{{ $product->product }}</a></h3>
                                                    @else
                                                    <h3><a href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug, 'parameter' => '']) }}">{{ $product->product }}</a></h3>
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
                            @endif
                        @endforeach
                    </div>
                    @else 
                        <div class="wrap">
                            Пока не добавлено ни одного товара данного производителя. Каталог товаров в процессе наполнения.
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</section>    
@endsection