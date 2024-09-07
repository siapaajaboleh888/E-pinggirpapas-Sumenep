<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model SchoolProfile
        $schoolProfiles = SchoolProfile::all();

        $sections = [
            'Sejarah Sekolah Alam' => $schoolProfiles->where('section', 'Sejarah Sekolah Alam')->first(),
            'Visi & Misi' => $schoolProfiles->where('section', 'Visi & Misi')->first(),
            'Kurikulum Pendidikan' => $schoolProfiles->where('section', 'Kurikulum Pendidikan')->first(),
        ];


        // Mengirim data ke view
        return view('sekolah.index', compact('sections'));
    }
}
