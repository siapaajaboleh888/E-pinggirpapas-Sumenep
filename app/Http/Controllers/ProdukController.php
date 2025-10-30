<?php

namespace App\Http\Controllers;

use App\Models\Kuliner; // Nanti bisa diganti ke Produk jika model sudah direname
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar semua produk garam
     */
    public function index()
    {
        $produk = Kuliner::with('user')
            ->orderBy('created_at', 'desc') // Produk terbaru dulu
            ->paginate(9); // Tampilkan 9 produk per halaman (bisa disesuaikan)

        return view('produk.index', compact('produk'));
    }

    /**
     * Menampilkan detail produk garam tertentu
     */
    public function show($id)
    {
        // Ambil produk yang dipilih
        $produk = Kuliner::findOrFail($id);

        // Ambil 3 produk lain sebagai rekomendasi (selain produk yang sedang dilihat)
        $produkLainnya = Kuliner::where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('produk.show', compact('produk', 'produkLainnya'));
    }
}
