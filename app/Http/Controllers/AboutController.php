<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Kuliner;
use App\Models\Pengurus;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::all();

        // Mengambil semua data pengurus
        $penguruses = Pengurus::all();

        return view('home.about', compact('about', 'penguruses'));
        // Mengambil data about
    }
}
