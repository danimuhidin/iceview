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
