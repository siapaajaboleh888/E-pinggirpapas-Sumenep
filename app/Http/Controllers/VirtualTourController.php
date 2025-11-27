<?php

namespace App\Http\Controllers;

use App\Models\Virtual;

class VirtualTourController extends Controller
{
    public function index()
    {
        $virtualTours = Virtual::where('is_active', true)
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('virtual.index', compact('virtualTours'));
    }

    public function show($id)
    {
        $tour = Virtual::where('is_active', true)->findOrFail($id);

        return view('virtual.show', compact('tour'));
    }
}
