<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicPageController extends Controller
{
    private function dealersData(): array
    {
        return [
            [
                'name' => 'Iceview Experience Center',
                'city' => 'Jakarta',
                'address' => 'Jl. Sinar Terang No. 12, Jakarta Selatan',
                'maps' => 'https://maps.google.com/?q=Jl.+Sinar+Terang+No.+12+Jakarta+Selatan',
                'phone' => '081234567890',
            ],
            [
                'name' => 'Iceview Auto Gallery',
                'city' => 'Bandung',
                'address' => 'Jl. Dago Utama No. 88, Bandung',
                'maps' => 'https://maps.google.com/?q=Jl.+Dago+Utama+No.+88+Bandung',
                'phone' => '081298765432',
            ],
            [
                'name' => 'Iceview Certified Partner',
                'city' => 'Surabaya',
                'address' => 'Jl. Raya Kertajaya No. 45, Surabaya',
                'maps' => 'https://maps.google.com/?q=Jl.+Raya+Kertajaya+No.+45+Surabaya',
                'phone' => '081355512345',
            ],
            [
                'name' => 'Iceview Partner Studio',
                'city' => 'Yogyakarta',
                'address' => 'Jl. Solo KM 7, Yogyakarta',
                'maps' => 'https://maps.google.com/?q=Jl.+Solo+KM+7+Yogyakarta',
                'phone' => '081377700888',
            ],
        ];
    }

    private function productsData(): array
    {
        return [
            [
                'slug' => 'iceview-solar-shield',
                'name' => 'Iceview Solar Shield',
                'series' => 'Signature Series',
                'tag' => 'High Heat Rejection',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Performa penolakan panas tinggi dengan visibilitas jernih untuk penggunaan harian premium.',
                'features' => [
                    'Heat rejection hingga 65%',
                    'UV protection sampai 99%',
                    'Visibilitas tetap nyaman siang dan malam',
                ],
            ],
            [
                'slug' => 'iceview-ceramic-pro',
                'name' => 'Iceview Ceramic Pro',
                'series' => 'Elite Series',
                'tag' => 'Signal Friendly',
                'image' => 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Teknologi nano-ceramic untuk menahan panas maksimal tanpa mengganggu sinyal elektronik kendaraan.',
                'features' => [
                    'Tidak mengganggu GPS dan e-toll',
                    'Tingkat kejernihan tinggi',
                    'Reduksi silau lebih stabil',
                ],
            ],
            [
                'slug' => 'iceview-safety-guard',
                'name' => 'Iceview Safety Guard',
                'series' => 'Security Series',
                'tag' => 'Safety Layer',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Lapisan tambahan untuk membantu mengurangi risiko pecahan kaca dan meningkatkan keamanan kabin.',
                'features' => [
                    'Meminimalkan serpihan kaca',
                    'Menambah kekuatan struktur kaca',
                    'Cocok untuk perlindungan ekstra',
                ],
            ],
        ];
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function products(): View
    {
        return view('pages.products', [
            'products' => $this->productsData(),
        ]);
    }

    public function productDetail(string $slug): View
    {
        $product = collect($this->productsData())->firstWhere('slug', $slug);

        abort_if(! $product, 404);

        return view('pages.product-detail', [
            'product' => $product,
        ]);
    }

    public function dealers(): View
    {
        return view('pages.dealers', [
            'dealers' => $this->dealersData(),
        ]);
    }

    public function waranty(): View
    {
        return view('pages.waranty');
    }
}
