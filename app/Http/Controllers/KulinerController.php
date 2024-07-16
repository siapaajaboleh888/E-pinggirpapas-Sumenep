<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KulinerController extends Controller
{
    public function index()
    {
        $kuliner = Kuliner::with('user')->paginate(6);
        return view('home.kuliner', compact('kuliner'));
    }
    public function show($id)
    {
        $show = Kuliner::orderBy('created_at', 'desc')->take(3)->get();
        $kuli = Kuliner::findOrFail($id);

        return view('kuliner.show', compact('kuli', 'show'));
    }
}
