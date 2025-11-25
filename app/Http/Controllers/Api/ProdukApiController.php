<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kuliner;
use Illuminate\Http\Request;

class ProdukApiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        $produk = Kuliner::query()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $produk,
        ]);
    }

    public function show($id)
    {
        $produk = Kuliner::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $produk,
        ]);
    }
}
