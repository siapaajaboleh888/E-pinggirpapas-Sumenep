<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Document;
use App\Models\Pengurus;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminContentApiController extends Controller
{
    /**
     * Get all content types overview
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $about = About::first();
        $documents = Document::count();
        $pengurus = Pengurus::count();
        $posts = Post::count();
        
        return response()->json([
            'success' => true,
            'data' => [
                'about' => $about ? true : false,
                'total_documents' => $documents,
                'total_pengurus' => $pengurus,
                'total_posts' => $posts,
            ]
        ]);
    }
    
    // ========================================
    // ABOUT MANAGEMENT
    // ========================================
    
    /**
     * Get about content
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAbout()
    {
        $about = About::first();
        
        if (!$about) {
            return response()->json([
                'success' => false,
                'message' => 'Konten tentang kami belum ada'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $about
        ]);
    }
    
    /**
     * Update about content
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $about = About::first();
        
        if ($about) {
            $about->update($data);
            $message = 'Konten tentang kami berhasil diupdate';
        } else {
            $about = About::create($data);
            $message = 'Konten tentang kami berhasil dibuat';
        }
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $about
        ]);
    }
    
    // ========================================
    // PENGURUS MANAGEMENT
    // ========================================
    
    /**
     * Get all pengurus
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPengurus(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);
        $pengurus = Pengurus::latest()->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $pengurus
        ]);
    }
    
    /**
     * Create new pengurus
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePengurus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|url',
            'bio' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $data['order'] = $data['order'] ?? Pengurus::max('order') + 1;
        
        $pengurus = Pengurus::create($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Pengurus berhasil ditambahkan',
            'data' => $pengurus
        ], 201);
    }
    
    /**
     * Update pengurus
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePengurus(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|required|string|max:255',
            'photo' => 'nullable|url',
            'bio' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $pengurus->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Pengurus berhasil diupdate',
            'data' => $pengurus->fresh()
        ]);
    }
    
    /**
     * Delete pengurus
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyPengurus($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        $pengurus->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Pengurus berhasil dihapus'
        ]);
    }
    
    // ========================================
    // DOCUMENTS MANAGEMENT
    // ========================================
    
    /**
     * Get all documents
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDocuments(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);
        $type = $request->get('type'); // about, blue_economy, etc.
        
        $query = Document::query();
        
        if ($type) {
            $query->where('type', $type);
        }
        
        $documents = $query->latest()->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $documents
        ]);
    }
    
    /**
     * Create new document
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeDocument(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:about,blue_economy,gfk,other',
            'file_url' => 'required|url',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $document = Document::create($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil ditambahkan',
            'data' => $document
        ], 201);
    }
    
    /**
     * Update document
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDocument(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:about,blue_economy,gfk,other',
            'file_url' => 'sometimes|required|url',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:draft,published',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $document->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil diupdate',
            'data' => $document->fresh()
        ]);
    }
    
    /**
     * Delete document
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyDocument($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil dihapus'
        ]);
    }
    
    // ========================================
    // POSTS/BLOG MANAGEMENT
    // ========================================
    
    /**
     * Get all posts
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPosts(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);
        $category = $request->get('category');
        $status = $request->get('status');
        
        $query = Post::query();
        
        if ($category) {
            $query->where('category', $category);
        }
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $posts = $query->latest()->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }
    
    /**
     * Create new post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category' => 'nullable|string',
            'featured_image' => 'nullable|url',
            'status' => 'required|in:draft,published',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $data['slug'] = Str::slug($data['title']);
        $data['author_id'] = $request->user()->id;
        
        $post = Post::create($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dibuat',
            'data' => $post
        ], 201);
    }
    
    /**
     * Update post
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'excerpt' => 'nullable|string',
            'category' => 'nullable|string',
            'featured_image' => 'nullable|url',
            'status' => 'sometimes|required|in:draft,published',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        
        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        $post->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Post berhasil diupdate',
            'data' => $post->fresh()
        ]);
    }
    
    /**
     * Delete post
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dihapus'
        ]);
    }
}
