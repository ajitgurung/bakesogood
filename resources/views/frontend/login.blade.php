@extends('frontend.layout.app')
@section('content')
<!-- contact form -->
<div class="contact-from-section mt-100 mb-100">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <div id="form_status"></div>
                <div class="contact-form">
                    <form method="POST" id="fruitkha-contact" action="{{ route('login.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary btn-block" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end contact form -->
@endsection

