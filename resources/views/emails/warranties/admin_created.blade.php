<x-mail::message>
    # New Warranty Registered

    A new warranty has been registered by a dealer.

    **Customer Name:** {{ $warranty->customer_name }}
    **Car Type:** {{ $warranty->car_type }}
    **Engine Number:** {{ $warranty->engine_number }}
    **Registration Date:** {{ $warranty->created_at->format('M d, Y') }}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
