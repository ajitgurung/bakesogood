<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class OrderPdfController extends Controller
{
    public function __invoke(Request $request, Order $order)
    {
        $order->load(['orderItems.product', 'user']);
 
        $user = new Buyer([
            'name' => $order->user->name,
            'custom_fields' => [
                'email' => $order->user->email,
            ],
        ]);
 
        $items = [];
 
        foreach ($order->orderItems as $product) {
            $items[] = (new InvoiceItem())
                ->title($product->product->name)
                ->pricePerUnit($product->price)
                ->subTotalPrice($product->price * $product->quantity)
                ->quantity($product->quantity);
        }
 
        $invoice = Invoice::make()
            ->sequence($order->id)
            ->buyer($user)
            ->taxRate($order->taxes)
            ->totalAmount($order->total)
            ->addItems($items);
 
        if ($request->has('preview')) {
            return $invoice->stream();
        }
 
        return $invoice->download();
    }
}
