@extends('layouts.index')
@section('content')
    <div id="page-container">
        <div class="site-breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('cart.index') }}">Корзина</a></li>
                </ul>
            </div>
        </div>
        <section class="shopping-cart-container">
            @if($cart->count() > 0)
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
                <div class="container">
                    <div class="shopping-cart-content inside-page-content">
                        <div class="shopping-cart-products-container">
                            <table class="table table-responsive table-striped table-bordered cart">
                                <thead>
                                <th>Фото</th>
                                <th>Продукт</th>
                                <th>Количество</th>
                                <th>Цена</th>
                                <th></th>

                                </thead>
                                <tbody>

                                @foreach($cart->getContent() as $product)
                                    <tr class="cart-row-48286">

                                        <td class="text-center">
                                            <a href="{{ route('catalog.show', $product->model->slug) }}">
                                                <img src="{{ imageHelper($product->model->image) }}"
                                                     alt="" width="40px">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('catalog.show', $product->model->slug) }}">
                                                {{ $product->model->name }}
                                            </a>
                                        </td>

                                        <td>
                                            <select class="quantity" data-id="{{ $product->rowId }}">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option {{ $product->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td>
                                            <span class="text-danger">{{ priceHelper($product->model->price) }}</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.destroy', $product->rowId) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="glyphicon glyphicon-remove"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix shopping-cart-continue">
                            <div>
                                <a href="{{ route('cart.empty') }}" class="btn-basic btn-basic-md btn">Очистить
                                    корзину</a>
                            </div>
                            <div>
                                <a href="{{ route('catalog.index') }}" class="btn-basic btn-basic-md btn">Продолжить
                                    покупки</a>
                            </div>
                        </div>
                        <div class="clearfix shopping-cart-sum-container">
                            <article class="shopping-cart-sum-col shopping-cart-voucher">
                                <div>
                                    @if($discount)
                                        <header>
                                            <h6>Код на скидку</h6>
                                        </header>
                                        <section>
                                            <div class="voucher-input-container">
                                                <form action="{{ route('coupon.destroy')}}" method="post"
                                                      style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-default btn-xs" type="submit">
                                                        <span class="glyphicon glyphicon-remove">Удалить</span>
                                                    </button>
                                                </form>
                                                <h4>Купон {{ session()->get('coupon')['code'] }} активен</h4>
                                            </div>
                                        </section>
                                    @else
                                        <header>
                                            <h6>Код на скидку</h6>
                                        </header>
                                        <section>
                                            <div class="voucher-input-container">
                                                <form action="{{ route('coupon.store') }}" method="post">
                                                    @csrf
                                                    <label for="coupon"> Введите код купона</label>
                                                    <input type="text" class="form-control voucher-input" name="coupon"
                                                           id="coupon">
                                                    <button type="submit" class="voucher">Добавить</button>
                                                </form>
                                            </div>
                                        </section>
                                    @endif
                                </div>
                            </article>
                            <article class="shopping-cart-sum-col shopping-cart-sum">
                                <div>
                                    @if($discount)
                                        <header>
                                            <p>
                                                <span>Скидка:</span>
                                                <span>{{ priceHelper($discount) }}</span>

                                            </p>
                                        </header>
                                    @endif
                                    <hr>

                                    @if($discount)
                                        <section>
                                            <p>
                                                <span>Итого:</span>
                                                <span>{{ priceHelper($total)}}</span>
                                            </p>
                                        </section>
                                    @else
                                        <section>
                                            <p>
                                                <span>Итого:</span>
                                                <span>{{ priceHelper($cart->total()) }}</span>
                                            </p>
                                        </section>
                                    @endif
                                </div>
                            </article>
                        </div>
                        <div class="clearfix shopping-cart-btn-container">
                            <a href="{{ route('checkout') }}" class="btn-action btn-action-lg btn">Оформить заказ</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="profile-orders-content">
                    <div class="profile-empty-orders">
                        <header><p>Ваша корзина пуста</p></header>
                        <section><i class="fa fa-history"></i></section>
                        <footer><a class="btn-action btn-action-md btn" href="/">К покупкам</a></footer>
                    </div>
                </div>
            @endif
            @if($wishList->getContent()->count() > 0)
                <div class="similar-products-container">
                    <div>
                        <div>
                            <div class="combine-product-text" id="wish-list"><a>Список желаний</a></div>
                            <div class="products-list-container clearfix">
                                @foreach($wishList->getContent() as $product)
                                    <div class="products-col">
                                        <div class="products-col-img">
                                            <a href="{{route('catalog.show', $product->model->slug )}}">
                                                <img alt="" src="{{ imageHelper($product->model->image) }}">
                                            </a>
                                            <form action="{{route('wishList.switchToCart', $product->id )}}"
                                                  method="post">
                                                @csrf
                                                <button type="submit" title="Добавить в корзину"
                                                        class="product-col-buy add-to-cart"><i></i></button>
                                            </form>
                                        </div>
                                        <section class="products-col-text"><h5>{{ $product->model->name }}</h5>
                                        </section>
                                        <section class="products-col-price"><p>
                                                <span>{{ priceHelper($product->model->price) }}</span>
                                            </p>
                                        </section>

                                        <footer class="products-col-button"><a class="products-col-button-preview"
                                                                               href="{{ route('catalog.show', $product->model->slug )}}">Подробнее</a>

                                            <form action="{{route('wishList.destroy', $product->rowId )}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Удалить"
                                                        class="glyphicon glyphicon-remove"><i></i></button>
                                            </form>
                                        </footer>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function f() {
            const classname = document.querySelectorAll('.quantity');
            Array.from(classname).forEach(function (element) {
                element.addEventListener('change', function () {
                    const id = element.getAttribute('data-id');
                    axios.patch(`/cart/${id}`, {
                        id: id,
                        quantity: this.value,
                    })
                        .then(response => {
                            window.location.href = '{{ route('cart.index') }}'
                        })
                        .catch(error => {
                            window.location.href = '{{ route('cart.index') }}'
                            console.log(error);
                        });
                })
            })
        })();
    </script>
    <script>
        $(function () {

            $(".heart-cart").on("click", function () {
                $(this).toggleClass("heart-blast");
            });
        });

    </script>
@endsection
