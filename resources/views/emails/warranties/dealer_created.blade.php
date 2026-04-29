<x-mail::message>
    # Garansi Baru Terdaftar

    Sebuah garansi baru telah berhasil didaftarkan.

    **Nama Pelanggan:** {{ $warranty->customer_name }}
    **Tipe Mobil:** {{ $warranty->car_type }}
    **Nomor Mesin:** {{ $warranty->engine_number }}
    **Tanggal Pendaftaran:** {{ $warranty->created_at->format('d M Y') }}

    <x-mail::button :url="url(config('app.url') . '/user/warranties/' . $warranty->id)">
        Lihat Garansi
    </x-mail::button>

    Terima kasih,<br>
    {{ config('app.name') }}
</x-mail::message>
