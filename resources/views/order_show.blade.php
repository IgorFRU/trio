@extends('layouts.main-app')
@section('scripts')
    @parent
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('main') <i class="fas fa-home"></i> @endslot
    {{-- @slot('parent') Корзина @endslot
        @slot('parent_route') {{ route('cart') }} @endslot  --}}
               
        @slot('active') Детали заказа @endslot
    @endcomponent 
    
    
    
    <section class="product wrap">
        <div class="white_box p10">
            <div class="col-lg-12 row">
                @if ($error != '')
                    <div class="col-lg-12 color-white bg-danger p10">
                        {{ $error }}
                    </div>
                @else
                    <h3>Заказ №{{ $order->number }} от {{ $order->d_m_y }}</h3>
                    <div class="col-lg-12 row">
                        
                        @php
                            $count = 1;
                        @endphp
                        <table class="table cart_table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Товар</th>
                                    <th scope="col">Цена</th>
                                    <th scope="col">Количество</th>
                                    <th scope="col">Сумма</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <th scope="row">{{ $count++ }}</th>
                                            <th>
                                                <div class="cart_table__item d-flex">
                                                    @if (isset($product->main_or_first_image->thumbnail))
                                                        <img src="{{ asset('imgs/products/thumbnails')}}/{{ $product->main_or_first_image->thumbnail ??  '' }}">
                                                    @else
                                                        <img src="{{ asset('imgs/nopic.png') ??  '' }}">
                                                    @endif
            
                                                    @if(isset($product->category->slug))
                                                        <div class="product_title"><a href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}">{{ Str::limit($product->product, 30, '... ') }}</a></div>
                                                    @else
                                                        <div class="product_title"><a href="{{ route('product.without_category', $product->slug) }}">{{ Str::limit($product->product, 30, '... ') }}</a></div>
                                                    @endif
                                                </div>
                                            </th>
                                            <th>
                                                @if ($product->actually_discount)
                                                    <div class="">{{ number_format($product->discount_price, 2, ',', ' ') }} руб.</div>                                        
                                                @else
                                                    <div class="">{{ number_format($product->price, 2, ',', ' ') }} руб.</div>
                                                @endif
                                            </th>
                                            <th>
                                                <div class="cart_table__item_quantity" data-id="{{ $product->id }}">
                                                    
                                                    <input type="text" readonly class="cart__product__input_units" name="product__input_units" id="{{ $product->id }}" data-package="{{ $product->unit_in_package ?? 1 }}" value="{{ $product->pivot->quantity }}" readonly> 
                                                    
                                                </div>
                                                {{ $product->unit->unit ?? 'ед.' }}
                                                
                                            </th>
                                            <th>
                                                @if ($product->actually_discount)
                                                    <div class="">{{ number_format($product->discount_price * $order->amount($product->id), 2, ',', ' ') }}</div>                                        
                                                @else
                                                    <div class="">{{ number_format($product->price * $order->amount($product->id), 2, ',', ' ') }} <span> руб.</span></div>
                                                @endif
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        
                        
                    </div>
                    <div class="col-lg-12 row">
                        <div class="col-lg-4">
                            товаров: <strong>{{ $order->products->count() }}</strong>
                        </div>                        
                        <div class="col-lg-4">
                            сумма заказа: <strong>{{ $order->total_summ ?? '' }}</strong>  руб.
                        </div>                      
                        <div class="col-lg-4">
                            способ оплаты: @if ($order->payment_method == 'on delivery')
                                <strong>оплата при получении товара</strong>
                            @elseif ($order->payment_method == 'firm')
                                <strong>безналичный расчёт</strong>
                            @elseif ($order->payment_method == 'online')
                                <strong>оплата онлайн</strong>
                            @endif
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </section>
    
    
      
@endsection