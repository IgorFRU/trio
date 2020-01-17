<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? "Паркетный мир - Симферополь. Продажа, укладка, ремонт паркета, ламината, паркетной доски, массивной и инженерной доски. Всё для паркета: клеи, лаки, масла и воски. Доставка паркета по Крыму и Симферополю."}}</title>

    <meta description="{{ $meta_description ?? "Паркетный мир - Симферополь. Купить все виды паркета в Крыму по лучшим ценам! Укладка, ремонт и реставрация паркета. Ламинат, паркетная доска, массивная и инженерная доска, клей и лак для паркета, масла и воски" }}">
    <meta keywords="{{ $meta_keywords ?? "" }}">

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
    

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    
    <script src="https://use.fontawesome.com/564e0d687f.js"></script>

</head>

<body>

    <!-- MENU START -->
    <header>
        <div class="menu">
            <div class="topmenu">
                <div class="wrap">
                    <div class="topmenu__body">
                        <div class="topmenu__left">
                            @forelse ($topmenu as $topmenu_item)
                                <a href="{{ route('staticpage', $topmenu_item->slug) }}">{{ $topmenu_item->title }}</a>
                            @empty
                                
                            @endforelse
                            <a href="{{ route('articles') }}">Статьи</a>
                            <a href="{{ route('sales') }}" class="topmenu__left__red">Акции</a>
                        </div>


                        {{-- <div>
                            <li class="topmenu__work_today"><i class="fas fa-clock"></i> Сегодня работаем до 18:00</li>
                            <div>
                                <ul>
                                    <li>ПН-ПТ: 09:00 - 18:00</li>
                                    <li>СБ: 09:00 - 16:00</li>
                                    <li class="redtext">ВС: ВЫХОДНОЙ</li>
                                </ul>
                            </div>
                        </div> --}}
                        {{-- <div class="topmenu__right">
                            <a href="#"><i class="fas fa-sign-in-alt"></i>  Вход</a>
                            <a href="#"><i class="fas fa-user-plus"></i>  Регистрация</a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="fastmenu">
                <div class="wrap">
                    <div class="fastmenu__body">
                        <div class="logo">
                            <div class="logo__body">
                                <a href="{{ route('index') }}">
                                    <h1>Паркетный Мир</h1>
                                </a>
                            </div>
                            <div class="logo__tagline">все виды паркета в Крыму по лучшим ценам</div>
                        </div>
                        <div class="fastmenu__location">
                            <ul>
                                <li><i class="fas fa-map-marker-alt"></i> Симферополь</li>
                                <li>пр. Победы, 129/2</li>
                            </ul>
                        </div>
                        <ul class="fastmenu__body__tel">

                            
                            @if ($settings->phone_1 != NULL && $settings->phone_1 != '')
                                <li><a href="tel:{{ $settings->full_main_phone }}">{{ $settings->main_phone }}</a></li>
                            @else
                                <li><a href="tel:+79788160166">8(978) 816 01 66</a></li>
                            @endif
                            {{-- <li class="fastmenu__body__tel__hide"><a href="tel:+79788808206">8(978) 880 82 06</a></li> --}}

                            {{-- <li><a href="#" class="callme">Обратный звонок</a></li> --}}
                        </ul>
                        {{-- <div class="fastmenu__body__right">
                            <div class="fastmenu__body__right__search">
                                <i class="fas fa-search"></i>
                                <div class="search__form">
                                    <form action="">
                                        <input type="search" placeholder="Поиск..." name="search">
                                    </form>
                                </div>

                            </div>
                            <div class="fastmenu__body__right__shopping_cart">
                                <i class="fas fa-shopping-cart"></i>
                                <span>5</span>
                            </div>
                        </div> --}}
                    </div>
                </div>

            </div>
            <div class="fastmenu__tosmall">
                <span></span>
                <span></span>
                <p>Паркетный мир</p>
            </div>
        </div>
    </header>
    <menu class="mainmenu">
        {{-- <div class="mainmenu__burger">
            <div class="burger">Меню
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div> --}}
        <ul class="mainmenu__ul">
            <li class="mainmenu__li"><a href="{{ route('index') }}" class="mainmenu__a"><i class="fas fa-home"></i></a></li>
            
            @forelse ($menus as $menu)
                <li class="mainmenu__li"><a href="#" class="mainmenu__a">{{ $menu->menu }}</a>
                    <ul>
                    @forelse ($categories as $category)
                        
                            @if ($category->menu_id == $menu->id)
                                <li><a href="/catalog/{{ $category->slug }}">{{ $category->category }}</a>
                                    <ul class="mainmenu__ul_to_right">
                                    @forelse ($categories as $category_child)
                                        @if ($category_child->parent_id == $category->id)                                            
                                            <li><a href="/catalog/{{ $category_child->slug }}">{{ $category_child->category }}</a>                                            
                                        @endif
                                    @empty                                        
                                    @endforelse
                                    </ul>   
                                </li>
                            @endif
                        
                    @empty                        
                    @endforelse
                    </ul>
                </li>
            @empty                
            @endforelse
        </ul>
    </menu>

    <!-- MENU END -->

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
