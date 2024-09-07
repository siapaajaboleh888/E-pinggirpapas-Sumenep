<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        // Ambil data dokumen terbaru dengan pagination (contoh 10 dokumen per halaman)
        $documents = Document::orderBy('created_at', 'desc')->paginate(5);

        // Kirim data dokumen ke view 'home'
        return view('sekolah.buku', compact('documents'));
    }
}
