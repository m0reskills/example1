<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($meta->title ) ? $meta->title : setting('site.title') }}</title>
    <meta name="description"
          content="{{ isset($meta->description) ? $meta->description : setting('site.description') }}">
    <meta name="keywords"
          content="{{ isset($meta->keywords) ? $meta->keywords : setting('site.keywords') }}">
    <meta property="og:url" content="https://spetema.ru"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image:alt" content="spetema.ru">
    <meta name="yandex-verification" content="a124b5ce673a726a" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=541d6e72-b7fa-416c-907a-7329d8ad5b22&lang=ru_RU" type="text/javascript">
    </script>
</head>
<body>
<div class="wrapper">
    <header class="site-header">
        <div class="container">
            <div class="site-header-content">
                <div class="clearfix">
                    <div class="header-col-logo">
                        <div class="logo-container">
                            <h1><a href="/"><img alt="spetema.ru" src="{{ asset('images/logo-desktop.png') }}"></a></h1>
                        </div>
                    </div>
                    <div class="header-col-add-info">
                        <ul class="clearfix">
                            <li class="header-col-add-info-1">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_2">
                                    <div class="header-col-add-info-img"></div>
                                    <div class="header-col-add-info-text">
                                        <p>+7-925-523-1159  Пн - Сб с 9.00 до 20.00</p>
                                    </div>
                                </a>
                            </li>
                            <li class="header-col-add-info-2">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_1">
                                    <div class="header-col-add-info-img"></div>
                                    <div class="header-col-add-info-text">
                                        <p>Бесплатная доставка при сумме заказа более 3500 руб.</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="site-navigation">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="clearfix">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#siteNavigation" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="logo-mobile">
                                <a href="/"><img src="{{ asset('images/logo-mobile.png') }}" alt="spetema.ru"></a>
                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse clearfix" id="siteNavigation">
                        <ul class="nav navbar-nav nav-categories-length-7">
                            <li class="dropdown submenu-coffee"><a href="{{route('home')}}"><span>Главная</span></a>
                            </li>
                            <li class="dropdown submenu-coffee"><a
                                        href="{{ route('catalog.index') }}"><span>Каталог</span></a></li>
                            <li class="dropdown submenu-coffee"><a href="{{ route('catalog.index', ['category' => 'akcii']) }}"><span>Акции</span></a>
                            </li>
                            <li class="dropdown submenu-coffee"><a href="javascript:void(0)" data-toggle="modal" data-target="#modal_3"><span>Контакты</span></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="cart-login-search-content">
                <div>
                    <div class="clearfix">
                        <div class="small-login-col">
                            <div class="small-login-container">
                                <div class="small-login-content small-login-icon">
                                    <div style="background-image: url('{{ asset('images/user-icon.svg') }}')">
                                        <div class="small-login-container-box">
                                            <div class="small-login-container-logout">
                                                @guest
                                                    <div class="small-login-container-box-btn">
                                                        <a class="btn-action btn-action-lg btn"
                                                           href="{{ route('login') }}">Регистрация / Вход</a>
                                                    </div>
                                                @else
                                                    <div class="small-login-container-box-btn">
                                                        <span>Привет, {{ auth()->user()->name }}</span>
                                                        <a class="btn-action btn-action-lg btn"
                                                           href="{{ route('users.edit') }}">Личный кабинет</a>
                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                            {{ __('Выйти') }}
                                                        </a>
                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                              method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="small-cart-col">
                            <a href="{{route('cart.index')}}">
                                <div class="small-cart-container">
                                    <div class="small-cart-content">
                                        <div>
                                            @if (cartCount() == 0)
                                                <div class="small-cart-container-box">
                                                    <div class="small-cart-container-box-empty"><p>Ваша корзина
                                                            пуста</p></div>
                                                </div>
                                            @else
                                            <span id="productsCount">{{ cartCount() }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

