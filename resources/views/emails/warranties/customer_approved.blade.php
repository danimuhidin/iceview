<x-mail::message>
# Klaim Garansi Disetujui

Klaim garansi Anda telah disetujui.

**Tipe Mobil:** {{ $warrantyItem->warranty->car_type }}
**Nomor Polisi:** {{ $warrantyItem->warranty->license_plate_number ?? '-' }}
**Nomor Rangka:** {{ $warrantyItem->warranty->engine_number }}
    <x-mail::button :url="url(config('app.url') . '/warranties/' . $warrantyItem->warranty->warranty_code)">
        Lihat Garansi
    </x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
