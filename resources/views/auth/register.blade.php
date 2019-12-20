@extends('layouts.index')

@section('content')
    <div id="page-container">
        <div class="site-breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('register') }}">Регистрация</a></li>
                </ul>
            </div>
        </div>
        <section class="auth-container">
            <div class="container">
                <div class="auth-content inside-page-content">
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
                    <div class="col-md-12">
                        <section class="clearfix">
                            <div class="auth-col auth-col-1">
                                <header><h4>Регистрация нового пользователя</h4></header>
                                <form name="myProfileForm" method="post" action="{{ route('register') }}">
                                    @csrf
                                    <fieldset>
                                        <div class="group-form">

                                            <label><span class="text-danger">*</span> Имя:</label>
                                            <input type="text" class="form-control form-input form-validation"
                                                   name="name" value="{{ old('name') }}" required autocomplete="name"
                                                   autofocus>
                                        </div>
                                        <div class="group-form">
                                            <label><span class="text-danger">*</span> Email:</label>
                                            <input type="text" class="form-control form-input form-validation"
                                                   name="email" value="{{ old('email') }}" required
                                                   autocomplete="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="group-form">

                                            <label><span class="text-danger">*</span> Пароль:</label>
                                            <input type="password" class="form-control form-input form-validation"
                                                   name="password" required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <div class="group-form">

                                            <label><span class="text-danger">*</span> Повторить пароль:</label>
                                            <input type="password" class="form-control form-input form-validation"
                                                   name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </fieldset>
                                    <div class="profile-content-btn clearfix">
                                        <button type="submit" class="btn-standard btn-standard-md btn">Регистрация
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
