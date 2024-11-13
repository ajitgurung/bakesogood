<!-- footer -->
<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-box about-widget">
                    <h2 class="widget-title">About us</h2>
                    <p>{{ $setting->og_description ?? '' }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box get-in-touch">
                    <h2 class="widget-title">Get in Touch</h2>
                    <ul>
                        <li>{{ $setting->address ?? '' }}</li>
                        <li><a href="mailto:{{ $setting->site_email ?? '' }}">{{ $setting->site_email ?? '' }}</a></li>
                        <li><a href="tel:{{ $setting->phone ?? '' }}">{{ $setting->phone ?? '' }}</a></li>
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
                <p>Copyrights &copy; 2024 - <a href="#">Goodies Bakery</a>, All Rights
                    Reserved.<br>
                </p>
            </div>
            <div class="text-right col-lg-6 col-md-12">
                <div class="social-icons">
                    <ul>
                        <li><a href="{{ $setting->facebook_url ?? '' }}" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{ $setting->instagram_url ?? '' }}" target="_blank"><i
                                    class="fab fa-instagram"></i></a></li>
                        <li><a href="{{ $setting->tiktok_url ?? '' }}" target="_blank"><i
                                    class="fab fa-tiktok"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end copyright -->
