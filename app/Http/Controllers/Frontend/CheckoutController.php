<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Rinvex\Country\CountryLoader;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = Session::get('cart', []);
        if (!empty($cart)) {

            $countries = CountryLoader::countries();
            return view('frontend.checkout', compact('countries', 'cart'));
        }

        return redirect('/')->with('error', 'Add some product in cart before checkout');
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
        $request->validate([
            'shipping.name' => 'required|string|max:255',
            'shipping.email' => 'required|email|max:255',
            'shipping.address_line_1' => 'required|string|max:255',
            'shipping.state' => 'required|string|max:255',
            'shipping.city' => 'required|string|max:255',
            'shipping.zipcode' => 'required|string|max:20',
            'shipping.phone' => 'required|string|max:15',
            'shipping.note' => 'nullable|string|max:500',
        ]);

        $cart = Session::get('cart');

        $order = new Order();
        $order->user_id = auth()->user()->id ?? null;
        $order->order_number = $this->getNextOrderNumber();
        $order->payment_status = 'pending';
        $order->order_status = 'processing';
        $order->taxes = 0.13 * $cart['total'];

        if ($order->save()) {
            $this->saveAddress($order->id, $request->shipping, 'shipping');

            foreach ($cart['products'] as $item) {
                $product = Product::where('slug', $item['slug'])->firstOrFail();
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'total' => $item['subtotal'],
                ]);
            }
            $adminEmail = Setting::select('site_email')->where('id', 1)->first();
            Mail::to($request->shipping['email'], $adminEmail)->send(new OrderPlaced($order));

            session()->forget('cart');
        }

        return redirect()->route('home')->with('success', 'Your order has been placed successfully!');
    }

    protected function saveAddress(int $orderId, array $addressData, string $addressType)
    {
        Address::create([
            'order_id' => $orderId,
            'user_id' => auth()->user()->id ?? null,
            'name' => $addressData['name'],
            'email' => $addressData['email'],
            'address_line_1' => $addressData['address_line_1'],
            'country' => 'Canada',
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
