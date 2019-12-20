@extends('layouts.index')
@section('content')
    <div id="page-container">
        <div class="site-breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('cart.index') }}">Корзина</a></li>
                    <li><a href="{{ route('checkout')}}">Оформление заказа</a></li>
                </ul>
            </div>
        </div>
        <section class="order-container">
            <div class="container">
                <div class="cart-section container">
                    <div>
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="order-content">
                    <div id="order-tab-mobile"></div>
                    <div class="order-tab-content">
                        <div class="order-tab-2">
                            <header><h6>Оформление заказа</h6></header>
                            <section>
                                <form method="post" action="{{ route('checkout.store') }}" data-toggle="validator">
                                    @csrf
                                    <input type="hidden" name="action" value="checkout">
                                    <fieldset>
                                        <div class="form-group">
                                            @if(auth()->user())
                                                <label class="control-label">Имя</label><input type="text" required
                                                                                               class="form-control form-input"
                                                                                               value="{{ auth()->user()->name }}"
                                                                                               name="name" readonly>
                                            @else
                                                <label class="control-label">Имя</label><input type="text" required
                                                                                               class="form-control form-input"
                                                                                               value="" name="name">
                                            @endif
                                        </div>
                                        <div class="clearfix">
                                            <div class="form-group group-form-50">
                                                <label class="control-label">Город</label><input type="text" required
                                                                                                 class="form-control form-input"
                                                                                                 name="city">
                                            </div>
                                            <div class="form-group group-form-50">
                                                <label class="control-label">Почтовый индекс</label><input type="text"
                                                                                                           required
                                                                                                           class="form-control form-input"
                                                                                                           name="postcode">
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label class="control-label">Адрес</label><input type="text" required
                                                                                             class="form-control form-input"
                                                                                             name="address">

                                        </div>

                                        <div class="clearfix">

                                            <div class="form-group group-form-50">

                                                <label class="control-label">Телефон</label><input type="text" required
                                                                                                   class="form-control form-input"
                                                                                                   value="{{ old('phone') }}"
                                                                                                   name="phone">

                                            </div>

                                            <div class="form-group group-form-50">
                                                @if(auth()->user())
                                                    <label class="control-label">E-mail</label><input type="email"
                                                                                                      required
                                                                                                      class="form-control form-input"
                                                                                                      value="{{ auth()->user()->email }}"
                                                                                                      name="email" readonly>
                                                @else
                                                    <label class="control-label">E-mail</label><input type="email"
                                                                                                      required
                                                                                                      class="form-control form-input"
                                                                                                      value="{{ old('email') }}"
                                                                                                      name="email"
                                                                                                      required>
                                                @endif
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <label class="control-label">Доставка</label>
                                                <select class="form-control form-input form-validation" name="delivery">

                                                    <option value="0">Самовывоз(г. Москва, пр-д Серебрякова, д. 2, корп. 1)</option>
                                                    <option value="1">Доставка DPD</option>
                                                </select>
                                            </div>
                                    </fieldset>
                                    <div class="clearfix order-btn-container">
                                        <button class="btn-action btn-action-lg btn" type="submit">Оформить заказ
                                        </button>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

