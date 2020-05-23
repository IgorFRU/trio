<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? "Паркетный мир - Симферополь. Продажа, укладка, ремонт паркета, ламината, паркетной доски, массивной и инженерной доски. Всё для паркета: клеи, лаки, масла и воски. Доставка паркета по Крыму и Симферополю."}}</title>

    <meta description="{{ $meta_description ?? "Паркетный мир - Симферополь. Купить все виды паркета в Крыму по лучшим ценам! Укладка, ремонт и реставрация паркета. Ламинат, паркетная доска, массивная и инженерная доска, клей и лак для паркета, масла и воски" }}">
    <meta keywords="{{ $meta_keywords ?? "" }}">

    {{-- <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(20781085, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/20781085" style="position:absolute; left:-9999px;" alt="" /></div></noscript> --}}
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('/imgs/favicon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('/imgs/favicon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('/imgs/favicon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('/imgs/favicon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('/imgs/favicon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('/imgs/favicon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('/imgs/favicon/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('/imgs/favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('/imgs/favicon/favicon-16x16.png') }}" sizes="16x16" />
    <meta name="application-name" content="Паркетный Мир"/>
    <meta name="msapplication-TileColor" content="#254E94" />
    <meta name="msapplication-TileImage" content="{{ asset('/imgs/favicon/mstile-144x144.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ asset('/imgs/favicon/mstile-310x310.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&amp;subset=cyrillic-ext" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.4.2/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.4.2/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.4.2/js/uikit-icons.min.js"></script>



    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    
    <script src="https://use.fontawesome.com/564e0d687f.js"></script>

</head>

<body>    
    <div class="small_menu uk-text-small">
        <div class="uk-container">
            @forelse ($topmenu as $topmenu_item)
                <a href="{{ route('staticpage', $topmenu_item->slug) }}" class="uk-padding uk-padding-remove-vertical">{{ $topmenu_item->title }}</a>
            @empty
                
            @endforelse
            <a href="{{ route('questions') }}" class="uk-padding uk-padding-remove-vertical"><span uk-icon="question" uk-tooltip="Ваши вопросы и ответы"></span> <span class="uk-visible@m">Вопросы и ответы</span></a>
            <a href="{{ route('articles') }}" class="uk-padding uk-padding-remove-vertical">Статьи</a>
            <a href="{{ route('sales') }}" class="topmenu__left__red uk-padding uk-padding-remove-vertical">Акции</a>
        </div>
    </div>
    <nav class="uk-navbar-container uk-box-shadow-small" uk-navbar  uk-sticky="animation: uk-animation-slide-top">
        <div class="uk-navbar-left">    
            <ul class="uk-navbar-nav">
                <a class="uk-navbar-item uk-logo uk-text-center uk-visible@s" href="{{ route('index') }}">
                    <div>
                        <span class="uk-text-bold uk-text-uppercase">Паркетный мир</span>
                        
                        <div class="uk-navbar-subtitle uk-text-lowercase uk-text-small">все виды паркета в Крыму по лучшим ценам</div>
                    </div>
                </a>

                <div class="uk-navbar-container uk-hidden@m" uk-navbar>
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-toggle" href="" uk-toggle="target: #offcanvas-nav">
                            <span uk-navbar-toggle-icon class="uk-text-bold"></span> <span class="uk-margin-small-left uk-text-bold uk-visible@s">Меню</span>
                        </a>
                    </div>
                </div>                
                
                <li class="uk-visible@m">
                    <a href="#" class="uk-text-large">
                        <span class="uk-text-bold"><span uk-icon="icon: chevron-down"></span> Каталог</span></a>
                    <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; boundary-align: true; pos: bottom-justify;" uk-overflow-auto>                        
                        <div class="uk-navbar-dropdown-grid {{ 'uk-child-width-1-3' }}" uk-grid>
                            @forelse ($menus as $menu)
                                <div>
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li class="uk-nav-header uk-text-bold">{{ $menu->menu }}</li>
                                        @forelse ($menu->category as $category)
                                            <li class="uk-active"><a class="" href="/catalog/{{ $category->slug }}">{{ $category->category }}</a></li>
                                            
                                            @forelse ($category->children as $children)
                                                <li><a href="/catalog/{{ $children->slug }}">{{ $children->category }}</a>
                                            @empty                                                
                                            @endforelse
                                            <li class="uk-nav-divider"></li>
                                        @empty                                    
                                        @endforelse
                                        
                                    </ul>
                                </div>                                
                            @empty
                                
                            @endforelse
                        </div>
                    </div>
                </li>                
           </ul>
    
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav nav-overlay">
                <li>
                    <a href="#">
                        <span class="uk-icon uk-margin-small-right" uk-icon="icon: location"></span>
                        <span class="uk-visible@l">пр. Победы, 129/2, Симферополь</span>                        
                    </a>
                    <div class="uk-navbar-dropdown" uk-drop="boundary: !nav; boundary-align: true; pos: bottom-justify;">   
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af4cc3b8a1534db3bd226df3963ccc096015a2a811264e967efbacb43c7e2b450&amp;width=100%25&amp;height=280&amp;lang=ru_RU&amp;scroll=true"></script>
                        </ul>
                    </div>
                </li>
                <li class="nav-overlay">
                    @if ($settings->phone_1 != NULL && $settings->phone_1 != '')
                        <a href="tel:{{ $settings->full_main_phone }}" class="uk-text-primary">
                            <span class="uk-icon uk-margin-small-right" uk-icon="icon: phone"></span>
                            <span class="uk-visible@m">{{ $settings->main_phone }}</span>
                        </a>
                    @else
                        <a href="tel:+79788160166" class="uk-text-primary">
                            <span class="uk-icon uk-margin-small-right" uk-icon="icon: phone"></span>
                            <span class="uk-visible@m">8(978) 816 01 66</span>
                        </a>
                    @endif
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                @if ($settings->phone_1 != NULL && $settings->phone_1 != '')
                                    <li class="uk-active uk-text-normal">
                                        <a href="tel:{{ $settings->full_main_phone }}" class="uk-text-primary">{{ $settings->main_phone }}</a>
                                        <ul class="uk-text-small">
                                            <li>Информация о товарах</li>
                                            <li>Заказ продукции</li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="uk-active uk-text-normal">
                                        <a href="tel:+79788160166" class="uk-text-primary">8(978) 816 01 66</a>
                                        <ul class="uk-text-small">
                                            <li>Информация о товарах</li>
                                            <li>Заказ продукции</li>
                                        </ul>
                                    </li>
                                @endif
                                <li class="uk-nav-divider"></li>
                                <li class="uk-active uk-text-normal">
                                    <a href="tel:+79788808206" class="uk-text-primary">+7 (978) 880 82 06</a>
                                    <ul class="uk-text-small">
                                        <li>Паркетные работы</li>
                                    </ul>
                                </li>
                                <li class="uk-nav-divider"></li>
                                <li class="uk-nav-header">Режим работы:</li>
                                <li class="uk-text-success uk-flex uk-flex-between">
                                    <div>ПН-ПТ</div>
                                    <div>09:00 - 18:00</div>
                                </li>
                                <li class="uk-text-success uk-flex uk-flex-between">
                                    <div>СБ</div>
                                    <div>09:00 - 16:00</div>
                                </li>
                                <li class="uk-text-danger uk-flex uk-flex-between">
                                    <div>ВС</div>
                                    <div>Выходной</div>
                                </li>
                            </ul>
                        </div>
                </li>
                <li>                    
                    <a href="#question-modal" class="uk-text-primary" uk-toggle="target: #question-modal">
                        <span class="uk-icon uk-margin-small-right" uk-icon="icon: mail"></span>
                        <span class="uk-visible@l">Обратная связь</span>
                    </a>
                    
                </li>
                {{-- <a class="uk-navbar-toggle" uk-search-icon uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a> --}}
            </ul>
        </div>
        <div class="nav-overlay uk-navbar-left uk-flex-1" hidden>

            <div class="uk-navbar-item uk-width-expand">
                <form class="uk-search uk-search-navbar uk-width-1-1">
                    <input class="uk-search-input" type="search" placeholder="Search..." autofocus>
                </form>
            </div>
    
            <a class="uk-navbar-toggle" uk-close uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
    
        </div>
        
    </nav>

    <div id="offcanvas-nav" uk-offcanvas="overlay: true">
        <div class="uk-offcanvas-bar">
    
            <ul class="uk-nav uk-nav-default">
                <a class="uk-navbar-item uk-logo uk-text-primary uk-text-center uk-background-primary uk-hidden@s" href="{{ route('index') }}">
                    <div>
                        <span class="uk-text-bold uk-text-uppercase">Паркетный мир</span>
                        
                        <div class="uk-navbar-subtitle uk-text-lowercase uk-text-small uk-visible@m">все виды паркета в Крыму по лучшим ценам</div>
                    </div>
                </a>
                @forelse ($menus as $menu)
                    <li class="uk-nav-header">{{ $menu->menu }}</li>
                    @forelse ($menu->category as $category)
                        <li class="uk-active"></li>
                        <li class="uk-parent">
                            <a class="" href="/catalog/{{ $category->slug }}">{{ $category->category }}</a>
                            <ul class="uk-nav-sub">
                                @forelse ($category->children as $children)
                                    <li><a href="/catalog/{{ $children->slug }}">{{ $children->category }}</a></li>
                                @empty                                                
                                @endforelse
                            </ul>
                        </li>
                        <li class="uk-nav-divider"></li>
                    @empty                                    
                    @endforelse
                                                           
                @empty                    
                @endforelse
            </ul>    
        </div>
    </div>

    <div id="question-modal" class="uk-modal-full" uk-modal>
        <div class="uk-modal-dialog">    
            <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>    
            <div data-uk-img="" data-src="/images/photo2.jpg" class="uk-flex uk-flex-center uk-flex-middle uk-background-cover" uk-height-viewport>    
                <div class="uk-overlay-primary uk-position-cover"></div>    
                <div class="uk-overlay uk-position-center uk-light">    
                    <form id="send_question">
                        <div class="uk-margin">
                            <div class="uk-inline">    
                                <span class="uk-form-icon" uk-icon="icon: phone"></span>    
                                <input class="uk-input" type="tel" id="question_phone" name="phone" placeholder="Номер телефона" required>    
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-inline">    
                                <span class="uk-form-icon" uk-icon="icon: user"></span>    
                                <input class="uk-input" type="text" id="question_name" name="name" placeholder="Имя" required>    
                            </div>
                        </div>
                        <textarea class="uk-textarea" id="question_question" name="question" placeholder="Ваш вопрос" required maxlength="500" rows="5"></textarea>
                        <div class="uk-margin">    
                            <button class="uk-button uk-button-default" id="question">Отправить</button>    
                        </div>    
                    </form>    
                </div>    
            </div>    
        </div>    
    </div>
    <main>

        @yield('content')
        
    </main>
        @include('layouts.footer')
<script>
    const link_sort = document.querySelectorAll('.sortlink');
    link_sort.forEach(element => {
        element.addEventListener('click', (event) => {
            event.preventDefault();
            window.location.href = window.location.href + '/anyroute/?sort_column=' + element.dataset.sort_col + '&sort_type=' + element.dataset.sort_type;
        });
    });

</script>
</body>

</html>
