<x-mail::message>
    # Your Warranty has been Registered

    Hello {{ $warranty->customer_name }},

    Your warranty registration is complete. Here are your details:

    **Car Type:** {{ $warranty->car_type }}
    **Engine Number:** {{ $warranty->engine_number }}
    **Registration Date:** {{ $warranty->created_at->format('M d, Y') }}

    <x-mail::button :url="url(config('app.url') . '/warranties/' . $warranty->warranty_code)">
        View Your Warranty
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
