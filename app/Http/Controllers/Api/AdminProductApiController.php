<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminProductApiController extends Controller
{
    /**
     * Display a listing of products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);
        $search = $request->get('search');
        
        $query = Kuliner::query();
        
        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('text', 'LIKE', "%{$search}%");
            });
        }
        
        $products = $query->latest()->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    /**
     * Store a newly created product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'price' => 'required|numeric|min:0',
            'alamat' => 'nullable|string|max:500',
            'nomor_hp' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($data['title']) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('kuliners', $imageName, 'public');
            $data['image'] = $imageName;
        }
        
        $data['user_id'] = $request->user()->id;
        $data['published_at'] = now();
        
        $product = Kuliner::create($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dibuat',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Kuliner::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Update the specified product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $product = Kuliner::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'text' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'alamat' => 'nullable|string|max:500',
            'nomor_hp' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && Storage::disk('public')->exists('kuliners/' . $product->image)) {
                Storage::disk('public')->delete('kuliners/' . $product->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($data['title'] ?? $product->title) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('kuliners', $imageName, 'public');
            $data['image'] = $imageName;
        }
        
        $product->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diupdate',
            'data' => $product->fresh()
        ]);
    }

    /**
     * Remove the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Kuliner::findOrFail($id);
        
        // Delete image if exists
        if ($product->image && Storage::disk('public')->exists('kuliners/' . $product->image)) {
            Storage::disk('public')->delete('kuliners/' . $product->image);
        }
        
        $product->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ]);
    }
    
    /**
     * Upload product image
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request, $id)
    {
        $product = Kuliner::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Delete old image
        if ($product->image && Storage::disk('public')->exists('kuliners/' . $product->image)) {
            Storage::disk('public')->delete('kuliners/' . $product->image);
        }
        
        $image = $request->file('image');
        $imageName = time() . '_' . Str::slug($product->title) . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('kuliners', $imageName, 'public');
        
        $product->update(['image' => $imageName]);
        
        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diupload',
            'data' => [
                'image' => $imageName,
                'image_url' => $product->fresh()->image_url
            ]
        ]);
    }
}
