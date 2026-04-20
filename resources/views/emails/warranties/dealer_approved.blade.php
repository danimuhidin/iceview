<x-mail::message>
    # Warranty Claim Approved

    A warranty claim has been approved.

    **Car Type:** {{ $warrantyItem->warranty->car_type }}
    **Engine:** {{ $warrantyItem->warranty->engine_number }}
    **Item Name:** {{ $warrantyItem->item_name }}

    <x-mail::button :url="url(config('app.url') . '/user/warranties/' . $warrantyItem->warranty->id)">
        View Details
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
