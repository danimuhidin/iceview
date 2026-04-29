<x-mail::message>
    # Klaim Garansi Disetujui

    Klaim garansi Anda telah disetujui.

    **Tipe Mobil:** {{ $warrantyItem->warranty->car_type }}
    **Mesin:** {{ $warrantyItem->warranty->engine_number }}
    **Nama Item:** {{ $warrantyItem->item_name }}

    <x-mail::button :url="url(config('app.url') . '/warranties/' . $warrantyItem->warranty->warranty_code)">
        Lihat Garansi
    </x-mail::button>

    Terima kasih,<br>
    {{ config('app.name') }}
</x-mail::message>
