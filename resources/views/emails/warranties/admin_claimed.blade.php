<x-mail::message>
    # Warranty Claim Request

    A new warranty claim has been requested by a dealer.

    **Car Type:** {{ $warrantyItem->warranty->car_type }}
    **Engine Number:** {{ $warrantyItem->warranty->engine_number }}
    **Item Name:** {{ $warrantyItem->product_name }}

    <x-mail::button :url="url(config('app.url') . '/admin/warranties?search=' . $warrantyItem->warranty->warranty_code)">
        Review Claim
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
