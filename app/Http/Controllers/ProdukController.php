<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // ✅ SUDAH BENAR: Import Facade Storage

class ProdukController extends Controller
{
    /**
     * ✅ Menampilkan daftar semua produk garam
     * FIXED: Menggunakan scope published() yang aman
     */
    public function index()
    {
        try {
            // Test koneksi database (opsional, untuk memastikan DB terhubung)
            DB::connection()->getPdo();

            Log::info('ProdukController@index dipanggil');

            // ✅ PRODUCTION READY: Hanya tampilkan produk yang sudah dipublish
            $produks = Kuliner::published()
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            Log::info('Jumlah produk ditemukan (termasuk yang tidak dipublikasi jika scope dihilangkan): ' . $produks->total());

            // Jika tidak ada produk, tetap tampilkan view dengan data kosong
            if ($produks->isEmpty()) {
                Log::warning('Tidak ada produk ditemukan di database');
            }

            return view('produk.index', compact('produks'));
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database Error di ProdukController@index', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'sql' => $e->getSql() ?? 'No SQL'
            ]);

            // Fallback dengan data kosong
            $produks = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12, 1);

            return view('produk.index', compact('produks'))
                ->with('error', 'Terjadi kesalahan koneksi database atau tabel produk belum siap. Silakan hubungi administrator.');
        } catch (\Exception $e) {
            Log::error('Error ProdukController@index', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Fallback dengan data kosong
            $produks = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12, 1);

            return view('produk.index', compact('produks'))
                ->with('error', 'Terjadi kesalahan umum saat memuat produk. Silakan coba lagi nanti.');
        }
    }

    /**
     * ✅ Menampilkan detail produk garam tertentu
     * FIXED: Menggunakan scope published()
     */
    public function show($id)
    {
        try {
            // Validasi ID harus numerik
            if (!is_numeric($id)) {
                Log::warning('ID produk tidak valid', ['id' => $id, 'type' => gettype($id)]);

                return redirect()->route('produk.index')
                    ->with('error', 'ID produk tidak valid');
            }

            Log::info('ProdukController@show dipanggil', ['id' => $id]);

            // Ambil produk berdasarkan ID, hanya yang sudah dipublikasi
            $produk = Kuliner::published()->findOrFail($id);

            Log::info('Produk ditemukan', [
                'id' => $produk->id,
                'title' => $produk->title,
                'nama' => $produk->nama,
                'image' => $produk->image,
                'image_url' => $produk->image_url
            ]);

            // Ambil produk lainnya (3 produk terbaru, exclude produk saat ini)
            $produkLainnya = Kuliner::where('id', '!=', $id)
                ->published()
                ->latest()
                ->take(3)
                ->get();

            Log::info('Produk lainnya ditemukan: ' . $produkLainnya->count());

            // ✅ CRITICAL: Variable name HARUS sesuai dengan view
            return view('produk.show', [
                'produk' => $produk,
                'produkLainnya' => $produkLainnya
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Produk tidak ditemukan atau tidak dipublikasi', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('produk.index')
                ->with('error', 'Produk yang Anda cari tidak ditemukan atau belum dipublikasikan');
        } catch (\Exception $e) {
            Log::error('Error ProdukController@show', [
                'id' => $id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('produk.index')
                ->with('error', 'Terjadi kesalahan saat memuat detail produk');
        }
    }

    /**
     * ✅ SEARCH FUNCTIONALITY
     * Bonus feature untuk mencari produk
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        try {
            $keyword = $request->input('q');

            if (empty($keyword)) {
                return redirect()->route('produk.index');
            }

            $produks = Kuliner::where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('text', 'LIKE', "%{$keyword}%");
            })
                ->published()
                ->latest()
                ->paginate(12);

            Log::info('Search produk', [
                'keyword' => $keyword,
                'results' => $produks->total()
            ]);

            return view('produk.index', compact('produks'))
                ->with('searchKeyword', $keyword);
        } catch (\Exception $e) {
            Log::error('Error ProdukController@search', [
                'error' => $e->getMessage()
            ]);

            return redirect()->route('produk.index')
                ->with('error', 'Terjadi kesalahan saat mencari produk');
        }
    }

    /**
     * ✅ DEBUG METHOD (Hapus di production!)
     * FIXED: Error 'Undefined type Storage' di baris 202
     * 
     * @param int|null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function debug($id = null)
    {
        try {
            if ($id) {
                $produk = Kuliner::find($id);

                if (!$produk) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Produk tidak ditemukan'
                    ], 404);
                }

                return response()->json([
                    'success' => true,
                    'data' => [
                        'raw_attributes' => $produk->getAttributes(),
                        'accessors' => [
                            'nama' => $produk->nama,
                            'deskripsi' => $produk->deskripsi,
                            'harga' => $produk->harga,
                            'satuan' => $produk->satuan,
                            'foto' => $produk->foto,
                            'image_url' => $produk->image_url,
                            'formatted_price' => $produk->formatted_price,
                            'whatsapp_link' => $produk->whatsapp_link,
                        ],
                        'image_checks' => [
                            'raw_image' => $produk->image,
                            'is_url' => filter_var($produk->image, FILTER_VALIDATE_URL),
                            // ✅ PERBAIKAN: Hapus backslash (\) karena sudah di-import di atas (use Illuminate\Support\Facades\Storage)
                            'storage_exists' => Storage::disk('public')->exists('kuliners/' . $produk->image),
                            'public_exists' => file_exists(public_path('assets/images/' . $produk->image)),
                        ]
                    ]
                ]);
            }

            // Debug all products
            $produks = Kuliner::latest()->take(5)->get();

            return response()->json([
                'success' => true,
                'total' => Kuliner::count(),
                'sample_data' => $produks->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'title' => $p->title,
                        'nama' => $p->nama,
                        'image' => $p->image,
                        'image_url' => $p->image_url,
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => explode("\n", $e->getTraceAsString())
            ], 500);
        }
    }
}
