@extends('dashboard.sidebar')

@section('dashboard')

    <div class="profile-content-col ng-scope">

        <div class="profile-background-container"
             style="background-image: url('{{ asset('images/dashboard/1AK.jpg') }}');">

            <h2>История ваших заказов</h2>

        </div>

        <div class="profile-content">

            <div class="profile-orders-content">

                @if($orders->count() == 0)
                    <div class="profile-empty-orders">

                        <header><p>Ваш список заказов пуст</p></header>

                        <section><i class="fa fa-history"></i></section>

                        <footer><a class="btn-action btn-action-md btn" href="/">К покупкам</a></footer>

                    </div>
                @else
                    <div class="profile-content">

                        <div class="profile-orders-content">
                            @foreach($orders as $order)
                                <article>
                                    <div class="orders-profile-row-1">

                                        <div class="clearfix">

                                            <div class="orders-profile-col orders-profile-col-1">
                                                <p><span>Номер заказа:</span> {{ $order->id }}
                                                    <span>Дата:</span> {{ $order->created_at }}</p>
                                                <p><span>Статус заказа:</span>{{ $order->status }}</p>
                                            </div>
                                            <div class="orders-profile-col orders-profile-col-2">
                                                <p><span>Сумма:</span> {{ priceHelper($order->cart_total) }}</p>
                                            </div>
                                        </div>
                                        <a data-toggle="collapse" data-target="#{{$order->id}}"
                                           href="javascript:void(0)" class="collapsed"><span class="glyphicon glyphicon-menu-down" ></span> </a>

                                    </div>
                                    <div id="{{$order->id}}" class="orders-profile-row-2 collapse">

                                        <header class="clearfix">

                                            <p class="orders-profile-product-col orders-profile-col-product">Продукт</p>
                                            <p class="orders-profile-product-col orders-profile-col-unit-price">Цена</p>
                                            <p class="orders-profile-product-col orders-profile-col-quantity">
                                                Количество</p>

                                        </header>


                                        @foreach($order->products as $product)
                                            <section class="clearfix">

                                                <div class="orders-profile-product-col orders-profile-col-product">

                                                    <a href=""><img
                                                                src="{{ imageHelper($product->image) }}"
                                                                class="img-responsive"></a>

                                                    <div>

                                                        <h1>{{ $product->code }}</h1>
                                                        <h2>{{ $product->name }}</h2>

                                                    </div>

                                                </div>

                                                <div class="orders-profile-product-col orders-profile-col-unit-price">

                                                    <p>{{ priceHelper($product->price) }}</p>

                                                </div>

                                                <div class="orders-profile-product-col orders-profile-col-quantity">

                                                    <p>{{ $product->pivot->quantity }}</p>

                                                </div>

                                            </section>
                                        @endforeach


                                    </div>
                                </article>
                            @endforeach


                        </div>

                    </div>


                @endif


            </div>

        </div>

    </div>
@endsection

