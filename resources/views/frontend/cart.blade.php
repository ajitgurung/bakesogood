@extends('frontend.layout.app')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="text-center col-lg-8 offset-lg-2">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- cart -->
    <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        <div class="cart-section mt-150 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="cart-table-wrap">
                            <table class="cart-table">
                                <thead class="cart-table-head">
                                    <tr class="table-head-row">
                                        <th class="product-remove"></th>
                                        <th class="product-image">Product Image</th>
                                        <th class="product-name">Name</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($cart)
                                        @foreach ($cart['products'] as $cartProduct)
                                            @php
                                                $product = App\Models\Product::where(
                                                    'slug',
                                                    $cartProduct,
                                                )->firstOrFail();
                                            @endphp
                                            <tr class="table-body-row">
                                                <td class="product-remove"><a
                                                        href="{{ route('cart.remove', $cartProduct) }}"><i
                                                            class="far fa-window-close"></i></a>
                                                </td>
                                                <td class="product-image"><img
                                                        src="{{ asset('storage/' . $product->image) }}" alt="">
                                                </td>
                                                <td class="product-name">{{ $product->name }}</td>
                                                <td class="product-price">${{ $product->price }}</td>
                                                <td class="product-quantity"><input type="number" placeholder="0"
                                                        name="products[{{ $product->slug }}]"
                                                        value="{{ $cartProduct['quantity'] }}"></td>
                                                <td class="product-total">{{ $cartProduct['subtotal'] }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="total-section">
                            <table class="total-table">
                                <thead class="total-table-head">
                                    <tr class="table-total-row">
                                        <th>Total</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="total-data">
                                        <td><strong>Subtotal: </strong></td>
                                        <td>${{ $cart['total'] ?? 0 }}</td>
                                    </tr>
                                    {{-- <tr class="total-data">
                                        <td><strong>Shipping: </strong></td>
                                        <td>$45</td>
                                    </tr> --}}
                                    <tr class="total-data">
                                        <td><strong>Total: </strong></td>
                                        <td>${{ $cart['total'] ?? 0 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="cart-buttons">
                                <button type="submit" class="boxed-btn">Update Cart</button>
                                @if ($cart)
                                    <a href="{{ route('checkout') }}" class="boxed-btn black">Check Out</a>
                                @endif

                            </div>
                        </div>

                        {{-- <div class="coupon-section">
                            <h3>Apply Coupon</h3>
                            <div class="coupon-form-wrap">
                                <form action="index.html">
                                    <p><input type="text" placeholder="Coupon"></p>
                                    <p><input type="submit" value="Apply"></p>
                                </form>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end cart -->
@endsection
