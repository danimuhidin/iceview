<x-mail::message>
# Halo, {{ $user->name }}!

Selamat datang di {{ config('app.name') }}. Akun Anda telah berhasil dibuat.

Berikut adalah detail login Anda:
**Email:** {{ $user->email }}
**Kata Sandi:** {{ $password }}

    <x-mail::button :url="config('app.url')">
        Kunjungi {{ config('app.name') }}
    </x-mail::button>

Terima kasih,
{{ config('app.name') }}
</x-mail::message>
