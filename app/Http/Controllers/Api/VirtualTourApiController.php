<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Virtual;
use Illuminate\Http\Request;

class VirtualTourApiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        $virtualTours = Virtual::orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $virtualTours,
        ]);
    }

    public function show($id)
    {
        $virtualTour = Virtual::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $virtualTour,
        ]);
    }
}
