<x-mail::message>
    # Garansi Anda Telah Terdaftar

    Halo {{ $warranty->customer_name }},

    Pendaftaran garansi Anda telah berhasil. Berikut adalah detail garansi Anda:

    **Tipe Mobil:** {{ $warranty->car_type }}
    **Nomor Mesin:** {{ $warranty->engine_number }}
    **Tanggal Pendaftaran:** {{ $warranty->created_at->format('d M Y') }}

    <x-mail::button :url="url(config('app.url') . '/warranties/' . $warranty->warranty_code)">
        Lihat Garansi Anda
    </x-mail::button>

    Garansi Tidak Berlaku dan Batal Apabila:
    - Pemasangan Bukan Dilakukan oleh Cabang Resmi ICEVIEW INDONESIA.
    - Pembeli Tidak Melakukan Perawatan Sesuai Dengan Petunjuk yang diberikan.
    - Kaca Film Rusak Akibat Kelalaian Pembeli, Bencana Alam, Kebakaran & Kecelakaan.
    - Kartu Garansi Di Pindahtangankan.
    - Terjadi Rangkap Dua (Double) Terhadap Kaca Film Apapun.

    **Catatan Penting:** Penggantian Klaim Kaca Film Di Atas 1 (Satu) Tahun Akan Dikenakan Biaya Pemasangan.

    Terima kasih,<br>
    {{ config('app.name') }}
</x-mail::message>
