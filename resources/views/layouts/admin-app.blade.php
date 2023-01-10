<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>АДМИН - {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @section('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="https://use.fontawesome.com/564e0d687f.js"></script>
    
    @show

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Cuprum:400,400i,700&display=swap&subset=cyrillic-ext" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

    <!-- UIkit CSS -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/[uikit-version]/css/uikit.min.css" /> --}}
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.9.4/css/uikit.min.css" integrity="sha512-Je1wwJz37N237FpJ3eJXkzVW2ek9331ygz5JdzfbmkmbMIObSC7K3UelTVpcVNRgzJRxoh40NhRDqNNuMfEVuA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- UIkit JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.4.2/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.4.2/js/uikit-icons.min.js"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.9.4/js/uikit.min.js" integrity="sha512-HrOabH0q8HnOwCVtR2lvwgRYoHtI0V2zC0ii6Kt0xfKDWhvNrTM3TqQv4EIYjt5NlyowqHhjBJ2gheJ/BfoPnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.9.4/js/uikit-core.min.js" integrity="sha512-IeT1HldAqb15q2QiOY0bIajZA0DgR7q0TLoHgVAPs6hFB+d/7c9ufgJLnrivBOTJTaK7Wgs4jLzOITVRLpY3Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.9.4/js/uikit-icons.min.js" integrity="sha512-ZN3+/fQI4kCvbrvd9em65IXBx8PtRcc+RsVgZIBIyEoO0CbXcUOL8sLLxQsmytTwg6Jm91fnDS6Xkaw48zB8Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.9.4/js/components/tooltip.min.js" integrity="sha512-4z1VFBn80lqZMDa+AIBssIYO8pJmQXN0/kAK3QepM3xzabL/plWHr2LMX3ly8Ub231nXDHXeVaQNhsV52sp4zg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</head>
<body>
    <div id="app">
        <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
            <nav class="uk-navbar-container" uk-navbar>
                <div class="uk-navbar-left">
                    <ul class="uk-navbar-nav">
                        <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.index') }}" data-toggle="tooltip" data-placement="top" title="Основные настройки сайта"><i class="fas fa-sliders-h"></i><span class="sr-only">(current)</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-store-alt"></i> Магазин</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li><a class="dropdown-item {{ (Request::is('*products*') ? 'active' : '') }}" href="{{ route('admin.products.index') }}"><i class="fas fa-archive"></i> товары</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*importexport*') ? 'active' : '') }}" href="{{ route('admin.import-export.index') }}"><i class="fas fa-file-excel"></i> импорт/экспорт</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*categories*') ? 'active' : '') }}" href="{{ route('admin.categories.index') }}"><i class="fas fa-folder"></i> категории</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*manufactures*') ? 'active' : '') }}" href="{{ route('admin.manufactures.index') }}"><i class="fas fa-industry"></i> производители</a></li>
                                    <hr>
                                    <li><a class="dropdown-item {{ (Request::is('*delivery*') ? 'active' : '') }}" href="{{ route('admin.deliverycategories.index') }}"><i class="fas fa-truck"></i> Доставки</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*vendors*') ? 'active' : '') }}" href="{{ route('admin.vendors.index') }}"><i class="fas fa-store-alt"></i>  Поставщики</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*sets*') ? 'active' : '') }}" href="{{ route('admin.sets.index') }}"><i class="fas fa-tasks"></i> Группы товаров</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*options*') ? 'active' : '') }}" href="{{ route('admin.options.index') }}">Опции товаров</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*units*') ? 'active' : '') }}" href="{{ route('admin.units.index') }}"><i class="fas fa-tape"></i>  Ед. измерения</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*currencies*') ? 'active' : '') }}" href="{{ route('admin.currencies.index') }}"><i class="fas fa-money-bill-alt"></i> валюты</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*menus*') ? 'active' : '') }}" href="{{ route('admin.menus.index') }}"><i class="fas fa-bars"></i> пункты меню</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-tags"></i> Продвижение</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li><a class="dropdown-item {{ (Request::is('*discounts*') ? 'active' : '') }}" href="{{ route('admin.discounts.index') }}"><i class="fas fa-percentage"></i>  Акции</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*articles*') ? 'active' : '') }}" href="{{ route('admin.articles.index') }}"><i class="fas fa-newspaper"></i>  Статьи</a></li>
                                    <li><a class="dropdown-item {{ (Request::is('*questions*') ? 'active' : '') }}" href="{{ route('admin.questions.index') }}"><i class="fas fa-question"></i>  FAQ</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-images"></i>  Баннеры</a></li>
                                    <hr>
                                    <li><a class="dropdown-item {{ (Request::is('*parser*') ? 'active' : '') }}" href="{{ route('admin.parser') }}"><i class="fas fa-images"></i>  Парсер</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-archive"></i>  Покупатели и заказы</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-friends"></i>  Покупатели</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-map-marked-alt"></i>  Адреса покупателей</a></li>
                                    <hr>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-check"></i>  Статусы заказов</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-shopping-basket"></i>  Заказы</a></li>
                                    <li><a class="dropdown-item rounded text-white bg-danger" href="#"><i class="fas fa-fire"></i>  Заказы к исполнению</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-boxes"></i>  Архив заказов</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-file-alt"></i> Статические страницы</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li><a class="dropdown-item {{ (Request::is('*topmenu*') ? 'active' : '') }}" href="{{ route('admin.topmenu.index') }}">Верхнее меню</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-toolbox"></i></a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li><a class="dropdown-item {{ (Request::is('*block_ip*') ? 'active' : '') }}" href="{{ route('admin.blockip.index') }}"><i class="fas fa-shield-alt"></i> Блок по IP</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="uk-navbar-center">
                    <ul class="uk-navbar-nav">
                        <li class="currency__today">
                            <a href="#">
                                <div> Сегодня: 
                                    @foreach ($cbrToday as $key=>$value)
                                        <span class="currency__child"> 
                                            <i class="fa fa-{{strtolower($value->currency->currency) ?? ''}}" aria-hidden="true"></i>
                                            <span class="currency__value">{{ $value->value ?? '-' }}</span>
                                            {{-- <span                    
                                            @if($value->value != -1)
                                                @if(count($cbrTomorrow))
                                                    @if($value->value < $cbrTomorrow[$key]->value)
                                                        class="currency__red" 
                                                    @elseif($value->value > $cbrTomorrow[$key]->value)
                                                        class="currency__green"  
                                                    @else                       
                                                        class="currency__grey"                        
                                                    @endif
                                                @endif                                   
                                            @else                       
                                                class="currency__grey"                       
                                            @endif>
                                            </span> --}}
                                        </span>
                                    @endforeach
                                    @if(count($cbrTomorrow))
                                        <div class="currency__tomorrow uk-navbar-subtitle">
                                                Завтра:
                                                @foreach ($cbrTomorrow as $value)
                                                <span>
                                                    <i class="fa fa-{{strtolower($value->currency->currency) ?? ''}}" aria-hidden="true"></i>
                                                    <span class="currency__value">{{ $value->value ?? '-' }}</span>
                                                </span>    
                                                @endforeach
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav">
                        <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/') }}" target="_blank"><i class="fas fa-link"></i>  На сайт</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-user-shield"></i>  {{ Auth::user()->name }} <span class="caret"></span></a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li>
                                        <a class="dropdown-item" href="@if (Auth::guard('admin')->check()) {{ route('admin.logout') }} @else {{ route('logout') }} @endif"
                                            onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                             <i class="fas fa-sign-out-alt"></i>  {{ __('Выйти') }}
                                         </a>
     
                                         <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                             @csrf
                                         </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        
        {{-- <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.index') }}" data-toggle="tooltip" data-placement="top" title="Основные настройки сайта"><i class="fas fa-sliders-h"></i><span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ route('admin.categories.index') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-store-alt"></i> Магазин
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ (Request::is('*products*') ? 'active' : '') }}" href="{{ route('admin.products.index') }}"><i class="fas fa-archive"></i> товары</a>
                                <a class="dropdown-item {{ (Request::is('*importexport*') ? 'active' : '') }}" href="{{ route('admin.import-export.index') }}"><i class="fas fa-file-excel"></i> импорт/экспорт</a>
                                <a class="dropdown-item {{ (Request::is('categories*') ? 'active' : '') }}" href="{{ route('admin.categories.index') }}"><i class="fas fa-folder"></i> категории</a>
                                <a class="dropdown-item {{ (Request::is('*manufactures*') ? 'active' : '') }}" href="{{ route('admin.manufactures.index') }}"><i class="fas fa-industry"></i> производители</a>
                                <hr>
                                <a class="dropdown-item {{ (Request::is('*delivery*') ? 'active' : '') }}" href="{{ route('admin.deliverycategories.index') }}"><i class="fas fa-truck"></i> Доставки</a>
                                <a class="dropdown-item {{ (Request::is('*vendors*') ? 'active' : '') }}" href="{{ route('admin.vendors.index') }}"><i class="fas fa-store-alt"></i>  Поставщики</a>
                                <a class="dropdown-item {{ (Request::is('*sets*') ? 'active' : '') }}" href="{{ route('admin.sets.index') }}"><i class="fas fa-tasks"></i> Группы товаров</a>
                                <a class="dropdown-item {{ (Request::is('*options*') ? 'active' : '') }}" href="{{ route('admin.options.index') }}">Опции товаров</a>
                                <a class="dropdown-item {{ (Request::is('*units*') ? 'active' : '') }}" href="{{ route('admin.units.index') }}"><i class="fas fa-tape"></i>  Ед. измерения</a>
                                <a class="dropdown-item {{ (Request::is('*currencies*') ? 'active' : '') }}" href="{{ route('admin.currencies.index') }}"><i class="fas fa-money-bill-alt"></i> валюты</a>
                                <a class="dropdown-item {{ (Request::is('*menus*') ? 'active' : '') }}" href="{{ route('admin.menus.index') }}"><i class="fas fa-bars"></i> пункты меню</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ route('admin.categories.index') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-tags"></i> Продвижение
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ (Request::is('*discounts*') ? 'active' : '') }}" href="{{ route('admin.discounts.index') }}"><i class="fas fa-percentage"></i>  Акции</a>
                                <a class="dropdown-item {{ (Request::is('*articles*') ? 'active' : '') }}" href="{{ route('admin.articles.index') }}"><i class="fas fa-newspaper"></i>  Статьи</a>
                                <a class="dropdown-item {{ (Request::is('*questions*') ? 'active' : '') }}" href="{{ route('admin.questions.index') }}"><i class="fas fa-question"></i>  FAQ</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-images"></i>  Баннеры</a>
                                <hr>
                                <a class="dropdown-item {{ (Request::is('*parser*') ? 'active' : '') }}" href="{{ route('admin.parser') }}"><i class="fas fa-images"></i>  Парсер</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle rounded text-dark bg-info" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-archive"></i>  Покупатели и заказы
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"><i class="fas fa-user-friends"></i>  Покупатели</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-map-marked-alt"></i>  Адреса покупателей</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fas fa-check"></i>  Статусы заказов</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-shopping-basket"></i>  Заказы</a>
                                <a class="dropdown-item rounded text-white bg-danger" href="#"><i class="fas fa-fire"></i>  Заказы к исполнению</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-boxes"></i>  Архив заказов</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-file-alt"></i> Статические страницы
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ (Request::is('*topmenu*') ? 'active' : '') }}" href="{{ route('admin.topmenu.index') }}">Верхнее меню</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-toolbox"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ (Request::is('*block_ip*') ? 'active' : '') }}" href="{{ route('admin.blockip.index') }}"><i class="fas fa-shield-alt"></i> Блок по IP</a>
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <ul class="currency">
                                <li class="currency__today nav-item">
                                    Сегодня                    
                                    @foreach ($cbrToday as $key=>$value)
                                    <span class="currency__child"> 
                                        <i class="fa fa-{{strtolower($value->currency->currency) ?? ''}}" aria-hidden="true"></i>
                                        <span class="currency__value">{{ $value->value ?? '-' }}</span>
                                        <span                    
                                        @if($value->value != -1)
                                            @if(count($cbrTomorrow))
                                                @if($value->value < $cbrTomorrow[$key]->value)
                                                    class="currency__red" 
                                                @elseif($value->value > $cbrTomorrow[$key]->value)
                                                    class="currency__green"  
                                                @else                       
                                                    class="currency__grey"                        
                                                @endif
                                            @endif                                   
                                        @else                       
                                            class="currency__grey"                       
                                        @endif>
                                        </span>
                                    </span>
                                    @endforeach   
                                </li>
                                @if(count($cbrTomorrow))
                                <div class="currency__tomorrow submenu">
                                        Завтра
                                        @foreach ($cbrTomorrow as $value)
                                        <span>
                                            <i class="fa fa-{{strtolower($value->currency->currency) ?? ''}}" aria-hidden="true"></i>
                                            <span class="currency__value">{{ $value->value ?? '-' }}</span>
                                        </span>    
                                        @endforeach
                                </div>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-link"></i>  На сайт</a>
                        </li>
                        
                        <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fas fa-user-shield"></i>  {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="@if (Auth::guard('admin')->check()) {{ route('admin.logout') }} @else {{ route('logout') }} @endif"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>  {{ __('Выйти') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        
                    </ul>
                </div>
            </div>
        </nav> --}}

        <main class="py-4">
            @section('adminmenu')
                
                
            @show
            @yield('content')
        </main>
    </div>
    <messeges>
        <div uk-alert class="uk-alert-primary"><p></p></div>
        <div uk-alert class="uk-alert-success"><p></p></div>
        <div uk-alert class="uk-alert-warning"><p></p></div>
        <div uk-alert class="uk-alert-danger"><p></p></div>
    </messeges>
</body>
</html>
