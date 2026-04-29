<x-mail::message>
    # Garansi Baru Terdaftar

    Sebuah garansi baru telah didaftarkan oleh dealer.

    **Nama Pelanggan:** {{ $warranty->customer_name }}
    **Tipe Mobil:** {{ $warranty->car_type }}
    **Nomor Mesin:** {{ $warranty->engine_number }}
    **Tanggal Pendaftaran:** {{ $warranty->created_at->format('d M Y') }}

    Terima kasih,<br>
    {{ config('app.name') }}
</x-mail::message>
