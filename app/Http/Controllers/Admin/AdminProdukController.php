<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kuliner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $produks = Produk::latest()->paginate(15);

        return view('admin.produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'harga' => ['required', 'numeric', 'min:0'],
            'satuan' => ['required', 'string', 'max:50'],
            'status' => ['required', 'in:tersedia,kosong'],
            'stok' => ['required', 'integer', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:2048'],
        ], [
            'nama.required' => 'Nama produk wajib diisi.',
            'harga.required' => 'Harga produk wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'satuan.required' => 'Satuan wajib diisi.',
            'status.in' => 'Status hanya boleh tersedia atau kosong.',
            'stok.integer' => 'Stok harus berupa angka.',
            'gambar.image' => 'File gambar tidak valid.',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['nama']);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produks', 'public');
        }

        $produk = Produk::create($validated);

        // Sinkronkan ke tabel kuliners agar tampil di halaman publik
        $this->upsertKulinerFromProduk($produk);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk): View
    {
        return view('admin.produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'harga' => ['required', 'numeric', 'min:0'],
            'satuan' => ['required', 'string', 'max:50'],
            'status' => ['required', 'in:tersedia,kosong'],
            'stok' => ['required', 'integer', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:2048'],
        ], [
            'nama.required' => 'Nama produk wajib diisi.',
            'harga.required' => 'Harga produk wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'satuan.required' => 'Satuan wajib diisi.',
            'status.in' => 'Status hanya boleh tersedia atau kosong.',
            'stok.integer' => 'Stok harus berupa angka.',
            'gambar.image' => 'File gambar tidak valid.',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['nama'], $produk->id);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('produks', 'public');
        }

        $produk->update($validated);

        // Sinkronkan perubahan ke tabel kuliners
        $this->upsertKulinerFromProduk($produk);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk): RedirectResponse
    {
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        // Hapus mirror di kuliners (berdasarkan title == nama)
        Kuliner::where('title', $produk->nama)->delete();

        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Generate unique slug for produk.
     */
    protected function generateUniqueSlug(string $nama, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($nama);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Produk::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }

    /**
     * Upsert data ke tabel kuliners agar produk admin tampil di halaman publik.
     */
    protected function upsertKulinerFromProduk(Produk $produk): void
    {
        // Siapkan data dasar
        $data = [
            'title' => $produk->nama,
            'text' => $produk->deskripsi ?? 'Garam berkualitas dari petambak lokal',
            'price' => (int) ($produk->harga ?? 0),
            'published_at' => now(),
        ];

        // Copy file gambar ke folder 'kuliners' agar accessor image_url menemukan file
        if (!empty($produk->gambar) && Storage::disk('public')->exists($produk->gambar)) {
            $basename = basename($produk->gambar);
            $targetPath = 'kuliners/' . $basename;
            if (!Storage::disk('public')->exists($targetPath)) {
                try {
                    Storage::disk('public')->copy($produk->gambar, $targetPath);
                } catch (\Exception $e) {
                    // Diamkan saja agar tidak gagal total; view akan fallback ke default image
                }
            }
            $data['image'] = $basename;
        }

        // Alamat & nomor hp default jika tidak ada (untuk tampilan publik)
        $data['alamat'] = 'Pinggir Papas, Sumenep';
        $data['nomor_hp'] = '081234567890';

        // Pastikan kolom user_id terisi (kolom ini non-nullable di DB)
        $data['user_id'] = Auth::id() ?: (int) (\App\Models\User::query()->value('id') ?? 1);

        // Upsert berdasarkan title (nama produk)
        $existing = Kuliner::where('title', $produk->nama)->first();
        if ($existing) {
            $existing->update($data);
        } else {
            Kuliner::create($data);
        }
    }
}

