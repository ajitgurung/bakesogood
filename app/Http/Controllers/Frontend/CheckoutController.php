<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Rinvex\Country\CountryLoader;
use Illuminate\Support\Str;


class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = Session::get('cart', []);
        $countries = CountryLoader::countries();
        return view('frontend.checkout', compact('countries', 'cart'));
    }

    public function getStates($countryCode)
    {
        $country = CountryLoader::country($countryCode);
        $states = $country->getDivisions();

        return response()->json($states);
    }

    public function getNextOrderNumber()
{
    $startNumber = 9001;
    $lastOrder = Order::orderBy('order_number', 'desc')->first();

    if ($lastOrder) {
        return $lastOrder->order_number + 1;
    }

    return $startNumber;
}

    public function placeOrder(Request $request)
{
    $stripeSecretKey = env('STRIPE_SECRET');
    \Stripe\Stripe::setApiKey($stripeSecretKey);

    $stripeToken = $request->input('stripeToken');

    // Optionally, check for token existence and validity
    if (!$stripeToken) {
        return redirect()->back()->withErrors('Payment token was not generated correctly.');
    }

    try {
        // Create a charge or use Payment Intents API for more complex scenarios
        $cart = Session::get('cart');

        $charge = \Stripe\Charge::create([
            'amount' => $cart['total'] * 100, // Amount in cents
            'currency' => 'CAD',
            'source' => $stripeToken,
            'description' => json_encode($cart),
        ]);

        $order = new Order();
        $order->user_id = auth()->user()->id ?? null;
        $order->order_number = $this->getNextOrderNumber();
        $order->total_amount = $cart['total'];
        $order->payment_status = 'completed';
        $order->order_status = 'processing';

        if ($order->save()) {
            $this->saveAddress($order->id, $request->billing, 'billing');

            if (count($request->shipping) == 1) {
                $this->duplicateAddressAsShipping($order->id, $request->billing);
            } else {
                $this->saveAddress($order->id, $request->shipping, 'shipping');
            }

            foreach ($cart['products'] as $item) {
                $product = Product::where('slug', $item['slug'])->firstOrFail();
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'total' => $item['subtotal']
                ]);
            }

            session()->forget('cart');
        }

        return redirect()->route('home')->with('success', 'Your order has been placed successfully!');

    } catch (\Stripe\Exception\CardException $e) {
        // Handle the exception properly
        return redirect()->back()->with('error', $e->getMessage()); // Correctly passing the error message
    } catch (\Exception $e) {
        // Handle general exceptions
        return redirect()->back()->with('error', 'An error occurred while processing your order.');
    }
}


    protected function saveAddress(int $orderId, array $addressData, string $addressType)
    {
        Address::create([
            'order_id' => $orderId,
            'user_id' => auth()->user()->id ?? null,
            'name' => $addressData['name'],
            'email' => $addressData['email'],
            'address_line_1' => $addressData['address_line_1'],
            'country' => $addressData['country'],
            'state' => $addressData['state'],
            'city' => $addressData['city'],
            'postal_code' => $addressData['zipcode'],
            'phone_number' => $addressData['phone'],
            'address_type' => $addressType,
        ]);
    }

    protected function duplicateAddressAsShipping(int $orderId, array $billingData)
    {
        $this->saveAddress($orderId, $billingData, 'shipping');
    }

}
