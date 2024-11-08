@extends('frontend.layout.app')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Get 24/7 Support</p>
                        <h1>Contact us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- contact form -->
    <div class="contact-from-section mt-100 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>Have you any question?</h2>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, ratione! Laboriosam est,
                            assumenda. Perferendis, quo alias quaerat aliquid. Corporis ipsum minus voluptate? Dolore, esse
                            natus!</p> --}}
                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" action="{{ route('message.store') }}" id="contact-form">
                            @csrf
                            <p>
                                <input type="text" placeholder="Name" name="name" id="name" required>
                                <input type="email" placeholder="Email" name="email" id="email" required>
                            </p>
                            <p>
                                <input type="tel" placeholder="Phone" name="phone" id="phone" required>
                                <input type="text" placeholder="Subject" name="subject" id="subject" required>
                            </p>
                            <p>
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Message" required></textarea>
                            </p>
                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

                            {{-- <p><button type="submit">Submit</button></p> --}}
                            <p><input type="submit" value="Submit"></p>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-form-wrap">
                        <div class="contact-form-box">
                            <h4><i class="fas fa-map"></i> Shop Address</h4>
                            <p>{{ $setting->address ?? '' }}</p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="far fa-clock"></i> Shop Hours</h4>
                            <p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="fas fa-address-book"></i> Contact</h4>
                            <p>Phone: {{ $setting->phone }} <br> Email: {{ $setting->site_email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact form -->

    <!-- find our location -->
    <div class="find-location blue-bg mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p> <i class="fas fa-map-marker-alt"></i> Find Our Location</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end find our location -->

    <!-- google map section -->
    <div class="embed-responsive embed-responsive-21by9">
        <iframe src="{{ $setting->google_map_url ?? '' }}" width="600" height="450" frameborder="0" style="border:0;"
            allowfullscreen="" class="embed-responsive-item"></iframe>
    </div>
    <!-- end google map section -->
@endsection

@push('after-scripts')
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                action: 'submit'
            }).then(function(token) {
                document.getElementById('g-recaptcha-response').value = token;
            });
        });
    </script>
@endpush
