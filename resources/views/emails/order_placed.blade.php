<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
</head>

<body>
    <p>Dear {{ $order->address->name }},</p>
    <p>Thank you for your order!</p>
    <p>Order Details:</p>
    <ul>
        @foreach ($order->orderItems as $item)
            <li>{{ $item->product->name }} - {{ $item->quantity }}</li>
        @endforeach
    </ul>
    <p>Total: ${{ ($order->taxes * 100) / 13 }}</p>
</body>

</html>
