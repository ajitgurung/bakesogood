<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Colors\Rgb\Channels\Red;

class CartController extends Controller
{
    public function showCart(){
        $cart = Session::get('cart', []);
        return view('frontend.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $slug = $request->input('slug');
        $quantity = $request->input('quantity', 1);
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $cart = Session::get('cart', []);

        if(empty($cart['products']))
        {
            $cart['total'] = 0;
        }

        if(isset($cart['products'][$slug]))
        {
            $cart['products'][$slug]['quantity'] += $quantity;
            $cart['products'][$slug]['subtotal'] += $quantity * $product->price;
        } else {
            $cart['products'][$slug] = [
                'slug' => $slug,
                'quantity' => $quantity,
                'subtotal' => $quantity * $product->price,
            ];
        }
        $cart['total'] += ($product->price * $quantity);

        Session::put('cart', $cart);
        $totalItems = array_sum(array_column($cart['products'], 'quantity'));

        return response()->json([
            'message' => 'Product added to cart successfully',
            'totalItems' => $totalItems
        ]);
    }

    public function updateCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'products' => 'required| array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cart = Session::get('cart');
        if (!$cart) {
            return redirect()->back()->with('error', 'Your cart is empty. Please add products to the cart!');
        }
        $cart['total'] = 0;
            foreach($request->products as $slug => $quantity)
        {
            $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        if(isset($cart['products'][$slug]))
        {
            $cart['products'][$slug]['quantity'] = $quantity;
            $cart['products'][$slug]['subtotal'] = $quantity * $product->price;
            $cart['total'] += ($product->price * $quantity);
        }
        }
        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Cart updated successfully!');
}

    public function remove($slug)
    {
        $cart = Session::get('cart');
        if (isset($cart['products'][$slug])) {
            $cart['total'] = $cart['total'] - $cart['products'][$slug]['subtotal'];
            unset($cart['products'][$slug]);
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart successfully!');
        }
        return redirect()->back()->with('error', 'Failed to remove product from cart.');
    }
}
