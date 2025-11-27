<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Virtual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminVirtualTourController extends Controller
{
    public function index()
    {
        $virtualTours = Virtual::orderBy('order')->orderByDesc('created_at')->paginate(10);
        return view('admin.virtual.index', compact('virtualTours'));
    }

    public function create()
    {
        return view('admin.virtual.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'string', 'max:255'],
            'thumbnail' => ['nullable', 'string', 'max:255'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/ogg', 'max:51200'], // max 50MB
            'is_active' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        // Upload video jika ada
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('virtual', 'public');
            $data['link'] = Storage::url($path);
        }

        if (empty($data['link'])) {
            return back()->withErrors(['link' => 'Isi link YouTube atau upload file video.'])->withInput();
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['order'] = $data['order'] ?? 0;

        Virtual::create($data);

        return redirect()->route('admin.virtual.index')->with('success', 'Virtual tour berhasil ditambahkan.');
    }

    public function edit(Virtual $virtual)
    {
        return view('admin.virtual.edit', [
            'virtualTour' => $virtual,
        ]);
    }

    public function update(Request $request, Virtual $virtual)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'string', 'max:255'],
            'thumbnail' => ['nullable', 'string', 'max:255'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/ogg', 'max:51200'],
            'is_active' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        // Upload video baru jika ada
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('virtual', 'public');
            $data['link'] = Storage::url($path);
        }

        if (empty($data['link']) && empty($virtual->link)) {
            return back()->withErrors(['link' => 'Isi link YouTube atau upload file video.'])->withInput();
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['order'] = $data['order'] ?? 0;

        $virtual->update($data);

        return redirect()->route('admin.virtual.index')->with('success', 'Virtual tour berhasil diperbarui.');
    }

    public function destroy(Virtual $virtual)
    {
        $virtual->delete();

        return redirect()->route('admin.virtual.index')->with('success', 'Virtual tour berhasil dihapus.');
    }
}
