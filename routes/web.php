<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Produk; // ✅ Gunakan 'Produk' bukan 'Product'
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PemesananController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan (Khusus Admin/Operator KUGAR)
     * Route: GET /pemesanan (pemesanan.index)
     */
    public function index()
    {
        // Ambil semua data pemesanan dengan eager loading
        $pemesanans = Pemesanan::with('produk') // ✅ Relasi 'produk'
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('pemesanan.index', compact('pemesanans'));
    }

    /**
     * Menampilkan form pemesanan
     * Route: GET /pemesanan/create (pemesanan.create)
     */
    public function create()
    {
        // Ambil produk Garam yang aktif
        $produks = Produk::where('status', 'active') // ✅ Model 'Produk'
            ->orderBy('name')
            ->get();

        // ✅ Kirim variabel $produks (bukan $products)
        return view('pemesanan.create', compact('produks'));
    }

    /**
     * Menyimpan data pemesanan GFK
     * Route: POST /pemesanan (pemesanan.store)
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id', // ✅ Tabel 'produks'
            'nama_pemesan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'alamat_pengiriman' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string|max:1000',
            'tanggal_pengiriman' => 'nullable|date|after:today'
        ], [
            'produk_id.required' => 'Produk harus dipilih',
            'produk_id.exists' => 'Produk tidak valid',
            'nama_pemesan.required' => 'Nama pemesan wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'telepon.required' => 'Nomor telepon wajib diisi',
            'alamat_pengiriman.required' => 'Alamat pengiriman wajib diisi',
            'jumlah.required' => 'Jumlah pesanan wajib diisi',
            'jumlah.min' => 'Jumlah minimal 1',
            'tanggal_pengiriman.after' => 'Tanggal pengiriman harus setelah hari ini'
        ]);

        try {
            DB::beginTransaction();

            // Ambil data produk
            $produk = Produk::findOrFail($validated['produk_id']); // ✅ Model 'Produk'

            // Hitung total harga
            $total_harga = $produk->price * $validated['jumlah'];

            // Generate nomor pesanan
            $nomor_pesanan = 'GFK-PO-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            // Simpan pemesanan
            $pemesanan = Pemesanan::create([
                'nomor_pesanan' => $nomor_pesanan,
                'produk_id' => $validated['produk_id'],
                'nama_pemesan' => $validated['nama_pemesan'],
                'email' => $validated['email'],
                'telepon' => $validated['telepon'],
                'alamat_pengiriman' => $validated['alamat_pengiriman'],
                'jumlah' => $validated['jumlah'],
                'harga_satuan' => $produk->price,
                'total_harga' => $total_harga,
                'catatan' => $validated['catatan'],
                'tanggal_pengiriman' => $validated['tanggal_pengiriman'] ?? now()->addDays(3),
                'status' => 'pending'
            ]);

            DB::commit();

            // Log untuk monitoring
            Log::info('Pemesanan GFK baru', [
                'nomor_pesanan' => $nomor_pesanan,
                'nama' => $validated['nama_pemesan'],
                'produk' => $produk->name,
                'total' => $total_harga
            ]);

            // Redirect dengan pesan sukses
            return redirect()
                ->route('pemesanan.create')
                ->with('success', 'Pemesanan berhasil! Nomor: ' . $nomor_pesanan);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error pemesanan GFK: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan detail pemesanan
     * Route: GET /pemesanan/{id} (pemesanan.show)
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::with('produk')->findOrFail($id);
        return view('pemesanan.show', compact('pemesanan'));
    }
}
