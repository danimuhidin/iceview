<x-mail::message>
    # Pengajuan Klaim Garansi

    Sebuah pengajuan klaim garansi baru telah diajukan oleh dealer.

    **Tipe Mobil:** {{ $warrantyItem->warranty->car_type }}
    **Nomor Polisi:** {{ $warrantyItem->warranty->license_plate_number ?? '-' }}
    **Nomor Mesin:** {{ $warrantyItem->warranty->engine_number }}
    **Nama Item:** {{ $warrantyItem->product_name }}

    <x-mail::button :url="url(config('app.url') . '/admin/warranties?search=' . $warrantyItem->warranty->warranty_code)">
        Tinjau Klaim
    </x-mail::button>

    Terima kasih,<br>
    {{ config('app.name') }}
</x-mail::message>
