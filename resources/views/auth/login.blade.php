@extends('layouts.index')

@section('content')
    <div id="page-container">
        <div class="site-breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('login') }}">Вход</a></li>
                </ul>
            </div>
        </div>
        <section class="auth-container">
            <div class="container">
                <div class="auth-content inside-page-content">
                    <section class="clearfix">
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
                        <div class="auth-col auth-col-1">
                            <header><h4>Вход</h4></header>
                            <form method="post" action="{{route('login')}}">
                                @csrf
                                <input type="hidden" name="action" value="login">
                                <section>
                                    <fieldset>
                                        <div class="group-form">
                                            <label>Email:</label>
                                            <input type="text" class="form-control form-input form-validation"
                                                   name="email" value="{{ old('email') }}" required>
                                        </div>
                                        <div class="group-form">
                                            <label>Пароль:</label>
                                            <input type="password" class="form-control form-input form-validation"
                                                   name="password" required autocomplete="current-password">
                                            <div class="form-group row">
                                                <div class="col-md-6 offset-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="remember">
                                                            {{ __('Запомнить меня') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <div><a href="{{ route('password.request') }}">Забыли пароль?</a></div>
                                        @endif
                                    </fieldset>
                                </section>
                                <footer>
                                    <button type="submit" class="btn-standard btn-standard-lg btn">Вход</button>
                                </footer>
                            </form>
                        </div>
                        <div class="auth-col auth-col-2">
                            <div>
                                <header><h4>Регистрация нового пользователя</h4></header>
                                <section>
                                    <ul>
                                        <li><a href="{{ route('register') }}" class="auth-e-mail"><span><i
                                                            class="fa fa-envelope-o"></i> </span>Регистрация</a></li>
                                    </ul>
                                </section>
                                <div>
                                    <section>
                                        <ul>
                                            <li><a href="{{ route('guestCheckout') }}" class="auth-e-mail"><span><i
                                                                class="fa fa-envelope-o"></i> </span>Купить без
                                                    регистрации</a></li>
                                        </ul>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
