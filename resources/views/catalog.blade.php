@extends('layouts.index')
@section('content')
    <div id="page-container">

        <div class="site-breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="{{ route('catalog.index') }}">Каталог</a></li>
                    <li><a href="">{{ isset($meta->title ) ? $meta->title : ''}}</a></li>
                </ul>
            </div>
        </div>
        <section class="products-container">
            <div class="sort-container">
                <div class="container">
                    <div class="sort-content clearfix">
                        <div class="clearfix">
                            <div>
                                <strong>Фильтр: </strong>
                                <a href="{{ route('catalog.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">Цена
                                    min</a> |
                                <a href="{{ route('catalog.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">Цена
                                    max</a>
                            </div>
                            <div class="dropdown-container">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="clearfix">
                    <aside class="site-aside-col site-aside-navigation">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="collapse navbar-collapse clearfix">
                                    <div class="vertmenu">
                                        <ul>
                                            @foreach($categories as $category)
                                                <li>
                                                    <a href="{{ route('catalog.index', ['category' => $category->slug ] ).'#main'}}">{{ $category->name }}</a>
                                                    @foreach($category->children as $subCategory)
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('catalog.index', ['category' => $subCategory->slug ] ).'#main'}}"
                                                                   class="{{ request()->get('category') == $subCategory->slug ? 'active' : '' }}">{{ $subCategory->name }} </a>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </aside>
                    <div class="products-list-col" id="main">
                        <h3>{{ isset($meta->title ) ? $meta->title : setting('site.title')}}</h3>
                        <div class="products-list-container clearfix">
                            @forelse( $products as $product)
                                <div class="products-col">
                                    <div class="products-col-img">
                                        <a href="{{route('catalog.show', $product->slug )}}">
                                            <img alt="" src="{{ imageHelper($product->image) }}">
                                        </a>
                                        <form action="{{route('cart.add', $product)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <button type="submit" title="Добавить в корзину"
                                                    class="product-col-buy add-to-cart"
                                                    data-quantity="1" data-id=""><i></i></button>
                                        </form>
                                    </div>
                                    @if($wishList->hasHeart($product->id))
                                        <form action="{{ route('wishList.destroy', $wishList->getRowId($product->id)) }}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="heart-full"></button>
                                        </form>
                                    @else
                                        <form action="{{ route('addToWishList', $product->id) }}"
                                              method="post">
                                            @csrf
                                            <button type="submit" class="heart"></button>
                                        </form>
                                    @endif
                                    <section class="products-col-text"><h5>{{ $product->name }}</h5></section>
                                    <section class="products-col-price">
                                        <p>
                                            <span>{{ priceHelper($product->price) }}</span>
                                            @if($product->old_price)
                                                <del>{{ priceHelper($product->old_price) }}</del>
                                            @endif
                                        </p>
                                    </section>
                                    <footer class="products-col-button">

                                        <a class="products-col-button-preview"
                                           href="{{route('catalog.show', $product->slug )}}">Подробнее</a>
                                    </footer>

                                </div>
                            @empty
                                <h2>Нет продуктов</h2>
                            @endforelse
                        </div>
                        <div class="pagination">
                            {{ $products->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(function() {

            $(".heart").on("click", function() {
                $(this).toggleClass("heart-blast");
            });
        });

    </script>
    <script>
        $(function() {

            $(".heart-full").on("click", function() {
                $(this).toggleClass("heart-reverse");
            });
        });
    </script>
@endsection

