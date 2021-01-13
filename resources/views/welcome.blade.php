@extends('layouts.main-app')
@section('scripts')
    @parent
    <script src="{{ asset('js/discount_countdown.js') }}" defer></script>
@endsection
@section('content')
<div uk-parallax="bgy: -200; blur: 1;" class="headarticle uk-height-large uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top uk-background-blend-multiply">
    <div uk-parallax="scale: 1,1.2; y: 50" class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical">
        <h1 uk-parallax="scale: 1,0.95;" class="uk-background-blend-multiply uk-text-uppercase ">Паркетный мир</h1>
        <p uk-parallax="scale: 1,0.95;" class="uk-text-normal">Огромный опыт работы со всеми видами паркета даёт нам право называться чуть ли не единственной в Крыму командой профессионалов, которая умеет и любит работать с настоящим деревом. А это в современном мире ламината, пвх и линолеума стоит многого! 
            Мы подберём для вас оптимальное решение согласно вашим пожеланиям и бюджету. </p>
    </div>
</div>

<section class="uk-section uk-section-default uk-section-small">
    <div class="uk-container">
        <h2 class="uk-text-muted uk-text-center uk-heading-line"><span>Что нас делает лучшими</span></h2>

        <div class="uk-grid-collapse uk-child-width-expand@m uk-text-center uk-margin-large-top" uk-grid>
            <div class="uk-padding">
                <p class="uk-text-bolder">Огромный опыт работы</p>
                <p>"Паркетный мир" работает в Симферополе с 2001 года</p>
            </div>
            <div class="uk-padding">
                <p class="uk-text-bolder">Доставка по всему Крыму</p>
                <p>Мы осуществляем доставку в любой населенный пункт Крыма</p>
            </div>
            <div class="uk-padding">
                <p class="uk-text-bolder">Профессиональные паркетчики</p>
                <p>С нами работают только опытные мастера паркетного дела</p>
            </div>
            <div class="uk-padding">
                <p class="uk-text-bolder">Современные материалы</p>
                <p>У нас продаётся только профессиональная химия и материалы</p>
            </div>
        </div>
    </div>
</section>

<section class="uk-section uk-section-default uk-section-small">
    <div class="uk-container">
        <div class="uk-overflow-hidden uk-width-1-1">
            <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@m uk-margin" uk-grid>
                <div class="uk-card-media-left uk-cover-container">
                    <img src="{{ asset('imgs/osmo_house_banner.jpg') }}" alt="OSMO масла" uk-cover>
                    <canvas width="600" height="400"></canvas>
                </div>
                <div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">Масла OSMO - идеальная защита для вашего деревянного дома!</h3>
                        <p>Невероятно низкий расход, простота подготовки поверхности, простое обновление - достаточно на очищенную поверхность нанести еще один слой масла, отличная защита древесины от вредителей и УФ-лучей, срок службы двухслойного покрытия до 10 лет, не шелушится и не облазит.</p>
                        <p>Огромный выбор цветов масла OSMO.</p>
                        <p>Стоимость 1 м.кв. покрытия - от 190 руб. (однослойная лазурь OSMO Einmal-Lasur HS PLUS)</p>
                        <p>Сделаем бесплатно выкрас на вашем образце!</p>
                        <p>Получите консультацию в нашем магазине или по телефону:</p>
                        <p class="text-center"><a href="tel:+79788160166" class="uk-text-primary h4"><span class="uk-visible@m">8(978) 816 01 66</span></a></p>
                        <div class="uk-background-primary uk-padding text-white h3">
                            "Паркетный мир" является единственным официальным представителем OSMO в Симферополе!
                        </div>
                    </div>
                </div>
            </div>

            {{-- <img src="{{ asset('imgs/osmo_house_banner.jpg') }}" alt="Example image" class="uk-animation-reverse uk-transform-origin-top-right uk-width-1-1" uk-scrollspy="cls: uk-animation-kenburns; repeat: true"> --}}
        </div>
            {{-- <h1 class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical" uk-parallax="y: 100,0">Масла OSMO - идеальная защита для вашего деревянного дома!</h1>
        
        </div> --}}
    </div>
</section>

<section class="uk-section uk-section-small">
    <div class="bg-light-red">
        <div class="uk-container uk-padding text-white">
            <h2 class="text-center text-white mb-3">Антикризисное предложение: настоящий паркет под ключ - <span class="uk-text-bold">3990</span> руб. за м.кв.*</h2>
            <div uk-grid>
                <div class="uk-width-2-5@m">
                    <h4 class="text-white">Что входит в стоимость</h4>            
                    <ul class="uk-list uk-list-large uk-list-divider">
                        <li>
                            <p class="uk-text-bold">Паркет штучный дубовый 350-490/70/15 мм.</p>
                            Не брак, не остатки и не отходы. Отличный натуральный паркет прямо с завода.</li>
                        <li>
                            <p class="uk-text-bold">Клей паркетный двухкомпонентный Sipol (Lechner, Италия)</p>
                            Профессиональный паркетный клей, который подходит для приклеивания массивной доски.
                        </li>
                        <li>
                            <p class="uk-text-bold">Шпаклевка Lechner</p>
                            Профессиональная шпаклевочная масса, смешиваемая с древесной пылью.
                        </li>
                        <li>
                            <p class="uk-text-bold">Масло с твердым воском OSMO (Германия) шелковисто-матовое, нанесенное в два слоя.</p>
                            Современное финишное покрытие от Европейского лидера в производстве масел и восков для древесины. Достаточно нанести всего два слоя для полноценной защиты пола.
                        </li>
                        <li>
                            <p class="uk-text-bold">Сетки абразивные, бумага шлифовальная, валики/кисти и прочие расходные материалы.</p>
                            Вам не нужно беспокоиться о дополнительных затратах - мы всё предусмотрели заранее!
                        </li>
                        <li>
                            <p class="uk-text-bold">Работа - настил паркета на клей, шлифовка паркета профессиональным оборудованием, шпаклевание всей поверхности пола, нанесение масла с твердым воском в два слоя.</p>
                            Только профессиональные паркетчики, которые знают свое дело.
                        </li>
                        
                        <li>
                            <p class="uk-text-bold">Бесплатный выезд на обследование объекта на предмет готовности к работам.</p>
                            При условии, что мы точно будем работать.
                        </li>
                    </ul>
                </div>
                <div class="uk-width-3-5@m mt-2">
                    <img src="{{ asset('imgs/dub_rustic.jpg') }}" alt="Дуб рустик - паркет штучный">
                    <div class="my-4">Для настила паркета необходима качественная прочная ровная стяжка или деревянное основание (фанера, OSB).</div>
                    <p class="uk-text-light uk-text-small">* не публичная оферта</p>
                    <p class="uk-text-light uk-text-small">Акция действует при условии, что нужно настелить не менее 18 м.кв. паркета</p>
                </div>
            </div>            
        </div>
    </div>
</section>

@if (isset($recomended_products) && count($recomended_products))
    <section class="uk-section uk-section-default uk-section-small">
        <div class="uk-container">
            <h2 class="uk-text-muted uk-text-center uk-heading-line"><span>Лучшее предложение</span></h2>
            <div uk-filter="target: .js-filter">
                <ul class="uk-tab">
                    <li class="uk-active" uk-filter-control="[data-style='recomended']"><a href="#">Рекомендованые товары</a></li>
                    <li uk-filter-control="[data-style='discounted']"><a href="#">Товары со скидкой</a></li>
                </ul>
                <ul class="js-filter uk-child-width-1-3@m " uk-grid="masonry:true" uk-height-match=".uk-card-body" ui-grid>
                    @foreach ($recomended_products as $product)
                        <li data-style="recomended">
                            <div class="uk-card uk-card-default">

                                <div class="uk-card-media-top">
                                    <div class="uk-text-center">
                                        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                                            <img  class="uk-transition-scale-up uk-transition-opaque" 
                                                @if(isset($product->images) && count($product->images) > 0)
                                                    data-src="{{ asset('imgs/products/thumbnails/')}}/{{ $product->main_or_first_image->thumbnail }}"
                                                    alt="{{ $product->main_or_first_image->alt }}"
                                                @else 
                                                    data-src="{{ asset('imgs/nopic.png')}}"
                                                @endif data-width="1000" data-height="667" uk-img="">
                                            {{-- <div class="uk-position-center">
                                                <span class="uk-transition-fade" uk-icon="icon: plus; ratio: 2"></span>
                                            </div> --}}
                                        </div>
                                    </div>
                                <div class="uk-card-badge uk-label">Рекомендуем</div>
                                </div>

                                <div class="uk-card-body">
                                    <h3 class="uk-card-title">{{ $product->product }} @if (isset($product->category))
                                        {{ ', ' . $product->category->category }}
                                    @endif</h3>
                                    {{-- <p class="uk-text-truncate">{{ $product->description ?? '' }}</p> --}}
                                    <div class="uk-child-width-auto uk-flex-middle" uk-grid>
                                        <div>
                                            <span class="uk-text-emphasis uk-text-bold uk-text-large">{{ $product->discount_price }} р/{{ $product->unit->unit ?? 'ед.' }}</span>
                                        </div>
                                        {{-- <div>
                                            <ul class="uk-iconnav uk-flex-right">
                                                <li><a href="#" uk-icon="icon: heart"></a></li>
                                                <li><a href="#" uk-icon="icon: comment"></a></li>
                                                <li><a href="#" uk-icon="icon: star"></a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    
                                    <p class="uk-text-small uk-text-muted">
                                        @if ($product->scu != '')
                                            <span class="uk-margin-right">{{ 'арт.: ' . $product->scu }}</span>
                                        @endif
                                        <span><a href="{{ route('manufacture', $product->manufacture->slug) }}">{{ $product->manufacture->manufacture ?? '' }}</a></span>
                                    </p>
                                    
                                </div>
                                    
                                <div class="uk-card-footer">
                                    <div class="uk-flex uk-flex-between">
                                        @if($product->category->parent_id)
                                            <a class="uk-button uk-button-default" href="{{ route('product.subcategory', ['category' => $product->category->slug, 'subcategory' => $product->category->parent_id, 'product' => $product->slug]) }}">Подробнее</a>
                                        @else
                                            <a class="uk-button uk-button-default" href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}">Подробнее</a>
                                        @endif
                                        {{-- <button class="uk-button uk-button-primary uk-text-right">
                                            <span uk-icon="icon: cart;"></span>
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach                    
                </ul>

                <ul class="js-filter uk-child-width-1-3@m " uk-grid="masonry:true" uk-height-match=".uk-card-body" ui-grid>
                    @foreach ($discount_products as $product)
                        <li data-style="discounted">
                            <div class="uk-card uk-card-default">

                                <div class="uk-card-media-top">
                                    <div class="uk-text-center">
                                        <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                                            <img  class="uk-transition-scale-up uk-transition-opaque" 
                                                @if(isset($product->images) && count($product->images) > 0)
                                                    data-src="{{ asset('imgs/products/thumbnails/')}}/{{ $product->main_or_first_image->thumbnail }}"
                                                    alt="{{ $product->main_or_first_image->alt }}"
                                                @else 
                                                    data-src="{{ asset('imgs/nopic.png')}}"
                                                @endif data-width="1000" data-height="667" uk-img="">
                                            {{-- <div class="uk-position-center">
                                                <span class="uk-transition-fade" uk-icon="icon: plus; ratio: 2"></span>
                                            </div> --}}
                                        </div>
                                    </div>
                                <div class="uk-card-badge uk-label-danger"uk-tooltip="Скидка {{ $product->discount->value ?? '--' }} {{ $product->discount->rus_type ?? '--' }}">&minus; {{ $product->discount->value ?? '--' }} {{ $product->discount->rus_type ?? '--' }}</div>
                                </div>

                                <div class="uk-card-body">
                                    <h3 class="uk-card-title">{{ $product->product }} @if (isset($product->category))
                                        {{ ', ' . $product->category->category }}
                                    @endif</h3>
                                    {{-- <p class="uk-text-truncate">{{ $product->description ?? '' }}</p> --}}
                                    <div class="uk-child-width-auto uk-flex-middle" uk-grid>
                                        <div>
                                            <span class="uk-text-emphasis uk-text-bold uk-text-large">{{ $product->discount_price }} р/{{ $product->unit->unit ?? 'ед.' }}</span>
                                        </div>
                                        {{-- <div>
                                            <ul class="uk-iconnav uk-flex-right">
                                                <li><a href="#" uk-icon="icon: heart"></a></li>
                                                <li><a href="#" uk-icon="icon: comment"></a></li>
                                                <li><a href="#" uk-icon="icon: star"></a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    
                                    <p class="uk-text-small uk-text-muted">
                                        @if ($product->scu != '')
                                            <span class="uk-margin-right">{{ 'арт.: ' . $product->scu }}</span>
                                        @endif
                                        <span><a href="{{ route('manufacture', $product->manufacture->slug) }}">{{ $product->manufacture->manufacture ?? '' }}</a></span>
                                    </p>
                                    
                                </div>
                                    
                                <div class="uk-card-footer">
                                    <div class="uk-flex uk-flex-between">
                                        @if($product->category->parent_id)
                                            <a class="uk-button uk-button-default" href="{{ route('product.subcategory', ['category' => $product->category->slug, 'subcategory' => $product->category->parent_id, 'product' => $product->slug]) }}">Подробнее</a>
                                        @else
                                            <a class="uk-button uk-button-default" href="{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}">Подробнее</a>
                                        @endif
                                        {{-- <button class="uk-button uk-button-primary uk-text-right">
                                            <span uk-icon="icon: cart;"></span>
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach                    
                </ul>
            </div>
        </div>
    </section>
@endif

<section class="uk-section uk-section-default uk-section-small">
    <div class="uk-container">
        <h2 class="uk-text-muted uk-text-center uk-heading-line"><span>Категории товаров</span></h2>
        <div class="uk-child-width-1-3@s" ui-grid  uk-grid="masonry:true">
            @forelse ($menus as $menu)
                @forelse ($menu->category as $category)
                    <div>
                        <div class="uk-inline">
                            @if ($category->image)
                                <img src="{{ asset('imgs/categories')}}/{{ $category->image  }}" alt="{{ $category->category }}">
                            @else
                                <img src="{{ asset('imgs/nopic.png') }}" alt="{{ $category->category }}">
                            @endif
                            <div class="uk-overlay uk-overlay-default uk-position-center uk-text-large uk-text-bolder">
                                <p>
                                    <a href="/catalog/{{ $category->slug }}">{{ $category->category }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            @empty
            @endforelse
        </div>
    </div>
</section>

<section class="uk-section uk-section-default uk-section-small">
    <div class="uk-container">
        <h2 class="uk-text-muted uk-text-center uk-heading-line"><span>Услуги</span></h2>
        <h4 class="uk-text-muted uk-text-center">Наши специалисты выполняют работы по всему Крыму</h2>

        <ul class="uk-list uk-list-large uk-list-divider">
            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">Укладка ламината</div>
                    <div>300.00 р</div>
                </div>
            </li>
            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">Укладка паркетной доски на подложку (плавающий способ)</div>
                    <div>350.00 р</div>
                </div>
            </li>
            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">Укладка паркетной/инженерной доски под финишным покрытием на клей</div>
                    <div>600.00 р</div>
                </div>
            </li>
            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">Укладка паркетной/инженерной/массивной доски под финишным покрытием на клей с фанерой</div>
                    <div>800.00 р</div>
                </div>
            </li>
            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">Укладка паркета штучного (рисунок "палуба") на клей + финишное покрытие лаком/масло-воском</div>
                    <div>1300.00 р</div>
                </div>
            </li>
            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">Укладка паркета штучного (рисунок "палуба") на клей и фанеру + финишное покрытие лаком/масло-воском</div>
                    <div>1600.00 р</div>
                </div>
            </li>
            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">Укладка массивной доски (рисунок "палуба") на клей + финишное покрытие лаком/масло-воском</div>
                    <div>1400.00 р</div>
                </div>
            </li>
            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">Укладка массивной доски (рисунок "палуба") на клей и фанеру + финишное покрытие лаком/масло-воском</div>
                    <div>1700.00 р</div>
                </div>
            </li>
            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">Шлифовка паркета и нанесение финишного покрытия (лак/масло-воск)</div>
                    <div>от 700.00 р</div>
                </div>
            </li>
            <li>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">Шлифовка паркета и нанесение финишного покрытия (лак/масло-воск) с материалами</div>
                    <div>от 1400.00 р</div>
                </div>
            </li>
        </ul>
    </div>
</section>
<section class="uk-section uk-section-default uk-section-small">
    <div class="uk-container">
        <h2 class="uk-text-muted uk-text-center uk-heading-line"><span>Услуги шлифовки паркета "под ключ"</span></h2>
        <p class="uk-text-muted uk-text-center">Мы используем только профессиональные химию и технологии!</p>
        <p class="uk-text-muted uk-text-center">Кроме приведённых ниже основных вариантов шлифовки паркета, есть и другие варианты и комбинации. Обращайтесь к нам, чтобы мы составили оптимальное предложение, исходя из ваших индивидуальных запросов и условий.</p>
        <div class="uk-grid uk-grid-small uk-child-width-1-3@m uk-margin-medium-top uk-grid-match" data-uk-scrollspy="cls: uk-animation-slide-bottom-small; target: > div > .uk-card; delay: 200" data-uk-grid="">
					
            <div class="uk-first-column">
                <div class="uk-card uk-card-default uk-card-hover uk-flex uk-flex-column uk-scrollspy-inview" data-uk-scrollspy-class="uk-animation-slide-left-small">
                    <div class="uk-card-header uk-text-center">
                        <h4 class="uk-text-bold">Базовая</h4>
                    </div>
                    <div class="uk-card-body uk-flex-1">
                        <div class="uk-flex uk-flex-middle uk-flex-center">
                            <span style="font-size: 4rem; font-weight: 200; line-height: 1em">
                                1 400<span style="font-size: 0.5em">руб</span>
                            </span>
                        </div>
                        <div class="uk-text-small uk-text-center uk-text-muted">Цена за 1 м.кв., включающая материалы и работу</div>
                        <ul>
                            <li class="uk-margin-bottom">Шлифовка барабанной шлифовальной машиной</li>
                            <li class="uk-margin-bottom">Шпаклевание всей поверхности паркета</li>
                            <li class="uk-margin-bottom">Нанесение уретанового лака в три слоя</li>                            
                        </ul>
                    </div>
                    {{-- <div class="uk-card-footer">
                        <a href="#" class="uk-button uk-button-primary uk-width-1-1">КУПИТЬ</a>
                    </div> --}}
                </div>
            </div>

            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-flex uk-flex-column uk-scrollspy-inview">
                    <div class="uk-card-header uk-text-center">
                        <h4 class="uk-text-bold">Улучшенная</h4>
                    </div>
                    <div class="uk-card-body uk-flex-1">
                        <div class="uk-flex uk-flex-middle uk-flex-center">
                            <span style="font-size: 4rem; font-weight: 200; line-height: 1em">
                                2 000<span style="font-size: 0.5em">руб</span>
                            </span>
                        </div>
                        <div class="uk-text-small uk-text-center uk-text-muted">Цена за 1 м.кв., включающая материалы и работу</div>
                        <ul>
                            <li class="uk-margin-bottom">Шлифовка барабанной и плоской шлифовальными машинами</li>
                            <li class="uk-margin-bottom">Шпаклевание всей поверхности паркета</li>
                            <li class="uk-margin-bottom">На ваш выбор:
                                <ul>
                                    <li>нанесение двух слоёв масла с твёрдым воском OSMO</li>
                                    <li>нанесение однокомпонентного немецкого лака Loba или Bona в три слоя</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="uk-card-footer">
                        <a href="/" class="uk-button uk-button-primary uk-width-1-1">КУПИТЬ</a>
                    </div> --}}
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-flex uk-card-hover uk-flex-column uk-scrollspy-inview" data-uk-scrollspy-class="uk-animation-slide-right-small" style="">
                    <div class="uk-card-header uk-text-center">
                        <h4 class="uk-text-bold">Максимальная</h4>
                    </div>
                    <div class="uk-card-body uk-flex-1">
                        <div class="uk-flex uk-flex-middle uk-flex-center">
                            <span style="font-size: 4rem; font-weight: 200; line-height: 1em">
                                2 800<span style="font-size: 0.5em">руб</span>
                            </span>
                        </div>
                        <div class="uk-text-small uk-text-center uk-text-muted">Цена за 1 м.кв., включающая материалы и работу</div>
                        <ul>
                            <li class="uk-margin-bottom">Шлифовка барабанной и плоской шлифовальными машинами</li>
                            <li class="uk-margin-bottom">Шпаклевание всей поверхности паркета</li>
                            <li class="uk-margin-bottom">На ваш выбор:
                                <ul>
                                    <li>нанесение двух слоёв масла с твёрдым воском OSMO</li>
                                    <li>нанесение двухкомпонентного немецкого лака Loba или Bona в три слоя</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="uk-card-footer">
                        <a href="/" class="uk-button uk-button-primary uk-width-1-1">КУПИТЬ</a>
                    </div> --}}
                </div>
            </div>
            <div class="uk-first-column uk-width-1-1">
                <div class="uk-card uk-card-large uk-card-default uk-padding uk-text-center">                    
                    <div class="">
                        <span class="uk-text-success" data-uk-icon="icon:check; ratio:2.5"></span>
                        <span class="uk-text-bold uk-margin-left">Мы принимаем безналичную оплату за работу!</span>
                    </div>                    
                </div>
            </div>
            
        </div>
        <p class="uk-text-muted uk-text-left">Цены на шлифовку паркета "под ключ" указаны на объекты площадью от 15 м.кв.</p>
    </div>
</section>

<section class="uk-section">
    <div class="uk-container">
        <div class="uk-child-width-1-2" uk-grid>
            <div>
                <h2 class="uk-text-muted uk-text-center uk-heading-line"><span>Сдаём в аренду шлифовальную машину барабанного типа</span></h2>
                
                <h4 class="uk-text-muted uk-text-center">Условия аренды:</h2>

                <ul class="uk-list uk-list-large uk-list-divider">
                    <li>
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-expand">Стоимость аренды в сутки</div>
                            <div>1 000.00 р</div>
                        </div>
                    </li>
                    <li>
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-expand">Залоговая стоимость</div>
                            <div>35 000.00 р</div>
                        </div>
                    </li>                        
                </ul>

                <p>Шлифовальная машина барабанного типа для шлифовки паркета и деревянных полов. Не допускается шлифовка полов с торчащими гвоздями, саморезами и другими металлическими предметами, способными повреждение резины, наклеенной на барабан.</p>
            </div>
            <div class="co_206">                
                <img src="{{ asset('imgs/co-206.jpg')}}" alt="">
            </div>
        </div>  
    </div>
</section>

<section class="uk-section uk-section-primary uk-section-small uk-light">
    <div class="uk-container">
        <div class="uk-text-center">
            <div class="uk-h2 uk-margin-remove">Есть вопросы по товарам или услугам?</div>
        </div>
        <div class="uk-margin">
            <form>
                <div class="uk-grid-small uk-flex-center uk-grid" uk-grid="">
                    <div class="uk-width-1-1 uk-text-center uk-first-column">
                        <div class="uk-inline uk-width-1-1">      
                            <h1>                    
                                <a href="tel:+79788160166" class="uk-text-primary">
                                    <span>8(978) 816 01 66</span>
                                </a>
                            </h1>  
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="uk-section uk-section-small uk-mutted">
    <div class="uk-container">
        <h2 class="uk-text-small uk-text-muted">
            Купить паркет, ламинат, пробковый паркет, паркетную доску, инженерную доску, массив без покрытия, под лаком или маслом дешево с доставкой Посимферполю, в Севастополь, Ялту, Керчь, Евпаторию, Алушту, Феодосию, Джанкой, Саки. Продажа химии для укладки, реставрации паркета: лаки двухкомпонентные и однокомпонентные, уретановые, полиуретановые, на водной основе, грунтовки для паркета, шпаклевки, клей двухкомпонентный полиуретановый и полиуретан-эпоксидный, силановый, реактивный для любого вида паркета. Масла и воски цветные и бесцветные для внутренних и наружних работ. Пропитки для защиты древесины. Паркет из экзотических пород дерева: мербау, тик бирманский, палисандр, орех, ятоба, кемпас, бунга. Паркет в ванную комнату. Bona, Osmo, Loba, Polar wood, Haro, Komofloor, LabArte, Папа Карло, GreenLine, MGK floor, Lechner, Berger, Karelia, Finitura decor, Kastamonu. Скидки и акции. Профессиональная укладка и ремонт, циклевка любого вида паркета. Возмаожна безналичная оплата за работу.
        </h2>
    </div>
</section>
@endsection