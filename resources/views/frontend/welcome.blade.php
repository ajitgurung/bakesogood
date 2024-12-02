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
                                        <a href="{{ route('shop', 'all') }}" class="boxed-btn">Sweet Collection</a>
                                        <a href="{{ route('contact') }}" class="bordered-btn">Contact Us</a>
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

    @php
        $about = App\Models\About::firstOrFail();
    @endphp

    @isset($about)
        <!-- features list section -->
        <div class="list-section pt-80 pb-80">
            <div class="container">

                <div class="row">
                    @if (isset($about->why_us) && is_array($about->why_us) && count($about->why_us) > 0)
                        @foreach (collect($about->why_us)->take(3) as $item)
                            <div class="mb-4 col-lg-4 col-md-6 mb-lg-0">
                                <div class="list-box d-flex align-items-center">
                                    <div class="list-icon">
                                        <i class="{{ $item['icon_class'] }}"></i>
                                    </div>
                                    <div class="content">
                                        <h3>{{ $item['title'] ?? '' }}</h3>
                                        <p>{{ $item['sub_title'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
        <!-- end features list section -->
    @endisset

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
                                <a href="{{ route('product', $product->slug) }}"><img
                                        src="{{ asset('storage/' . $product->image) }}" alt="" width="200"
                                        height="250"></a>
                            </div>
                            <a href="{{ route('product', $product->slug) }}">
                                <h3>{{ $product->name }}</h3>
                            </a>
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

    <!-- about section -->
    <div class="abt-section mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="abt-bg">
                        <a href="{{ $setting->youtube_url ?? '' }}" class="video-play-btn popup-youtube"><i
                                class="fas fa-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="abt-text">
                        {!! $about->description ?? '' !!}
                        <a href="{{ route('about') }}" class="mt-4 boxed-btn">know more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about section -->

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
