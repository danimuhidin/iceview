<x-mail::message>
# Garansi Baru Terdaftar

Sebuah garansi baru telah didaftarkan oleh dealer.

**Nama Pelanggan:** {{ $warranty->customer_name }}
**Tipe Mobil:** {{ $warranty->car_type }}
**Nomor Polisi:** {{ $warranty->license_plate_number ?? '-' }}
**Nomor Rangka:** {{ $warranty->engine_number }}
Terima kasih,
{{ config('app.name') }}
</x-mail::message>
