<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ContentApiController extends Controller
{
    public function about()
    {
        try {
            $about = \App\Models\About::first();
            $documents = \App\Models\Document::where('type', 'about')
                ->where('status', 'published')
                ->latest()
                ->get();
            $pengurus = \App\Models\Pengurus::latest()->get();
        } catch (\Exception $e) {
            $about = null;
            $documents = collect();
            $pengurus = collect();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'slug' => 'about',
                'title' => 'Tentang Kami',
                'about' => $about,
                'documents' => $documents,
                'pengurus' => $pengurus,
            ],
        ]);
    }

    public function blueEconomy()
    {
        $prinsip = [
            [
                'title' => 'Keberlanjutan Lingkungan',
                'description' => 'Metode produksi garam yang ramah lingkungan dan tidak merusak ekosistem pesisir Desa Pinggirpapas. Menjaga keseimbangan alam untuk generasi mendatang.',
                'icon' => '\ud83c\udf0a',
                'color' => 'primary',
            ],
            [
                'title' => 'Pemberdayaan Masyarakat',
                'description' => 'Memberdayakan 45+ petambak lokal dan meningkatkan kesejahteraan ekonomi masyarakat desa pesisir melalui program pelatihan dan pendampingan.',
                'icon' => '\ud83d\udc65',
                'color' => 'success',
            ],
            [
                'title' => 'Inovasi Produk',
                'description' => 'Mengembangkan produk bernilai tambah seperti Garam Fortifikasi Kelor (GFK) untuk meningkatkan ketahanan pangan dan nilai jual produk.',
                'icon' => '\ud83d\udca1',
                'color' => 'warning',
            ],
            [
                'title' => 'Digitalisasi e-Business',
                'description' => 'Pemanfaatan teknologi digital untuk pemasaran online dan distribusi produk ke seluruh Indonesia, membuka akses pasar lebih luas.',
                'icon' => '\ud83d\udcf1',
                'color' => 'info',
            ],
        ];

        try {
            $documents = \App\Models\Document::where('type', 'blue_economy')
                ->where('status', 'published')
                ->latest()
                ->get();

            $blogs = \App\Models\Post::where('category', 'blue-economy')
                ->orWhere('title', 'LIKE', '%blue economy%')
                ->where('status', 'published')
                ->latest()
                ->get();
        } catch (\Exception $e) {
            $documents = collect();
            $blogs = collect();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'slug' => 'blue-economy',
                'title' => 'Blue Economy',
                'prinsip' => $prinsip,
                'documents' => $documents,
                'blogs' => $blogs,
            ],
        ]);
    }

    public function gfk()
    {
        $manfaat = [
            [
                'icon' => '\ud83c\df3f',
                'title' => 'Kaya Nutrisi',
                'description' => 'Mengandung vitamin A, C, E, kalsium, dan zat besi dari daun kelor yang kaya manfaat untuk tubuh',
            ],
            [
                'icon' => '\ud83d\udcaa',
                'title' => 'Meningkatkan Imunitas',
                'description' => 'Antioksidan tinggi untuk menjaga daya tahan tubuh dan mencegah berbagai penyakit',
            ],
            [
                'icon' => '\ud83e\udde0',
                'title' => 'Baik untuk Otak',
                'description' => 'Omega-3 dan asam amino untuk perkembangan kognitif dan meningkatkan konsentrasi',
            ],
            [
                'icon' => '\u2764\ufe0f',
                'title' => 'Menjaga Kesehatan Jantung',
                'description' => 'Rendah sodium, cocok untuk diet sehat dan menjaga tekanan darah stabil',
            ],
            [
                'icon' => '\ud83e\uddb4',
                'title' => 'Menguatkan Tulang',
                'description' => 'Kalsium tinggi untuk kesehatan tulang dan gigi, mencegah osteoporosis',
            ],
            [
                'icon' => '\ud83d\udc89',
                'title' => 'Mencegah Anemia',
                'description' => 'Zat besi yang membantu pembentukan sel darah merah dan mencegah anemia',
            ],
        ];

        try {
            $produkGFK = \App\Models\Produk::where(function ($query) {
                $query->where('name', 'LIKE', '%GFK%')
                    ->orWhere('name', 'LIKE', '%fortifikasi%')
                    ->orWhere('name', 'LIKE', '%kelor%');
            })
                ->where('status', 'active')
                ->get();

            $artikelGFK = \App\Models\Post::where(function ($query) {
                $query->where('title', 'LIKE', '%garam%')
                    ->orWhere('title', 'LIKE', '%kelor%')
                    ->orWhere('title', 'LIKE', '%GFK%');
            })
                ->where('status', 'published')
                ->latest()
                ->get();
        } catch (\Exception $e) {
            $produkGFK = collect();
            $artikelGFK = collect();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'slug' => 'gfk',
                'title' => 'Garam Fortifikasi Kelor',
                'manfaat' => $manfaat,
                'produk_gfk' => $produkGFK,
                'artikel_gfk' => $artikelGFK,
            ],
        ]);
    }
}
