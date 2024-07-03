<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KulinerController extends Controller
{
    public function index()
    {
        $kuliner = Kuliner::with('user')->paginate(6);
        return view('home.kuliner', compact('kuliner'));
    }
}
