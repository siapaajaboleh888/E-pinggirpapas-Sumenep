<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Image;
use App\Models\Kuliner;
use App\Models\PaketWisata;
use App\Models\Pengurus;
use App\Models\Post;
use App\Models\Virtual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $paketWisata = PaketWisata::all();
        // Ambil gambar terbaru dari tabel posts dan kuliners
        $postsImages = Post::select('image', 'created_at')
            ->orderBy('created_at', 'desc');

        $kulinersImages = Kuliner::select('image', 'created_at')
            ->orderBy('created_at', 'desc');

        // Gabungkan kedua query dan paginate
        $images = $postsImages->union($kulinersImages)->orderBy('created_at', 'desc')->paginate(12);
        // Mengambil data about
        $about = About::all();

        // Mengambil 3 blog terbaru
        $blogs = Post::orderBy('created_at', 'desc')->take(3)->get();

        // Mengambil semua data kuliner
        $kuliners = Kuliner::orderBy('created_at', 'desc')->take(6)->get();

        // Mengambil semua data pengurus
        $penguruses = Pengurus::all();
        $virtual = app('db')->table('virtuals')->get();

        return view('home.index', compact('about', 'blogs', 'kuliners', 'penguruses', 'virtual', 'images', 'paketWisata'));
    }
}
