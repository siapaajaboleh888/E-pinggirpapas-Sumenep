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
            // Auto-fill user data if authenticated
            $defaultData = null;
            if (auth()->check()) {
                $user = auth()->user();
                $defaultData = [
                    'nama_pemesan' => $user->name,
                    'email' => $user->email,
                    'telepon' => $user->phone ?? '',
                ];
            }

            // Ambil produk dari sumber publik (Kuliner) agar sesuai halaman /produk
            $produks = \App\Models\Kuliner::published()
                ->latest()
                ->get()
                ->map(function ($k) {
                    return (object) [
                        'id' => $k->id,
                        'nama' => $k->nama,
                        'harga' => (int) $k->harga,
                        'deskripsi' => $k->deskripsi,
                        'satuan' => (string) ($k->satuan ?? 'unit'),
                    ];
                });

            // Jika kosong, fallback ke Produk admin atau dummy
            if ($produks->isEmpty()) {
                $adminProduks = Produk::all();
                if ($adminProduks->isNotEmpty()) {
                    $produks = $adminProduks->map(function ($p) {
                        return (object) [
                            'id' => $p->id,
                            'nama' => $p->nama,
                            'harga' => (int) $p->harga,
                            'deskripsi' => $p->deskripsi,
                            'satuan' => (string) ($p->satuan ?? 'unit'),
                        ];
                    });
                } else {
                    $produks = collect([
                        (object)['id' => 1, 'nama' => 'Garam Konsumsi Premium', 'harga' => 15000, 'deskripsi' => 'Garam murni berkualitas tinggi'],
                        (object)['id' => 2, 'nama' => 'Garam Fortifikasi Kelor (GFK)', 'harga' => 25000, 'deskripsi' => 'Garam + nutrisi daun kelor'],
                        (object)['id' => 3, 'nama' => 'Garam Industri', 'harga' => 8000, 'deskripsi' => 'Garam untuk kebutuhan industri'],
                        (object)['id' => 4, 'nama' => 'Garam SPA', 'harga' => 20000, 'deskripsi' => 'Garam khusus spa dan kecantikan'],
                        (object)['id' => 5, 'nama' => 'Garam Kasar', 'harga' => 10000, 'deskripsi' => 'Garam kasar untuk masak tradisional'],
                    ]);
                }
            }

            Log::info('Pemesanan Create - Total Produk (Kuliner/public): ' . $produks->count());

            return view('pemesanan.create', compact('produks', 'defaultData'));
        } catch (\Exception $e) {
            Log::error('Error loading pemesanan form: ' . $e->getMessage());

            // Fallback dummy data
            $produks = collect([
                (object)['id' => 1, 'nama' => 'Garam Konsumsi Premium', 'harga' => 15000, 'deskripsi' => 'Garam murni berkualitas tinggi'],
                (object)['id' => 2, 'nama' => 'Garam Fortifikasi Kelor (GFK)', 'harga' => 25000, 'deskripsi' => 'Garam + nutrisi daun kelor'],
                (object)['id' => 3, 'nama' => 'Garam Industri', 'harga' => 8000, 'deskripsi' => 'Garam untuk kebutuhan industri'],
                (object)['id' => 4, 'nama' => 'Garam SPA', 'harga' => 20000, 'deskripsi' => 'Garam khusus spa dan kecantikan'],
                (object)['id' => 5, 'nama' => 'Garam Kasar', 'harga' => 10000, 'deskripsi' => 'Garam kasar untuk masak tradisional'],
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
            'catatan' => 'nullable|string|max:1000',
            // Payment fields
            'payment_method' => 'required|in:bank_transfer,e_wallet,cod',
            'payment_channel' => 'required|string'
        ], [
            'nama_pemesan.required' => 'Nama pemesan harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'telepon.required' => 'Nomor telepon harus diisi',
            'alamat_pengiriman.required' => 'Alamat pengiriman harus diisi',
            'produk_id.required' => 'Pilih produk terlebih dahulu',
            'jumlah.required' => 'Jumlah pesanan harus diisi',
            'jumlah.min' => 'Jumlah minimal 1',
            'payment_method.required' => 'Pilih metode pembayaran',
            'payment_channel.required' => 'Pilih channel pembayaran'
        ]);

        try {
            DB::beginTransaction();

            // Generate nomor pesanan unik
            $nomorPesanan = 'KGR-' . date('Ymd') . '-' . strtoupper(Str::random(6));

            // Tentukan nama produk berdasarkan Kuliner publik; fallback ke Produk admin atau default
            $namaProduk = null;
            try {
                $k = \App\Models\Kuliner::find($validated['produk_id']);
                if ($k) {
                    $namaProduk = $k->nama;
                } else {
                    $p = Produk::find($validated['produk_id']);
                    $namaProduk = $p?->nama;
                }
            } catch (\Exception $e) {
                // abaikan; gunakan default di bawah
            }
            if (!$namaProduk) {
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
                // Payment fields
                'payment_method' => $validated['payment_method'],
                'payment_channel' => $validated['payment_channel'],
                'payment_status' => $validated['payment_method'] === 'cod' ? 'unpaid' : 'unpaid',
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
        try {
            $pemesanans = Pemesanan::latest()->get();
            
            // Perlakukan 'excel' sebagai CSV agar kompatibel tanpa library eksternal
            if ($format === 'excel' || $format === 'csv') {
                $filename = 'pemesanan_' . date('Y-m-d_His') . '.csv';
                $headers = [
                    'Content-Type' => 'text/csv; charset=UTF-8',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                    'Pragma' => 'no-cache',
                ];

                $callback = function() use ($pemesanans) {
                    $output = fopen('php://output', 'w');
                    // Tulis BOM agar Excel mendeteksi UTF-8
                    fwrite($output, "\xEF\xBB\xBF");

                    // Header row
                    fputcsv($output, [
                        'No',
                        'Nomor Pesanan',
                        'Tanggal',
                        'Nama Pemesan',
                        'Email',
                        'Telepon',
                        'Alamat',
                        'Produk',
                        'Jumlah',
                        'Harga Satuan',
                        'Total Harga',
                        'Status Pesanan',
                        'Metode Pembayaran',
                        'Channel Pembayaran',
                        'Status Pembayaran',
                        'Catatan'
                    ]);

                    // Data rows
                    foreach ($pemesanans as $index => $order) {
                        $nomor = '="' . ($order->nomor_pesanan ?? '-') . '"';
                        $tanggal = '="' . (optional($order->created_at)->format('d-m-Y H:i') ?? '-') . '"';
                        $telepon = $order->telepon ? ('="' . $order->telepon . '"') : '-';
                        $hargaSatuan = 'Rp ' . number_format((float)($order->harga_satuan ?? 0), 0, ',', '.');
                        $totalHarga = 'Rp ' . number_format((float)($order->total_harga ?? 0), 0, ',', '.');

                        fputcsv($output, [
                            $index + 1,
                            $nomor,
                            $tanggal,
                            $order->nama_pemesan ?? '-',
                            $order->email ?? '-',
                            $telepon,
                            $order->alamat_pengiriman ?? '-',
                            $order->nama_produk ?? ('Produk #' . $order->produk_id),
                            (int)($order->jumlah ?? 0),
                            $hargaSatuan,
                            $totalHarga,
                            ucfirst($order->status ?? 'pending'),
                            $order->payment_method_name ?? '-',
                            $order->payment_channel_name ?? '-',
                            ucfirst($order->payment_status ?? 'unpaid'),
                            $order->catatan ?? '-'
                        ]);
                    }

                    fclose($output);
                };

                return response()->stream($callback, 200, $headers);
            }

            return back()->with('error', 'Format export tidak didukung');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal export data: ' . $e->getMessage());
        }
    }

    /**
     * Mark payment as paid (Admin)
     */
    public function markPaid($id)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($id);
            $pemesanan->markAsPaid();
            return back()->with('success', 'Pembayaran ditandai sudah lunas');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupdate status pembayaran');
        }
    }

    /**
     * Mark payment as pending (Admin)
     */
    public function markPending($id)
    {
        try {
            $pemesanan = Pemesanan::findOrFail($id);
            $pemesanan->markAsPending();
            return back()->with('success', 'Pembayaran ditandai menunggu verifikasi');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupdate status pembayaran');
        }
    }
}
