<p>Dear {{ $order['customer_name'] }},</p>
<p>Thank you for your order!</p>
<p>Order Details:</p>
<ul>
    @foreach ($order['items'] as $item)
        <li>{{ $item['name'] }} - {{ $item['quantity'] }}</li>
    @endforeach
</ul>
<p>Total: ${{ $order['total'] }}</p>
