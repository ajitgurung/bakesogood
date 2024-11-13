<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Best Brazilian Bakery in Toronto">

    <!-- title -->
    <title>@yield('title', 'AMAZING') | Goodies Bakery</title>

    @if (!empty($setting->favicon))
        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('storage/' . $setting->favicon) }}">
    @endif


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend/bootstrap/css/bootstrap.min.css') }}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!-- mean menu css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.min.css') }}">
    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('after-styles')
    <style>
        .header-icons {
            position: relative;
        }

        .shopping-cart {
            position: relative;
            display: inline-block;
        }

        .cart-count {
            position: absolute;
            top: 10px;
            /* Adjust as needed */
            right: -5px;
            /* Adjust as needed */
            background-color: #f28123;
            /* Background color for the number */
            color: white;
            /* Text color */
            border-radius: 50%;
            /* Makes the background a circle */
            padding: 2px 6px;
            /* Adjust padding to fit the text */
            font-size: 12px;
            /* Adjust font size */
            font-weight: bold;
            line-height: 1;
            display: inline-block;
            min-width: 20px;
            /* Minimum width to keep it circular */
            text-align: center;
        }

        /* @media only screen and (max-width: 640px) {
            .cart-count {
                background-color: #f28123 !important;
                top: 5px !important;
                right: 445px;
                width: 15px;
                height: 15px;
                border-radius: 50%;
                font-size: 10px;
                padding: 2px 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        } */

        @media only screen and (max-width: 640px) {
            .cart-count {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

    <!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="text-center col-lg-12 col-sm-12">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="index.html">
                                <img src="assets/img/logo.png" alt="">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu">
                            @php
                                function activeClass($routeName)
                                {
                                    return request()->routeIs($routeName) ? 'current-list-item' : '';
                                }
                            @endphp
                            <ul>
                                <li class="{{ activeClass('home') }}"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="{{ activeClass('about') }}"><a href="{{ route('about') }}">About</a></li>
                                <li class="{{ activeClass('contact') }}"><a href="{{ route('contact') }}">Contact</a>
                                </li>
                                <li class="{{ activeClass('shop') }}"><a href="{{ route('shop', 'all') }}">Shop</a>
                                </li>
                                @php
                                    $cart = Session::get('cart');
                                    if (isset($cart['products'])) {
                                        $qty = array_sum(array_column($cart['products'], 'quantity'));
                                    }
                                @endphp
                                <li>
                                    <div class="header-icons">
                                        <a class="shopping-cart" href="{{ route('cart') }}"><i
                                                class="fas fa-shopping-cart"></i><span
                                                class="cart-count">{{ $qty ?? 0 }}</span></a>
                                        @if (auth()->check())
                                            <a class="user-profile" href="{{ route('dashboard') }}"><i
                                                    class="fas fa-user"></i></a>
                                        @endif
                                        <a class="mobile-hide search-bar-icon" href="{{ route('cart') }}"><i
                                                class="fas fa-search"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>Search For:</h3>
                            <input type="text" placeholder="Keywords">
                            <button type="submit">Search <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search arewa -->

    @yield('content')

    @include('frontend.layout.footer')

    <!-- jquery -->
    <script src="{{ asset('frontend/js/jquery-1.11.3.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('frontend/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- count down -->
    <script src="{{ asset('frontend/js/jquery.countdown.js') }}"></script>
    <!-- isotope -->
    <script src="{{ asset('frontend/js/jquery.isotope-3.0.6.min.js') }}"></script>
    <!-- waypoints -->
    <script src="{{ asset('frontend/js/waypoints.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!-- magnific popup -->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- mean menu -->
    <script src="{{ asset('frontend/js/jquery.meanmenu.min.js') }}"></script>
    <!-- sticker js -->
    <script src="{{ asset('frontend/js/sticker.js') }}"></script>
    <!-- form validation js -->
    <script src="{{ asset('frontend/js/form-validate.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif
        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').click(function(e) {
                e.preventDefault();
                var slug = $(this).data('slug');

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        slug: slug
                    },
                    success: function(response) {
                        toastr.success(response.message, 'success');
                        $('.cart-count').text(response.totalItems);
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong!', 'Error');
                    }
                });
            });
        });
    </script>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GFFTCZFQL1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GFFTCZFQL1');
    </script>
    @stack('after-scripts')

</body>

</html>
