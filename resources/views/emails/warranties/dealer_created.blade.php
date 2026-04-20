<x-mail::message>
    # New Warranty Registered

    A new warranty has been registered successfully.

    **Customer Name:** {{ $warranty->customer_name }}
    **Car Type:** {{ $warranty->car_type }}
    **Engine Number:** {{ $warranty->engine_number }}
    **Registration Date:** {{ $warranty->created_at->format('M d, Y') }}

    <x-mail::button :url="url(config('app.url') . '/user/warranties/' . $warranty->id)">
        View Warranty
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
