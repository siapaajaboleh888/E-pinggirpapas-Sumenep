<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PemesananController extends Controller
{
    /**
     * Display a listing of pemesanan (Admin)
     */
    public function index()
    {
        try {
            $pemesanans = Pemesanan::latest()->paginate(20);
            return view('admin.pemesanan.index', compact('pemesanans'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat data pemesanan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new pemesanan
     */
    public function create()
    {
        try {
            // Coba ambil produk dari database
            $produks = Produk::all();

            // Jika kosong, buat dummy data dengan 5 produk
            if ($produks->isEmpty()) {
                $produks = collect([
                    (object)[
                        'id' => 1,
                        'nama' => 'Garam Konsumsi Premium',
                        'harga' => 15000,
                        'deskripsi' => 'Garam murni berkualitas tinggi'
                    ],
                    (object)[
                        'id' => 2,
                        'nama' => 'Garam Fortifikasi Kelor (GFK)',
                        'harga' => 25000,
                        'deskripsi' => 'Garam + nutrisi daun kelor'
                    ],
                    (object)[
                        'id' => 3,
                        'nama' => 'Garam Industri',
                        'harga' => 8000,
                        'deskripsi' => 'Garam untuk kebutuhan industri'
                    ],
                    (object)[
                        'id' => 4,
                        'nama' => 'Garam SPA',
                        'harga' => 20000,
                        'deskripsi' => 'Garam khusus spa dan kecantikan'
                    ],
                    (object)[
                        'id' => 5,
                        'nama' => 'Garam Kasar',
                        'harga' => 10000,
                        'deskripsi' => 'Garam kasar untuk masak tradisional'
                    ]
                ]);
            }

            Log::info('Pemesanan Create - Total Produk: ' . $produks->count());

            return view('pemesanan.create', compact('produks'));
        } catch (\Exception $e) {
            Log::error('Error loading pemesanan form: ' . $e->getMessage());

            // Fallback dummy data
            $produks = collect([
                (object)[
                    'id' => 1,
                    'nama' => 'Garam Konsumsi Premium',
                    'harga' => 15000,
                    'deskripsi' => 'Garam murni berkualitas tinggi'
                ],
                (object)[
                    'id' => 2,
                    'nama' => 'Garam Fortifikasi Kelor (GFK)',
                    'harga' => 25000,
                    'deskripsi' => 'Garam + nutrisi daun kelor'
                ],
                (object)[
                    'id' => 3,
                    'nama' => 'Garam Industri',
                    'harga' => 8000,
                    'deskripsi' => 'Garam untuk kebutuhan industri'
                ],
                (object)[
                    'id' => 4,
                    'nama' => 'Garam SPA',
                    'harga' => 20000,
                    'deskripsi' => 'Garam khusus spa dan kecantikan'
                ],
                (object)[
                    'id' => 5,
                    'nama' => 'Garam Kasar',
                    'harga' => 10000,
                    'deskripsi' => 'Garam kasar untuk masak tradisional'
                ]
            ]);

            return view('pemesanan.create', compact('produks'));
        }
    }

    /**
     * Store a newly created pemesanan
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'alamat_pengiriman' => 'required|string',
            'produk_id' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|integer|min:0',
            'total_harga' => 'required|integer|min:0',
            'catatan' => 'nullable|string|max:1000'
        ], [
            'nama_pemesan.required' => 'Nama pemesan harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'telepon.required' => 'Nomor telepon harus diisi',
            'alamat_pengiriman.required' => 'Alamat pengiriman harus diisi',
            'produk_id.required' => 'Pilih produk terlebih dahulu',
            'jumlah.required' => 'Jumlah pesanan harus diisi',
            'jumlah.min' => 'Jumlah minimal 1 kg'
        ]);

        try {
            DB::beginTransaction();

            // Generate nomor pesanan unik
            $nomorPesanan = 'KGR-' . date('Ymd') . '-' . strtoupper(Str::random(6));

            // Cek apakah produk ada di database
            try {
                $produk = Produk::find($validated['produk_id']);
                $namaProduk = $produk ? $produk->nama : 'Produk #' . $validated['produk_id'];
            } catch (\Exception $e) {
                // Jika table produk belum ada, pakai nama default dengan 5 produk
                $produkNames = [
                    1 => 'Garam Konsumsi Premium',
                    2 => 'Garam Fortifikasi Kelor (GFK)',
                    3 => 'Garam Industri',
                    4 => 'Garam SPA',
                    5 => 'Garam Kasar'
                ];
                $namaProduk = $produkNames[$validated['produk_id']] ?? 'Garam KUGAR';
            }

            // Create pemesanan
            $pemesanan = Pemesanan::create([
                'nomor_pesanan' => $nomorPesanan,
                'nama_pemesan' => $validated['nama_pemesan'],
                'email' => $validated['email'],
                'telepon' => $validated['telepon'],
                'alamat_pengiriman' => $validated['alamat_pengiriman'],
                'produk_id' => $validated['produk_id'],
                'nama_produk' => $namaProduk,
                'jumlah' => $validated['jumlah'],
                'harga_satuan' => $validated['harga_satuan'],
                'total_harga' => $validated['total_harga'],
                'catatan' => $validated['catatan'] ?? null,
                'status' => 'pending',
            ]);

            DB::commit();

            Log::info('Pemesanan created successfully: ' . $nomorPesanan, [
                'id' => $pemesanan->id,
                'nomor_pesanan' => $pemesanan->nomor_pesanan,
                'total' => $pemesanan->total_harga
            ]);

            // Redirect ke halaman detail pesanan
            return redirect()
                ->route('pemesanan.show', $pemesanan->nomor_pesanan)
                ->with('success', 'Pesanan berhasil dibuat! Nomor pesanan Anda: ' . $nomorPesanan);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error creating pemesanan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Request data: ', $validated);

            return back()
                ->withInput()
                ->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified pemesanan
     */
    public function show($nomorPesanan)
    {
        try {
            $pemesanan = Pemesanan::where('nomor_pesanan', $nomorPesanan)->firstOrFail();
            return view('pemesanan.show', compact('pemesanan'));
        } catch (\Exception $e) {
            Log::error('Pemesanan not found: ' . $nomorPesanan);
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan');
        }
    }

    /**
     * Show the form for editing pemesanan (Admin)
     */
    public function edit($id)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($id);
            $produks = Produk::all();
            return view('admin.pemesanan.edit', compact('pemesanan', 'produks'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data pemesanan tidak ditemukan');
        }
    }

    /**
     * Update the specified pemesanan
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        try {
            $pemesanan = Pemesanan::findOrFail($id);
            $pemesanan->update($validated);
            return back()->with('success', 'Pemesanan berhasil diupdate');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupdate pemesanan: ' . $e->getMessage());
        }
    }

    /**
     * Update status pemesanan via AJAX
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($id);
            $pemesanan->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Quick action methods
     */
    public function confirm($id)
    {
        return $this->updateStatusQuick($id, 'confirmed', 'Pesanan dikonfirmasi');
    }

    public function process($id)
    {
        return $this->updateStatusQuick($id, 'processing', 'Pesanan sedang diproses');
    }

    public function ship($id)
    {
        return $this->updateStatusQuick($id, 'shipped', 'Pesanan dikirim');
    }

    public function deliver($id)
    {
        return $this->updateStatusQuick($id, 'delivered', 'Pesanan selesai');
    }

    public function cancel($id)
    {
        return $this->updateStatusQuick($id, 'cancelled', 'Pesanan dibatalkan');
    }

    /**
     * Helper method untuk update status
     */
    private function updateStatusQuick($id, $status, $message)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($id);
            $pemesanan->update(['status' => $status]);
            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupdate status');
        }
    }

    /**
     * Remove the specified pemesanan
     */
    public function destroy($id)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($id);
            $pemesanan->delete();
            return back()->with('success', 'Pemesanan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus pemesanan');
        }
    }

    /**
     * Export pemesanan data
     */
    public function export($format)
    {
        return back()->with('info', 'Export feature coming soon');
    }
}
