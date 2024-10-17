@extends('frontend.layout.app')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="text-center col-lg-8 offset-lg-2">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="{{ request()->is('shop/all') ? 'active' : '' }}"
                                data-filter="{{ request()->is('shop/all') ? '*' : '' }}">All</li>
                            @php
                                $categories = App\Models\Category::where('status', 1)->get();
                                $products = App\Models\Product::where('status', 1)->orderBy('order')->get();
                            @endphp
                            @if ($categories)
                                @foreach ($categories as $category)
                                    <li data-filter=".{{ $category->slug }}"
                                        class="{{ request()->is('shop/' . $category->slug) ? 'active' : '' }}">
                                        {{ $category->name }}
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            @if ($products)
                <div class="row product-lists">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 text-center {{ $product->category->slug }}">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <a href="{{ route('product', $product->slug) }}"><img
                                            src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->slug }}"
                                            width="200" height="250"></a>
                                </div>
                                <h3>{{ $product->name }}</h3>
                                <p class="product-price"><span></span> ${{ $product->price }} </p>
                                <a href="cart.html" class="cart-btn add-to-cart" data-slug="{{ $product->slug }}"><i
                                        class="fas fa-shopping-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- <div class="row">
                <div class="text-center col-lg-12">
                    <div class="pagination-wrap">
                        <ul>
                            <li><a href="#">Prev</a></li>
                            <li><a href="#">1</a></li>
                            <li><a class="active" href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- end products -->
@endsection
