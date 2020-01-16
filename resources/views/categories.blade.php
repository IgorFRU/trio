@extends('layouts.main-app')
@section('scripts')
    @parent
    <!-- <script src="{{ asset('js/discount_countdown.js') }}" defer></script> -->
@endsection
@section('content')
<section id="firstsection">
@component('components.breadcrumb')
    @slot('main') <i class="fas fa-home"></i> @endslot     
    @slot('active') Категории товаров @endslot
@endcomponent 
</section>

<section class="products bg-light-grey">
    <div class="wrap">        
        <div class="col-lg-12 row">            
            <div class="col-lg-3">
                @include('components.categories-sidebar')
            </div>
            <div class="col-lg-9">
                <div class="col-lg-12 d-flex flex-column">
                    @forelse ($menus as $menu)
                        <section class="white_card_global mb-5">
                            <div class="white_card_global__header">
                                <h2>{{ $menu->menu }}</h2>    
                            </div>
                            <div class="categories__boxes">                    
                                @forelse ($categories as $category)
                                    @if ($category->menu_id == $menu->id && count($category->products) > 0)
                                    <div class="categories__boxes__category">
                                        <a href="/catalog/{{ $category->slug }}">
                                            @if ($category->image)
                                                <img src="{{ asset('imgs/categories')}}/{{ $category->image  }}" alt="">
                                            @else
                                                <img src="{{ asset('imgs/nopic.png') }}" alt="">
                                            @endif
                                            
                                        <p>{{ $category->category }}</p>
                                        {{-- <div class="categories__boxes__category__price">
                                            от <span class="price">1571,00</span> <i class="fas fa-ruble-sign"></i>
                                        </div> --}}
                                        <div class="category__info">
                                            
                                            @if($category->description != '')
                                                <div class="info">
                                                    <i class="fas fa-info-circle"></i>
                                                </div>
                                                <div class="categories__boxes__category__info">
                                                    <span>{!! $category->description !!}</span>
                                                </div>
                                            @endif
                                            
                                        </div>
                                        </a>
                                    </div>
                                    @endif
                                
                                @empty  

                                @endforelse      
                            
                            </div> 
                        </section> 
                        
                    @empty   
                                
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
      
@endsection