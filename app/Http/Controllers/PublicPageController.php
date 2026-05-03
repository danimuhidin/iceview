<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class PublicPageController extends Controller
{
    private function productsData(): array
    {
        return [
            [
                'slug' => 'ice-view-platinum',
                'name' => 'Ice View Platinum',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Hadir dikelas entry level produk kami, dengan teknologi nano ceramic yang memiliki tolak panas yang terbaik untuk kendaraan dan gedung dikelasnya.',
                'sub_products' => [
                    [
                        'name' => 'PLATINUM 40',
                        'image' => 'https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?auto=format&fit=crop&w=900&q=80',
                        'description' => 'Series Platinum dengan bahan dasar nano ceramic yang membuat sinar cahaya matahari tetap masuk sehingga pandangan anda tetap jernih namun mendapatkan proteksi yang maksimal.',
                        'specifications' => [
                            'Color' => 'Black 40%',
                            'Vlt' => '35%',
                            'IR Rejection' => '38%',
                            'UV Rejection' => '99%',
                            'TSER' => '40%',
                        ],
                    ],
                    [
                        'name' => 'PLATINUM 60',
                        'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=900&q=80',
                        'description' => 'Platinum 60 di dukung dengan berbagai teknologi seperti sistem penolak panas, anti silau, anti korosi, membuat nyaman saat berkendara baik siang atau malam hari.',
                        'specifications' => [
                            'Color' => 'Black 60%',
                            'Vlt' => '20%',
                            'IR Rejection' => '57%',
                            'UV Rejection' => '99%',
                            'TSER' => '52%',
                        ],
                    ],
                    [
                        'name' => 'PLATINUM 80',
                        'image' => 'https://images.unsplash.com/photo-1617469767053-d3b523a0b982?auto=format&fit=crop&w=900&q=80',
                        'description' => 'Dapat menolak 99% sinar UV yang masuk ke dalam mobil, mencegah proses jamur dan melindungi interior mobil anda, juga dapat mencegah penuaan pada perabot rumah tangga.',
                        'specifications' => [
                            'Color' => 'Black 80%',
                            'Vlt' => '5%',
                            'IR Rejection' => '70%',
                            'UV Rejection' => '99%',
                            'TSER' => '58%',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'ice-view-premium',
                'name' => 'Ice View Premium',
                'image' => 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Hadir sebagai Produk unggulan kami, dengan teknologi nano ceramic, namun memiliki tolak panas yang lebih baik dari Ice View Platinum, memberikan kenyamanan yang maksimal.',
                'sub_products' => [
                    [
                        'name' => 'PREMIUM 40',
                        'image' => 'https://images.unsplash.com/photo-1617469767053-d3b523a0b982?auto=format&fit=crop&w=900&q=80',
                        'description' => '40% kendaaraan anda terbuat dari kaca. kemewahan warna hitam pada series premium dari kaca film Ice view membuat tampilan kendaraan anda semakin estetis,elegan, dan garang.',
                        'specifications' => [
                            'Color' => 'Obsidian Black',
                            'Vlt' => '34%',
                            'IR Rejection' => '92%',
                            'UV Rejection' => '100%',
                        ],
                    ],
                    [
                        'name' => 'PREMIUM 60',
                        'image' => 'https://images.unsplash.com/photo-1600661653561-629509216228?auto=format&fit=crop&w=900&q=80',
                        'description' => 'Mengandung formula nano ceramic yang tidak mengganggu sinyal radio, ponsel, Gps, dan tidak memblokir sistem frekuensi elektromagnetik. Pada kegelapan 60% memiliki lapisan antigores sehingga membuat kaca lebih jernih dan lebih bersih jika di tangani dengan baik juga.',
                        'specifications' => [
                            'Color' => 'Obsidian Black',
                            'Vlt' => '15%',
                            'IR Rejection' => '92%',
                            'UV Rejection' => '100%',
                        ],
                    ],
                    [
                        'name' => 'PREMIUM 80',
                        'image' => 'https://images.unsplash.com/photo-1616788494707-ec28f08d05a1?auto=format&fit=crop&w=900&q=80',
                        'description' => 'IRR 94% and UVR 99% yang membuat series premium pada Iceview memiliki penolak panas tinggi yang menjaga panas matahari tidak masuk ke dalam ruangan / kabin mobil.',
                        'specifications' => [
                            'Color' => 'Obsidian Black',
                            'Vlt' => '5%',
                            'IR Rejection' => '92%',
                            'UV Rejection' => '100%',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'super-clear',
                'name' => 'Super Clear',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Hadir dalam tingkat kecerahan 20% atau bisa disebut "clear". produk kami menawarkan tolak panas yang maksimal di angka 94%, namun dengan harga yang relatif lebih hemat.',
                'sub_products' => [
                    [
                        'name' => 'Super Clear 20%',
                        'image' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=900&q=80',
                        'description' => 'Membuat kendaaraan anda terlihat lebih baru dengan kejernihan yang luar biasa membantu menjaga warna dan kecemerlaangan kaca mobil anda, melindungi area yang rentan terhadap goresan, dan Teknologi lapisan bening ice view memberikan ketahanan yang sangat baik terhadap noda, cuaca, dan abrasi, membantu mempertahankan kualitas akhir ruang pamer mobil selama bertahun-tahun.',
                        'specifications' => [
                            'Color' => 'Obsidian Black',
                            'Vlt' => '70%',
                            'IR Rejection' => '98%',
                            'UV Rejection' => '100%',
                        ],
                    ],
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
        $dealers = User::where('role', 'user')->where('is_active', 1)->get();
        return view('pages.dealers', [
            'dealers' => $dealers,
        ]);
    }

    public function waranty(): View
    {
        return view('pages.waranty');
    }
}
