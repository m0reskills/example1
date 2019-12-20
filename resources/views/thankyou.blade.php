@extends('layouts.index')
@section('content')
    <div id="page-container" class="view-container">
        <section class="about-us-container">
            <div class="container">
                <div class="about-us-content">
                    <div class="thank-you-section">
                        <h1>Спасибо за <br> Ваш заказ!</h1>
                        <h3>Письмо с деталями заказа отправлено на вашу почту</h3>
                        <footer><a ui-sref="home" class="btn-action btn-action-md btn" href="{{ route('home') }}">На главную страницу</a>
                        </footer>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection