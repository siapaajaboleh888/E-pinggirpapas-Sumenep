<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Virtual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminVirtualTourApiController extends Controller
{
    /**
     * Display a listing of virtual tours.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 15);
        $search = $request->get('search');
        
        $query = Virtual::query();
        
        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        $virtualTours = $query->orderBy('order', 'asc')
                             ->latest()
                             ->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $virtualTours
        ]);
    }

    /**
     * Store a newly created virtual tour.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'required|url',
            'thumbnail' => 'nullable|url',
            'is_active' => 'boolean',
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
        
        // Set default values
        $data['is_active'] = $data['is_active'] ?? true;
        $data['order'] = $data['order'] ?? Virtual::max('order') + 1;
        
        $virtualTour = Virtual::create($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Virtual tour berhasil dibuat',
            'data' => $virtualTour
        ], 201);
    }

    /**
     * Display the specified virtual tour.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $virtualTour = Virtual::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $virtualTour
        ]);
    }

    /**
     * Update the specified virtual tour.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $virtualTour = Virtual::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'sometimes|required|url',
            'thumbnail' => 'nullable|url',
            'is_active' => 'boolean',
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
        $virtualTour->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Virtual tour berhasil diupdate',
            'data' => $virtualTour->fresh()
        ]);
    }

    /**
     * Remove the specified virtual tour.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $virtualTour = Virtual::findOrFail($id);
        $virtualTour->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Virtual tour berhasil dihapus'
        ]);
    }
    
    /**
     * Toggle active status
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleActive($id)
    {
        $virtualTour = Virtual::findOrFail($id);
        $virtualTour->update([
            'is_active' => !$virtualTour->is_active
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diubah',
            'data' => $virtualTour->fresh()
        ]);
    }
    
    /**
     * Reorder virtual tours
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:virtuals,id',
            'orders.*.order' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        foreach ($request->orders as $item) {
            Virtual::where('id', $item['id'])
                  ->update(['order' => $item['order']]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Urutan berhasil diupdate'
        ]);
    }
}
