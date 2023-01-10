@extends('layouts.main-app')
@section('scripts')
    @parent
    <script src="{{ asset('js/discount_countdown.js') }}" defer></script>
@endsection
@section('content')
<article>
        <div class="headarticle">
            <section class="headsection">
                <div class="headsection__body">
                    <div class="headsection__body__left">
                        <h1>Продажа, укладка и ремонт паркета в Крыму</h1>
                        <h2 class="headsection__body__left__text">
                            Огромный опыт работы со всеми видами паркета даёт нам право называться чуть ли не единственной в Крыму командой профессионалов, которая умеет и любит работать с настоящим деревом. А это в современном мире ламината, пвх и линолеума стоит многого! 
                            Мы подберм для вас оптимально решение согласно вашим пожеланиям и бюджету.                        </h2>
                        <div class="headsection__btn">
                            {{-- <div class="btn main_btn">
                                <div class="main_btn__left">
                                    <i class="fas fa-ruble-sign"></i>
                                </div>
                                <div class="main_btn__right">
                                    Сделать заказ
                                </div>
                            </div> --}}
                            <div class="btn help_btn">
                                <div class="help_btn__left">
                                    <i class="fas fa-question"></i>
                                </div>
                                <div class="help_btn__right">Задать вопрос</div>
                            </div>
                        </div>
                    </div>
                    <div class="headsection__body__right">
                    </div>
                </div>
            </section>
        </div>
        @if (count($articles) > 0)
            <section class="top1">
                <div class="container">
                    <div class="top1__boxes">
                        @foreach ($articles as $article)
                            <div class="top1_box">
                                <a href="{{ route('article', ['article' => $article->slug]) }}">
                                    <img src="{{asset('imgs/articles')}}/{{ $article->img }}" alt="">
                                    <p>{{ $article->article }}</p>
                                </a>
                            </div>    
                        @endforeach
                        <div class="top1_box_all">
                            <a href="{{asset('articles')}}">Все статьи...</a>
                        </div>
                    </div>
                </div>
            </section> 
        @endif
        <section id="recomended_products">
            <div class="container">
                @if (isset($recomended_products) && count($recomended_products))
                <div class="recomended_products white_card_global">
                    <div class="white_card_global__header">
                        Рекомендованые товары    
                    </div>
                        <div class="recomended_products__slider row">
                            @foreach ($recomended_products as $product) 
                                <div class="col-12  col-md-6 col-lg-3 p-2">
                                    <div class="products__card">
                                        <div class="recomended_products__item__img">
                                            <img  class="img-fluid" 
                                            @if(isset($product->images) && count($product->images) > 0)
                                                src="{{ asset('imgs/products/thumbnails/')}}/{{ $product->main_or_first_image->thumbnail }}"
                                                alt="{{ $product->main_or_first_image->alt }}"
                                            @else 
                                                src="{{ asset('imgs/nopic.png')}}"
                                            @endif > 
                                        </div>
                                        <div class="recomended_products__item__title">
                                            @if($product->category->parent_id)
                                                <a href="{{ route('product.subcategory', ['category' => $product->category->slug, 'subcategory' => $product->category->parent_id, 'product' => $product->slug]) }}">{{ $product->product }}</a>
                                            @else
                                                <a href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}">{{ $product->product }}</a>
                                            @endif
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
                                    </div>                          
                                </div>
                            @endforeach   
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <div class="modal_send_question">
            <div class="modal_send_question__header">
                Задать вопрос
                <div class="modal_send_question__header__close">
                    
                </div>
            </div>
            <form id="send_question">
                @csrf
                <input type="text" id="question_phone" name="phone" placeholder="Номер телефона" required>
                <input type="text" id="question_name" name="name" placeholder="Имя" required>
                <textarea id="question_question" name="question" placeholder="Ваш вопрос" required maxlength="500" rows="5"></textarea>
                <div id="question">Отправить</div>
            </form>
        </div>
        <section class="categories">
            <div class="container">
            @forelse ($menus as $menu)
            <section>
            <div class="recomended_products white_card_global">
                    <div class="white_card_global__header">
                        <h2>{{ $menu->menu }}</h2>    
                    </div>
                    <div class="categories__boxes">                    
                            @forelse ($categories as $category)
                        {{-- @php
                            dd($category);
                        @endphp --}}
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
                                                <span>{!! $category->short_description !!}</span>
                                            </div>
                                        @endif
                                        
                                     </div>
                                    </a>
                                </div>
                                @endif
                            
                            @empty                        
                            @endforelse      
                        
                </div>
            </div>  
        </section>              
            @empty   
                         
            @endforelse
            </div>
        </section>
        {{-- <section class="about_main">
            <div class="wrap">
                {!! $about->main_text ?? '' !!}
            </div>
            
        </section> --}}
        <section>
            <div class="container content">
                
            </div>
        </section>
    </article>
    <aside>

    </aside>
@endsection