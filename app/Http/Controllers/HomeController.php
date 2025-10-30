<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Image;
use App\Models\Kuliner;
use App\Models\PaketWisata;
use App\Models\Pengurus;
use App\Models\Post;
use App\Models\Virtual;
use App\Models\Produk; // ✅ TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // ✅ TAMBAHKAN VARIABEL PRODUK
        $produk = Produk::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        // Paket Wisata
        $paketWisata = PaketWisata::latest()->take(6)->get();

        // ✅ PERBAIKAN: Union Query untuk Images
        $postsImages = Post::select('image', 'created_at', DB::raw("'post' as type"))
            ->whereNotNull('image')
            ->orderBy('created_at', 'desc');

        $kulinersImages = Kuliner::select('image', 'created_at', DB::raw("'kuliner' as type"))
            ->whereNotNull('image')
            ->orderBy('created_at', 'desc');

        // Union dan paginate dengan cara yang benar
        $images = $postsImages
            ->union($kulinersImages)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // ✅ PERBAIKAN: About biasanya single data
        $about = About::first(); // Atau About::latest()->first()

        // Blog terbaru
        $blogs = Post::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Kuliner
        $kuliners = Kuliner::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // ✅ PERBAIKAN: Limit pengurus
        $penguruses = Pengurus::latest()->take(8)->get();

        // ✅ PERBAIKAN: Gunakan DB facade konsisten
        $virtual = DB::table('virtuals')->get();
        // Atau lebih baik buat Model Virtual:
        // $virtual = Virtual::all();

        // ✅ KIRIM SEMUA VARIABEL KE VIEW
        return view('home.index', compact(
            'about',
            'blogs',
            'kuliners',
            'penguruses',
            'virtual',
            'images',
            'paketWisata',
            'produk' // ✅ TAMBAHKAN INI
        ));
    }
}
