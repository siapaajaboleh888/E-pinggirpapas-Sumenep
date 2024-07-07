<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create()
    {
        return view('reservations.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_orang' => 'required|integer',
            'tanggal' => 'required|date',
            'nomor_telepon' => 'required|string|max:15',
        ]);

        Reservation::create($request->all());

        return redirect()->route('home')->with('success', 'Pemesanan tiket successfully.');
    }
}
