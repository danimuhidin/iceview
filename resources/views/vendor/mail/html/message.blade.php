<x-mail::layout>
    {{-- Header --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">
            {{ config('app.name') }}
        </x-mail::header>
    </x-slot:header>

    {{-- Body --}}
    {!! $slot !!}

    {{-- Subcopy --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy>
                {!! $subcopy !!}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer>
            @php
                $siteInfo = \App\Models\SiteInfo::first();
            @endphp
            © {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}

            @if ($siteInfo)
                <br><br>
                **Website:** [{{ config('app.url') }}]({{ config('app.url') }}) <br>
                **Alamat Kantor:** {{ $siteInfo->address }} <br>
                **Nomor Telepon:** {{ $siteInfo->phone }}
            @endif
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
