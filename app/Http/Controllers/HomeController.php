<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Halaman Utama - e-Business Petambak Garam KUGAR
     * Program Kosabangsa: Blue Economy & GFK Initiative
     */
    public function index()
    {
        $produkUnggulan = $this->getProduks();
        $categories = $this->getCategories();
        $stats = $this->getStats();
        $galeriAktivitas = $this->getGaleri();
        $virtualTours = $this->getVirtualTours();
        $about = $this->getAbout();
        $blogs = $this->getBlogs();
        $kulinerGaram = $this->getKuliners();
        $pengurus = $this->getPengurus();
        $paketWisata = $this->getPaketWisata();
        $virtual = $this->getVirtualTours();
        $kuliners = $this->getKuliners();
        $penguruses = $this->getPengurus();
        $images = $this->getImages();

        return view('welcome', compact(
            'produkUnggulan',
            'categories',
            'stats',
            'galeriAktivitas',
            'virtualTours',
            'about',
            'blogs',
            'kulinerGaram',
            'pengurus',
            'paketWisata',
            'virtual',
            'kuliners',
            'penguruses',
            'images'
        ));
    }

    // ========================================
    // HELPER METHODS - SAFE DATA RETRIEVAL
    // ========================================

    private function getProduks()
    {
        try {
            return Produk::where('status', 'active')
                ->latest()
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getCategories()
    {
        try {
            return \App\Models\Category::where('status', 'active')
                ->withCount('produks')
                ->take(4)
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getStats()
    {
        try {
            return [
                'total_produk' => Produk::where('status', 'active')->count(),
                'total_petambak' => 45,
                'area_tambak' => '40 Hektar',
                'produksi_tahunan' => '500 Ton',
                'total_pemesanan' => Pemesanan::count(),
            ];
        } catch (\Exception $e) {
            return [
                'total_produk' => 0,
                'total_petambak' => 45,
                'area_tambak' => '40 Hektar',
                'produksi_tahunan' => '500 Ton',
                'total_pemesanan' => 0,
            ];
        }
    }

    private function getGaleri()
    {
        try {
            return \App\Models\Post::select('image', 'created_at', 'title as caption')
                ->whereNotNull('image')
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getVirtualTours()
    {
        try {
            return \App\Models\Virtual::orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getAbout()
    {
        try {
            return \App\Models\About::all();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getBlogs()
    {
        try {
            return \App\Models\Post::where('status', 'published')
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getKuliners()
    {
        try {
            return \App\Models\Kuliner::orderBy('created_at', 'desc')
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getPengurus()
    {
        try {
            return \App\Models\Pengurus::latest()->take(8)->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getPaketWisata()
    {
        try {
            return \App\Models\PaketWisata::latest()->take(4)->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getImages()
    {
        try {
            return \App\Models\Image::latest()->paginate(12);
        } catch (\Exception $e) {
            return collect();
        }
    }

    // ========================================
    // PUBLIC PAGES - PROGRAM KOSABANGSA
    // ========================================

    /**
     * Tentang Program Kosabangsa & Blue Economy
     */
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

        return view('about', compact('about', 'documents', 'pengurus'));
    }

    /**
     * Aktivitas Petambak Garam - 6 Proses Utama
     */
    public function activities()
    {
        $activities = [
            [
                'title' => 'Pembuatan Petak Tambak',
                'description' => 'Proses persiapan lahan dan pembuatan petak kristalisasi garam yang optimal untuk produksi berkualitas tinggi. Dilakukan oleh petambak berpengalaman di Desa Pinggirpapas.',
                'image' => 'images/aktivitas/petak-tambak.jpg',
                'duration' => '2-3 hari',
                'icon' => 'fas fa-th-large'
            ],
            [
                'title' => 'Pengisian Air Laut',
                'description' => 'Pengisian air laut ke petak-petak tambak dengan kadar salinitas yang tepat menggunakan sistem pompa air. Proses ini sangat penting untuk kualitas kristal garam.',
                'image' => 'images/aktivitas/pengisian-air.jpg',
                'duration' => '1 hari',
                'icon' => 'fas fa-water'
            ],
            [
                'title' => 'Proses Kristalisasi',
                'description' => 'Penjemuran dan penguapan air laut secara alami dengan sinar matahari hingga terbentuk kristal garam berkualitas. Proses ini memakan waktu 7-10 hari tergantung cuaca.',
                'image' => 'images/aktivitas/kristalisasi.jpg',
                'duration' => '7-10 hari',
                'icon' => 'fas fa-sun'
            ],
            [
                'title' => 'Pemanenan Garam',
                'description' => 'Pengumpulan kristal garam yang sudah terbentuk sempurna dengan alat khusus. Petambak memanen garam dengan teknik tradisional yang terjaga kualitasnya.',
                'image' => 'images/aktivitas/panen.jpg',
                'duration' => '1-2 hari',
                'icon' => 'fas fa-hands'
            ],
            [
                'title' => 'Fortifikasi Kelor (GFK) - INOVASI!',
                'description' => 'Proses inovatif pencampuran garam dengan bubuk kelor untuk menghasilkan Garam Fortifikasi Kelor (GFK) yang kaya nutrisi. Ini adalah nilai tambah produk untuk ketahanan pangan.',
                'image' => 'images/aktivitas/fortifikasi.jpg',
                'duration' => '1 hari',
                'icon' => 'fas fa-leaf',
                'highlight' => true
            ],
            [
                'title' => 'Pengemasan & Quality Control',
                'description' => 'Pengemasan produk garam dengan standar kualitas dan kebersihan terjaga. Setiap produk melalui quality control ketat sebelum didistribusikan ke konsumen.',
                'image' => 'images/aktivitas/pengemasan.jpg',
                'duration' => '1 hari',
                'icon' => 'fas fa-box'
            ]
        ];

        try {
            $galeriAktivitas = \App\Models\Post::where('category', 'aktivitas-petambak')
                ->orWhere('status', 'published')
                ->latest()
                ->paginate(12);
            $virtualTours = \App\Models\Virtual::latest()->get();
        } catch (\Exception $e) {
            $galeriAktivitas = collect();
            $virtualTours = collect();
        }

        return view('activities', compact('activities', 'galeriAktivitas', 'virtualTours'));
    }

    /**
     * Garam Fortifikasi Kelor (GFK) - Inovasi Produk
     */
    public function garamFortifikasiKelor()
    {
        $manfaat = [
            [
                'icon' => '🌿',
                'title' => 'Kaya Nutrisi',
                'description' => 'Mengandung vitamin A, C, E, kalsium, dan zat besi dari daun kelor yang kaya manfaat untuk tubuh'
            ],
            [
                'icon' => '💪',
                'title' => 'Meningkatkan Imunitas',
                'description' => 'Antioksidan tinggi untuk menjaga daya tahan tubuh dan mencegah berbagai penyakit'
            ],
            [
                'icon' => '🧠',
                'title' => 'Baik untuk Otak',
                'description' => 'Omega-3 dan asam amino untuk perkembangan kognitif dan meningkatkan konsentrasi'
            ],
            [
                'icon' => '❤️',
                'title' => 'Menjaga Kesehatan Jantung',
                'description' => 'Rendah sodium, cocok untuk diet sehat dan menjaga tekanan darah stabil'
            ],
            [
                'icon' => '🦴',
                'title' => 'Menguatkan Tulang',
                'description' => 'Kalsium tinggi untuk kesehatan tulang dan gigi, mencegah osteoporosis'
            ],
            [
                'icon' => '🩸',
                'title' => 'Mencegah Anemia',
                'description' => 'Zat besi yang membantu pembentukan sel darah merah dan mencegah anemia'
            ]
        ];

        try {
            $produkGFK = Produk::where(function ($query) {
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
                ->take(3)
                ->get();
        } catch (\Exception $e) {
            $produkGFK = collect();
            $artikelGFK = collect();
        }

        return view('garam-fortifikasi-kelor', compact('manfaat', 'produkGFK', 'artikelGFK'));
    }

    /**
     * Blue Economy - Pemberdayaan Berkelanjutan
     */
    public function blueEconomy()
    {
        $prinsip = [
            [
                'title' => 'Keberlanjutan Lingkungan',
                'description' => 'Metode produksi garam yang ramah lingkungan dan tidak merusak ekosistem pesisir Desa Pinggirpapas. Menjaga keseimbangan alam untuk generasi mendatang.',
                'icon' => '🌊',
                'color' => 'primary'
            ],
            [
                'title' => 'Pemberdayaan Masyarakat',
                'description' => 'Memberdayakan 45+ petambak lokal dan meningkatkan kesejahteraan ekonomi masyarakat desa pesisir melalui program pelatihan dan pendampingan.',
                'icon' => '👥',
                'color' => 'success'
            ],
            [
                'title' => 'Inovasi Produk',
                'description' => 'Mengembangkan produk bernilai tambah seperti Garam Fortifikasi Kelor (GFK) untuk meningkatkan ketahanan pangan dan nilai jual produk.',
                'icon' => '💡',
                'color' => 'warning'
            ],
            [
                'title' => 'Digitalisasi e-Business',
                'description' => 'Pemanfaatan teknologi digital untuk pemasaran online dan distribusi produk ke seluruh Indonesia, membuka akses pasar lebih luas.',
                'icon' => '📱',
                'color' => 'info'
            ]
        ];

        try {
            $documents = \App\Models\Document::where('type', 'blue_economy')
                ->where('status', 'published')
                ->latest()
                ->paginate(10);

            $blogs = \App\Models\Post::where('category', 'blue-economy')
                ->orWhere('title', 'LIKE', '%blue economy%')
                ->where('status', 'published')
                ->latest()
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            $documents = collect();
            $blogs = collect();
        }

        return view('blue-economy', compact('documents', 'prinsip', 'blogs'));
    }

    /**
     * Halaman Kontak
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Submit Form Kontak
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'subject.required' => 'Subjek harus diisi',
            'message.required' => 'Pesan harus diisi',
        ]);

        try {
            \App\Models\Contact::create($validated);
            return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah terkirim. Tim KUGAR Pinggirpapas akan segera menghubungi Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi atau hubungi kami melalui WhatsApp.');
        }
    }

    /**
     * Halaman Galeri Foto Aktivitas Petambak
     */
    public function galeri()
    {
        try {
            $images = \App\Models\Image::latest()->paginate(24);
        } catch (\Exception $e) {
            $images = collect();
        }

        return view('galeri', compact('images'));
    }
}
