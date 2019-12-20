@extends('layouts.index')
@section('content')
    <div id="page-container">
        <div class="site-breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="{{route('catalog.index')}}">Каталог</a></li>
                    @foreach($product->categories as $category)
                        <li><a href="{{ route('catalog.index', ['category' => $category->slug ]) }}">
                                {{$category->name}}</a>
                            @endforeach</li>
                        <li><a href="">{{ $product->name }}</a></li>
                </ul>
            </div>
        </div>
        <section class="review-product-container">
            <div class="review-product-content">
                <div class="review-product-content-background-1">
                    <div class="container">
                        <div class="clearfix review-product-img-text-content">
                            <article class="col-review-product-img">
                                <div class="product-section">
                                    <div>
                                        <div class="product-section-image">
                                            <img src="{{ productImage($product->image) }}" alt="product" class="active" id="currentImage">
                                        </div>
                                        <div class="product-section-images">
                                            <div class="product-section-thumbnail selected">
                                                <img src="{{ productImage($product->image) }}" alt="product">
                                            </div>
                                            @if ($product->images)
                                                @foreach (json_decode($product->images, true) as $image)
                                                    <div class="product-section-thumbnail">
                                                        <img src="{{ productImage($image) }}" alt="product" id="123">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                            </article>
                            <article class="col-review-product-text">
                                <div>
                                    <header>
                                        <h1>Код товара: {{ $product->code }}</h1>
                                        <h2>{{ $product->name }}</h2>
                                        <p>
                                            <span>{{ priceHelper($product->price) }}</span>
                                            @if($product->old_price)
                                                <del>{{ priceHelper($product->old_price) }}</del>
                                            @endif
                                        </p>
                                    </header>
                                    <div class="review-product-add-to-cart">
                                        <div class="clearfix">
                                            <div class="review-product-add-to-cart-col-2">
                                                <form action="{{ route('cart.add', $product) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <input type="hidden" name="name"
                                                           value="{{ $product->name }}">
                                                    <input type="hidden" name="price"
                                                           value="{{ $product->price }}">
                                                    <button class="btn-action btn-action-sm btn btn-item-buy add-to-cart"
                                                            type="submit" data-quantity="1" data-id="556">
                                                        Купить
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <section>
                                        <div class="review-product-description">
                                            <header><h6>Описание товара</h6></header>
                                            <section><p> {!! $product->description !!} </p></section>
                                        </div>
                                        @if($product->coffeeAttributes)
                                            <div class="review-product-characteristics clearfix">
                                                <div class="review-product-add-info">
                                                    <header><h6>Бленд:
                                                            <span id="blend">
                                                                {{
                                                                getCoffeeMix($product->coffeeAttributes->arabica_percent,
                                                            $product->coffeeAttributes->robusta_percent,
                                                            $product->coffeeAttributes->chickpea_percent)
                                                            }}
                                                            </span>
                                                        </h6></header>
                                                </div>
                                                <div class="review-product-add-info">
                                                    <header><h6>Страна сбора: <span
                                                                class="ng-binding">{{ $product->coffeeAttributes->origin }}</span>
                                                        </h6>
                                                    </header>
                                                </div>
                                                <div
                                                    class="review-product-characteristics-col review-product-characteristics-col-1">
                                                    <header><h6>Характеристики</h6></header>
                                                    <section>
                                                        <p class="review-product-beans">
                                                            <span>ГОРЧИНКА</span>
                                                            {!! getBeans($product->coffeeAttributes->bitterness)!!}
                                                        </p>
                                                        <p class="review-product-beans">
                                                            <span>ПЛОТНОСТЬ</span>
                                                            {!! getBeans($product->coffeeAttributes->density)!!}
                                                        </p>
                                                        <p class="review-product-beans">
                                                            <span>КРЕПОСТЬ</span>
                                                            {!! getBeans($product->coffeeAttributes->strong)!!}
                                                        </p>
                                                        <p class="review-product-beans">
                                                            <span>АРОМАТ</span>
                                                            {!! getBeans($product->coffeeAttributes->aroma) !!}
                                                        </p>
                                                    </section>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="review-product-characteristics-col">
                                                    <header><h6>Назначение</h6></header>
                                                   @if(isset($product->coffeeAttributes->uses))
                                                    @foreach(json_decode($product->coffeeAttributes->uses) as $item)
                                                        <img src="{{ asset($item)  }}" class="pull-left">
                                                    @endforeach
                                                       @endif
                                                </div>
                                            </div>
                                        @endif
                                    </section>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="similar-products-container">
                    <div>
                        <div>
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
                                        <section class="products-col-price"><p>
                                                <span>{{ priceHelper($product->price) }}</span></p>
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
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        const currentImage = document.querySelector('#currentImage');
        (function(){
            const currentImage = document.querySelector('#currentImage');
            const images = document.querySelectorAll('.product-section-thumbnail');
            images.forEach((element) => element.addEventListener('click', thumbnailClick));
            function thumbnailClick(e) {
                currentImage.classList.remove('active');
                currentImage.addEventListener('transitionend', () => {
                    currentImage.src = this.querySelector('img').src;
                    currentImage.classList.add('active');
                });
                images.forEach((element) => element.classList.remove('selected'));
                this.classList.add('selected');
            }
        })();
    </script>
@endsection
