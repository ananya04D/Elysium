<x-mail::message>
# Order Placed Successfully!

Thank you. Your order is {{ $order->id }}.

<x-mail::button :url="$url">
View Order
</x-mail::button>

Thanks,<br>
Team - Elysium
</x-mail::message>
