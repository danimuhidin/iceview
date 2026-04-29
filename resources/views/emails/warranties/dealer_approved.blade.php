<x-mail::message>
# Klaim Garansi Disetujui

Sebuah klaim garansi telah disetujui.

**Tipe Mobil:** {{ $warrantyItem->warranty->car_type }}
**Nomor Polisi:** {{ $warrantyItem->warranty->license_plate_number ?? '-' }}
**Nomor Rangka:** {{ $warrantyItem->warranty->engine_number }}
    <x-mail::button :url="url(config('app.url') . '/user/warranties/' . $warrantyItem->warranty->id)">
        Lihat Detail
    </x-mail::button>

Terima kasih,
{{ config('app.name') }}
</x-mail::message>
