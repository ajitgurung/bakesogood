@extends('frontend.layout.app')
@section('content')
    @php
        $about = App\Models\About::firstOrFail();
    @endphp
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>We sale fresh fruits</p>
                        <h1>About Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- about section -->
    <div class="abt-section mb-150" style="padding-top: 100px;">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about section -->

    <!-- featured section -->
    <div class="feature-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="featured-text">
                        <h2 class="pb-3">Why <span class="orange-text">{{ $setting->site_title ?? '' }}</span></h2>
                        <div class="row">
                            @if (isset($about->why_us) && is_array($about->why_us) && count($about->why_us) > 0)
                                @foreach ($about->why_us as $item)
                                    <div class="col-lg-6 col-md-6 mb-4 mb-md-5">
                                        <div class="list-box d-flex">
                                            <div class="list-icon">
                                                <i class="{{ $item['icon_class'] }}"></i>
                                            </div>
                                            <div class="content">
                                                <h3>{{ $item['title'] }}</h3>
                                                <p>s{{ $item['description'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end featured section -->
@endsection
