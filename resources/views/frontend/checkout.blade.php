@extends('frontend.layout.app')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Check Out Product</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- check out section -->
    <form action="{{ route('checkout.placeorder') }}" method="POST" id="payment-form">
        @csrf
        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
        <div class="checkout-section mt-150 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-accordion-wrap">
                            <div class="accordion" id="accordionExample">
                                <!-- Billing Address -->
                                {{-- <div class="card single-accordion">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Billing Address
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="billing-address-form">
                                                <p><input type="text" name="billing[name]" placeholder="Name"
                                                        id="billing-name"></p>
                                                <p><input type="email" name="billing[email]" placeholder="Email"
                                                        id="billing-email"></p>
                                                <p><input type="text" name="billing[address_line_1]"
                                                        placeholder="Address Line 1" id="billing-address"></p>
                                                <p>
                                                    <select name="billing[country]" id="billing-country">
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country['iso_3166_1_alpha2'] }}"
                                                                {{ $country['name'] == 'Canada' ? 'selected' : '' }}>
                                                                {{ $country['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                                <p>
                                                    <select name="billing[state]" id="billing-state">
                                                        <option value="">Select State</option>
                                                    </select>
                                                </p>
                                                <p>
                                                    <input type="text" name="billing[city]" placeholder="City"
                                                        class="col-lg-5" id="billing-city">
                                                    <input type="text" name="billing[zipcode]" placeholder="Zipcode"
                                                        class="col-lg-5" id="billing-zipcode">
                                                </p>
                                                <p><input type="tel" placeholder="Phone" name="billing[phone]"
                                                        id="billing-phone"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Shipping Address -->
                                <div class="card single-accordion">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                Shipping Address
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="billing-address-form">
                                                {{-- <p><button type="button" onclick="copyBillingToShipping()">Copy Billing
                                                        Address to Shipping</button></p> --}}

                                                <p><input type="text" placeholder="Name" name="shipping[name]"
                                                        id="shipping-name" required></p>
                                                <p><input type="email" placeholder="Email" name="shipping[email]"
                                                        id="shipping-email" required></p>
                                                <p><input type="text" name="shipping[address_line_1]"
                                                        placeholder="Address Line 1" id="shipping-address" required></p>
                                                <p>
                                                    <select name="shipping[country]" id="shipping-country" disabled>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country['iso_3166_1_alpha2'] }}"
                                                                {{ $country['name'] == 'Canada' ? 'selected' : '' }}>
                                                                {{ $country['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                                <p>
                                                    <select name="shipping[state]" id="shipping-state" required>
                                                        <option value="">Select State</option>
                                                    </select>
                                                </p>
                                                <p>
                                                    <input type="text" name="shipping[city]" placeholder="City"
                                                        class="col-lg-5" id="shipping-city" required>
                                                    <input type="text" name="shipping[zipcode]" placeholder="Zipcode"
                                                        class="col-lg-5" id="shipping-zipcode" required>
                                                </p>
                                                <p><input type="tel" placeholder="Phone" name="shipping[phone]"
                                                        id="shipping-phone" required></p>
                                                <p>
                                                    <textarea name="shipping[note]" id="bill" cols="30" rows="10" placeholder="Say Something"></textarea>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Details -->
                                {{-- <div class="card single-accordion">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                Card Details
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="billing-address-form">

                                                <label for="card-element">
                                                    Credit or debit card
                                                </label>
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="order-details-wrap">
                            <table class="order-details">
                                <thead>
                                    <tr>
                                        <th>Your order Details</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody class="order-details-body">
                                    @foreach ($cart['products'] as $cartProduct)
                                        @php
                                            $product = App\Models\Product::where(
                                                'slug',
                                                $cartProduct['slug'],
                                            )->firstOrFail();
                                        @endphp
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $cartProduct['quantity'] }}</td>
                                            <td>{{ $cartProduct['subtotal'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tbody class="checkout-details">
                                    <tr>
                                        <td>Total</td>
                                        <td colspan="2">${{ $cart['total'] }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Shipping</td>
                                        <td colspan="2">$50</td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <td>Total</td>
                                        <td colspan="2">${{ $cart['total'] + 50 }}</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                            <button type="submit" class="boxed-btn" style="margin-top: 25px;">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end check out section -->
@endsection
@push('after-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function() {
            // Trigger when the country changes
            $('#billing-country').change(function() {
                var countryCode = $(this).val();

                if (countryCode) {
                    $.ajax({
                        url: '/get-states/' + countryCode,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#billing-state').empty().append(
                                '<option value="">Select State</option>');
                            $.each(data, function(key, value) {
                                $('#billing-state').append('<option value="' + key +
                                    '">' +
                                    value.name + '</option>');
                            });
                        },
                        error: function() {
                            $('#billing-state').empty().append(
                                '<option value="">No states available</option>');
                        }
                    });
                } else {
                    $('#billing-state').empty().append('<option value="">Select State</option>');
                }
            });

            // Automatically trigger change event to load states when page loads
            $('#billing-country').trigger('change');
        });

        $(document).ready(function() {
            // Trigger when the country changes
            $('#shipping-country').change(function() {
                var countryCode = $(this).val();

                if (countryCode) {
                    $.ajax({
                        url: '/get-states/' + countryCode,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#shipping-state').empty().append(
                                '<option value="">Select State</option>');
                            $.each(data, function(key, value) {
                                $('#shipping-state').append('<option value="' + key +
                                    '">' +
                                    value.name + '</option>');
                            });
                        },
                        error: function() {
                            $('#shipping-state').empty().append(
                                '<option value="">No states available</option>');
                        }
                    });
                } else {
                    $('#shipping-state').empty().append('<option value="">Select State</option>');
                }
            });

            // Automatically trigger change event to load states when page loads
            $('#shipping-country').trigger('change');
        });

        function copyBillingToShipping() {
            document.getElementById('shipping-name').value = document.getElementById('billing-name').value;
            document.getElementById('shipping-email').value = document.getElementById('billing-email').value;
            document.getElementById('shipping-address').value = document.getElementById('billing-address').value;
            document.getElementById('shipping-country').value = document.getElementById('billing-country').value;
            document.getElementById('shipping-state').value = document.getElementById('billing-state').value;
            document.getElementById('shipping-city').value = document.getElementById('billing-city').value;
            document.getElementById('shipping-zipcode').value = document.getElementById('billing-zipcode').value;
            document.getElementById('shipping-phone').value = document.getElementById('billing-phone').value;

            // Disable the shipping address fields
            document.getElementById('shipping-name').disabled = true;
            document.getElementById('shipping-email').disabled = true;
            document.getElementById('shipping-address').disabled = true;
            document.getElementById('shipping-country').disabled = true;
            document.getElementById('shipping-state').disabled = true;
            document.getElementById('shipping-city').disabled = true;
            document.getElementById('shipping-zipcode').disabled = true;
            document.getElementById('shipping-phone').disabled = true;
        }
    </script>
@endpush
