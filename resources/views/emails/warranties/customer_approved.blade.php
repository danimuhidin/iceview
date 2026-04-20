<x-mail::message>
    # Warranty Claim Approved

    Your warranty claim has been approved.

    **Car Type:** {{ $warrantyItem->warranty->car_type }}
    **Engine:** {{ $warrantyItem->warranty->engine_number }}
    **Item Name:** {{ $warrantyItem->item_name }}

    <x-mail::button :url="url(config('app.url') . '/warranties/' . $warrantyItem->warranty->warranty_code)">
        View Warranty
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
