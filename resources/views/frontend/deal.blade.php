@php
    $featured = App\Models\Product::where(['featured' => 1, 'status' => 1])
        ->orderBy('order')
        ->first();
@endphp
@if ($featured)
    <section class="cart-banner pt-100 pb-100">
        <div class="container">
            <div class="row clearfix">
                <!--Image Column-->
                <div class="image-column col-lg-6">
                    <div class="image">
                        @if ($featured->dis_per > 0)
                            <div class="price-box">
                                <div class="inner-price">
                                    <span class="price">
                                        <strong>{{ (int) $featured->dis_per }}%</strong> off
                                    </span>
                                </div>
                            </div>
                        @endif
                        <img src="{{ asset('storage/products/' . $featured->image) }}" alt="" width="650px"
                            height="495px">
                    </div>
                </div>
                <!--Content Column-->
                <div class="content-column col-lg-6">
                    <h3><span class="orange-text">Deal</span> of the month</h3>
                    <h4>{{ $featured->name }}</h4>
                    <div class="text">
                        {!! Str::limit($featured->description, 205) !!}
                    </div>
                    <!--Countdown Timer-->
                    <div class="time-counter">
                        <div class="time-countdown clearfix" data-countdown="2020/2/01">
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Days</div>
                            </div>
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Hours</div>
                            </div>
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Mins</div>
                            </div>
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Secs</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('cart.add', $featured->slug)}}" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                </div>
            </div>
        </div>
    </section>
@endif
