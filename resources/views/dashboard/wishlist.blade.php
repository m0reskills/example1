@extends('dashboard.sidebar')
@section('dashboard')
    <div class="profile-content-col ng-scope ng-isolate-scope" style="display: block;">
        @if($wishList->count() > 0)
            <div class="similar-products-container">
                <div>
                    <div>
                        <div class="combine-product-text"><a>Список желаний</a></div>
                        <div class="products-list-container clearfix">
                            @foreach($wishList->getContent() as $product)
                                <div class="products-col">
                                    <div class="products-col-img">
                                        <img alt="{{ $product->model->image_alt }}" src="{{ imageHelper($product->model->image) }}">
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
                                    <a href="">Добавить в корзину</a>
                                    <section class="products-col-price"><p><span>{{ priceHelper($product->model->price) }}</span>
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
        @else
            <div class="profile-content">
            <div class="profile-orders-content">
            <div class="profile-empty-orders">
                <header><p>Ваш список желаний пуст</p></header>
                <section><i class="fa fa-history"></i></section>
                <footer><a class="btn-action btn-action-md btn" href="{{route('catalog.index')}}">К выбору</a></footer>
                <div class="combine-product-text"><a>Вам так же могут понравится</a></div>
                <div class="products-list-container clearfix">
                    @foreach($mayAlsoLike as $product)
                        <div class="products-col">
                            <div class="products-col-img">
                                <a href="{{route('catalog.show', $product->slug )}}"><img
                                            alt="{{ $product->image_alt }}"
                                            src="{{ imageHelper($product->image) }}"></a>
                            </div>
                            <section class="products-col-text"><h5>{{ $product->name }}</h5></section>
                            <section class="products-col-price"><p><span>{{ priceHelper($product->price) }}</span></p>
                            </section>
                            <footer class="products-col-button"><a class="products-col-button-preview"
                                                                   href="{{route('catalog.show', $product->slug )}}">Подробнее</a>
                            </footer>
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
            </div>
        @endif
    </div>
@endsection

