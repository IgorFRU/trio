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
                            Самый большой опыт в паркетном деле на территории Крыма даёт нам уверенность в работе как с традиционными видами паркета, так и с авангардными материалами.
                        </h2>
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
                                <div class="help_btn__right"> <!-- container -->
                                   Задать вопрос
                                </div>
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
                <div class="wrap">
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
            <div class="wrap">
                @if (isset($recomended_products) && count($recomended_products))
                <div class="recomended_products white_card_global">
                    <div class="white_card_global__header">
                        Рекомендованые товары    
                    </div>
                        <div class="recomended_products__slider">
                            @foreach ($recomended_products as $product) 
                                <div class="recomended_products__item grey_card_global">
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
                                        {{-- @if($product->category->parent_id)
                                            <a href="{{ route('product.subcategory', ['category' => $product->category->slug, 'subcategory' => $product->category->parent_id, 'product' => $product->slug, 'parameter' => '']) }}">{{ $product->product }}</a>
                                        @else --}}
                                            <a href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug, 'parameter' => '']) }}">{{ $product->product }}</a>
                                        @endif
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
            <div class="wrap">
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
            </div>  
        </section>              
            @empty   
                         
            @endforelse
            </div>
        </section>
        <section class="about_main">
            
            
        </section>
        <section>
            <div class="wrap content">
                
            </div>
        </section>
    </article>
    <aside>

    </aside>
@endsection