@extends('frontend.layout.app')
@section('content')
    <!-- home page slider -->
    @php
        $sliders = App\Models\Slider::where(['footer' => 0, 'status' => 1])
            ->orderBy('order')
            ->get();
        $footer_banner = App\Models\Slider::where(['footer' => 1, 'status' => 1])
            ->orderBy('order')
            ->first();
        $classes = [
            'col-lg-10 offset-lg-1 text-center',
            'col-lg-10 offset-lg-1 text-right',
            'col-md-12 col-lg-7 offset-lg-1 offset-xl-0',
        ];
    @endphp

    <!-- home page slider -->
    <div class="homepage-slider">
        @foreach ($sliders as $slider)
            @php
                $randomClass = $classes[array_rand($classes)];
            @endphp
            <div class="single-homepage-slider" style="background-image: url('{{ asset('storage/' . $slider->image) }}')">
                <div class="container">
                    <div class="row">
                        <div class="{{ $randomClass }}">
                            <div class="hero-text">
                                <div class="hero-text-tablecell">
                                    <p class="subtitle">{{ $slider->sub_title }}</p>
                                    <h1>{{ $slider->title }}</h1>
                                    <div class="hero-btns">
                                        <a href="shop.html" class="boxed-btn">Fruit Collection</a>
                                        <a href="contact.html" class="bordered-btn">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- end home page slider -->

    <!-- features list section -->
    <div class="list-section pt-80 pb-80">
        <div class="container">

            <div class="row">
                <div class="mb-4 col-lg-4 col-md-6 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="content">
                            <h3>Free Shipping</h3>
                            <p>When order over $75</p>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-lg-4 col-md-6 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <div class="content">
                            <h3>24/7 Support</h3>
                            <p>Get support all day</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="list-box d-flex justify-content-start align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-sync"></i>
                        </div>
                        <div class="content">
                            <h3>Refund</h3>
                            <p>Get refund within 3 days!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end features list section -->

    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="text-center col-lg-8 offset-lg-2">
                    <div class="section-title">
                        <a href="{{ route('shop', 'all') }}">
                            <h3><span class="orange-text">Our</span> Products</h3>
                        </a>
                    </div>
                </div>
            </div>

            @php
                $products = App\Models\Product::where(['status' => 1, 'featured' => 0])->get();
            @endphp
            <div class="row">
                @foreach ($products as $product)
                    <div class="text-center col-lg-4 col-md-6">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="single-product.html"><img src="{{ asset('storage/' . $product->image) }}"
                                        alt="" width="200" height="250"></a>
                            </div>
                            <h3>{{ $product->name }}</h3>
                            <p class="product-price">
                                {{-- <span>Per Kg</span>  --}}
                                ${{ $product->price }} </p>
                            <a href="#" class="cart-btn add-to-cart" data-slug="{{ $product->slug }}"><i
                                    class="fas fa-shopping-cart"></i> Add to Cart</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end product section -->

    <!-- cart banner section -->
    @include('frontend.deal')
    <!-- end cart banner section -->

    <!-- testimonail-section -->
    <div class="testimonail-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="text-center col-lg-10 offset-lg-1">
                    <div class="testimonial-sliders">
                        <div class="single-testimonial-slider">
                            <div class="client-avater">
                                <img src="assets/img/avaters/avatar1.png" alt="">
                            </div>
                            <div class="client-meta">
                                <h3>Saira Hakim <span>Local shop owner</span></h3>
                                <p class="testimonial-body">
                                    " Sed ut perspiciatis unde omnis iste natus error veritatis et quasi architecto beatae
                                    vitae dict eaque ipsa quae ab illo inventore Sed ut perspiciatis unde omnis iste natus
                                    error sit voluptatem accusantium "
                                </p>
                                <div class="last-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="single-testimonial-slider">
                            <div class="client-avater">
                                <img src="assets/img/avaters/avatar2.png" alt="">
                            </div>
                            <div class="client-meta">
                                <h3>David Niph <span>Local shop owner</span></h3>
                                <p class="testimonial-body">
                                    " Sed ut perspiciatis unde omnis iste natus error veritatis et quasi architecto beatae
                                    vitae dict eaque ipsa quae ab illo inventore Sed ut perspiciatis unde omnis iste natus
                                    error sit voluptatem accusantium "
                                </p>
                                <div class="last-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="single-testimonial-slider">
                            <div class="client-avater">
                                <img src="assets/img/avaters/avatar3.png" alt="">
                            </div>
                            <div class="client-meta">
                                <h3>Jacob Sikim <span>Local shop owner</span></h3>
                                <p class="testimonial-body">
                                    " Sed ut perspiciatis unde omnis iste natus error veritatis et quasi architecto beatae
                                    vitae dict eaque ipsa quae ab illo inventore Sed ut perspiciatis unde omnis iste natus
                                    error sit voluptatem accusantium "
                                </p>
                                <div class="last-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end testimonail-section -->

    <!-- advertisement section -->
    <div class="abt-section mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="abt-bg">
                        <a href="https://www.youtube.com/watch?v=DBLlFWYcIGQ" class="video-play-btn popup-youtube"><i
                                class="fas fa-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="abt-text">
                        <p class="top-sub">Since Year 1999</p>
                        <h2>We are <span class="orange-text">Fruitkha</span></h2>
                        <p>Etiam vulputate ut augue vel sodales. In sollicitudin neque et massa porttitor vestibulum ac vel
                            nisi. Vestibulum placerat eget dolor sit amet posuere. In ut dolor aliquet, aliquet sapien sed,
                            interdum velit. Nam eu molestie lorem.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente facilis illo repellat
                            veritatis minus, et labore minima mollitia qui ducimus.</p>
                        <a href="about.html" class="mt-4 boxed-btn">know more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end advertisement section -->

    @if ($footer_banner)
        <!-- shop banner -->
        <section class="shop-banner"
            style="background-image: url({{ asset('storage/' . $footer_banner->image) }}); width: 100%; height: 494px;">
            <div class="container">
                {!! $footer_banner->more ?? '' !!}
                <a href="shop.html" class="cart-btn btn-lg">Shop Now</a>
            </div>
        </section>
        <!-- end shop banner -->
    @endif

    <!-- latest news -->
    <!-- <div class="latest-news pt-150 pb-150">
                                <div class="container">

                                    <div class="row">
                                        <div class="text-center col-lg-8 offset-lg-2">
                                            <div class="section-title">
                                                <h3><span class="orange-text">Our</span> News</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                                                    beatae optio.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-latest-news">
                                                <a href="single-news.html">
                                                    <div class="latest-news-bg news-bg-1"></div>
                                                </a>
                                                <div class="news-text-box">
                                                    <h3><a href="single-news.html">You will vainly look for fruit on it in autumn.</a></h3>
                                                    <p class="blog-meta">
                                                        <span class="author"><i class="fas fa-user"></i> Admin</span>
                                                        <span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
                                                    </p>
                                                    <p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi.
                                                        Praesent vitae mattis nunc, egestas viverra eros.</p>
                                                    <a href="single-news.html" class="read-more-btn">read more <i
                                                            class="fas fa-angle-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-latest-news">
                                                <a href="single-news.html">
                                                    <div class="latest-news-bg news-bg-2"></div>
                                                </a>
                                                <div class="news-text-box">
                                                    <h3><a href="single-news.html">A man's worth has its season, like tomato.</a></h3>
                                                    <p class="blog-meta">
                                                        <span class="author"><i class="fas fa-user"></i> Admin</span>
                                                        <span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
                                                    </p>
                                                    <p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi.
                                                        Praesent vitae mattis nunc, egestas viverra eros.</p>
                                                    <a href="single-news.html" class="read-more-btn">read more <i
                                                            class="fas fa-angle-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
                                            <div class="single-latest-news">
                                                <a href="single-news.html">
                                                    <div class="latest-news-bg news-bg-3"></div>
                                                </a>
                                                <div class="news-text-box">
                                                    <h3><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></h3>
                                                    <p class="blog-meta">
                                                        <span class="author"><i class="fas fa-user"></i> Admin</span>
                                                        <span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
                                                    </p>
                                                    <p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi.
                                                        Praesent vitae mattis nunc, egestas viverra eros.</p>
                                                    <a href="single-news.html" class="read-more-btn">read more <i
                                                            class="fas fa-angle-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-center col-lg-12">
                                            <a href="news.html" class="boxed-btn">More News</a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
    <!-- end latest news -->

    <!-- logo carousel -->
    <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/1.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/2.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/3.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/4.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end logo carousel -->
@endsection
@push('after-scripts')
    <script></script>
@endpush
