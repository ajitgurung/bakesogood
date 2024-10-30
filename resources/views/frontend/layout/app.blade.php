<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>@yield('title', 'AMAZING') | BakeSoGood</title>

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
                            <ul>
                                <li class="current-list-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li><a href="{{ route('about') }}">About</a></li>
                                {{-- <li><a href="news.html">News</a>
                                    <ul class="sub-menu">
                                        <li><a href="news.html">News</a></li>
                                        <li><a href="single-news.html">Single News</a></li>
                                    </ul>
                                </li> --}}
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                                <li><a href="{{ route('shop', 'all') }}">Shop</a>
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
                                        <a class="user-profile" href="{{ route('dashboard') }}"><i
                                                class="fas fa-user"></i></a>
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

    <!-- footer -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box about-widget">
                        <h2 class="widget-title">About us</h2>
                        <p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box get-in-touch">
                        <h2 class="widget-title">Get in Touch</h2>
                        <ul>
                            <li>{{ $setting->address ?? '' }}</li>
                            <li>{{ $setting->site_email ?? '' }}</li>
                            <li>{{ $setting->phone ?? '' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box pages">
                        <h2 class="widget-title">Pages</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="{{ route('shop', 'all') }}">Shop</a></li>
                            {{-- <li><a href="news.html">News</a></li> --}}
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box subscribe">
                        <h2 class="widget-title">Subscribe</h2>
                        <p>Subscribe to our mailing list to get the latest updates.</p>
                        <form action="index.html">
                            <input type="email" placeholder="Email">
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end footer -->

    <!-- copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>Copyrights &copy; 2024 - <a href="#">Ajit Gurung</a>, All Rights
                        Reserved.<br>
                    </p>
                </div>
                <div class="text-right col-lg-6 col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright -->

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
    @stack('after-scripts')

</body>

</html>
