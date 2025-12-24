<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Kuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Halaman Utama - e-Business Petambak Garam KUGAR
     */
    public function index()
    {
        $produkUnggulan = $this->getProduks();
        $stats = $this->getStats();
        $virtualTours = $this->getVirtualTours();

        return view('welcome', compact('produkUnggulan', 'stats', 'virtualTours'));
    }

    // ========================================
    // HELPER METHODS - SAFE DATA RETRIEVAL
    // ========================================

    private function getProduks()
    {
        try {
            return Kuliner::published()->latest()->take(6)->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getStats()
    {
        try {
            return [
                'total_produk' => Kuliner::published()->count(),
                'total_petambak' => 45,
                'area_tambak' => '40 Hektar',
                'produksi_tahunan' => '500 Ton',
                'total_pemesanan' => Pemesanan::count(),
            ];
        } catch (\Exception $e) {
            return [
                'total_produk' => 0, 'total_petambak' => 45, 'area_tambak' => '40 Hektar',
                'produksi_tahunan' => '500 Ton', 'total_pemesanan' => 0,
            ];
        }
    }

    private function getVirtualTours()
    {
        try {
            return \App\Models\Virtual::latest()->get();
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
            $pengurus = \App\Models\Pengurus::latest()->get();
        } catch (\Exception $e) {
            $about = null;
            $pengurus = collect();
        }

        return view('about', compact('about', 'pengurus'));
    }

    /**
     * Aktivitas Petambak Garam
     */
    public function activities()
    {
        try {
            $galeriAktivitas = \App\Models\Post::latest()->paginate(12);
            $virtualTours = \App\Models\Virtual::latest()->get();
        } catch (\Exception $e) {
            $galeriAktivitas = collect();
            $virtualTours = collect();
        }

        return view('activities', compact('galeriAktivitas', 'virtualTours'));
    }

    /**
     * Garam Fortifikasi Kelor (GFK)
     */
    public function garamFortifikasiKelor()
    {
        $manfaat = [
            ['icon' => '🌿', 'title' => 'Kaya Nutrisi', 'description' => 'Mengandung vitamin A, C, E, kalsium, dan zat besi dari daun kelor.'],
            ['icon' => '💪', 'title' => 'Meningkatkan Imunitas', 'description' => 'Antioksidan tinggi untuk menjaga daya tahan tubuh.'],
            ['icon' => '🧠', 'title' => 'Baik untuk Otak', 'description' => 'Mendukung perkembangan kognitif dan konsentrasi.'],
            ['icon' => '❤️', 'title' => 'Kesehatan Jantung', 'description' => 'Menjaga tekanan darah tetap stabil.'],
            ['icon' => '🦴', 'title' => 'Menguatkan Tulang', 'description' => 'Kaya kalsium untuk pertumbuhan tulang dan gigi.'],
            ['icon' => '🩸', 'title' => 'Mencegah Anemia', 'description' => 'Zat besi membantu pembentukan sel darah merah.'],
        ];

        return view('garam-fortifikasi-kelor', compact('manfaat'));
    }

    /**
     * Blue Economy - Pemberdayaan Berkelanjutan
     */
    public function blueEconomy()
    {
        $prinsip = [
            ['icon' => '🌊', 'title' => 'Keberlanjutan', 'description' => 'Metode produksi ramah lingkungan.', 'color' => 'primary'],
            ['icon' => '👥', 'title' => 'Pemberdayaan', 'description' => 'Memberdayakan 45+ petambak lokal.', 'color' => 'success'],
            ['icon' => '💡', 'title' => 'Inovasi', 'description' => 'Produk bernilai tambah seperti GFK.', 'color' => 'warning'],
            ['icon' => '📱', 'title' => 'Digitalisasi', 'description' => 'Pemasaran online yang efisien.', 'color' => 'info'],
        ];

        try {
            $blogs = \App\Models\Post::latest()->take(6)->get();
        } catch (\Exception $e) {
            $blogs = collect();
        }

        return view('blue-economy', compact('prinsip', 'blogs'));
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
