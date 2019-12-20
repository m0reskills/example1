@extends('layouts.index')

@section('content')
    <section class="products-container">
        <br/>
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="products-list-col homepage">
                    <div class="products-list-container clearfix">
                        @foreach($categories as $category)
                            <div class="products-col">
                                <div class="products-col-img">
                                    <a href="{{ route('catalog.index', ['category' => $category->slug ] )}}">
                                        <img alt="{{ $category->image_alt }}"
                                             src="{{ asset('storage/' . $category->image) }}">
                                    </a>
                                </div>
                                <section class="products-col-text"><h5>{{ $category->name }}</h5></section>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
