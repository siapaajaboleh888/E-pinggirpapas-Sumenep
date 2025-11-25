<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Kuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PemesananApiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:kuliner,id',
            'qty' => 'required|integer|min:1',
            'alamat_pengiriman' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($validated, $request) {
            $produk = Kuliner::findOrFail($validated['produk_id']);

            $nomorPesanan = strtoupper(Str::random(10));

            $pemesanan = Pemesanan::create([
                'user_id' => $request->user()->id,
                'produk_id' => $produk->id,
                'qty' => $validated['qty'],
                'total_harga' => $produk->harga * $validated['qty'],
                'status' => 'pending',
                'nomor_pesanan' => $nomorPesanan,
                'alamat_pengiriman' => $validated['alamat_pengiriman'],
                'catatan' => $validated['catatan'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'data' => $pemesanan,
            ], 201);
        });
    }

    public function track($nomor_pesanan)
    {
        $pemesanan = Pemesanan::where('nomor_pesanan', $nomor_pesanan)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $pemesanan,
        ]);
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        $pemesanan = Pemesanan::where('user_id', $request->user()->id)
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $pemesanan,
        ]);
    }
}
