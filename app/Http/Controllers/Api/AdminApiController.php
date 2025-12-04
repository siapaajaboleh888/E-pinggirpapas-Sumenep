<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\VirtualTour;
use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminApiController extends Controller
{
    /**
     * Display a listing of users with search & filter.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        $search = $request->get('search');
        $role = $request->get('role'); // Filter by role
        
        $query = User::select('id', 'name', 'email', 'phone', 'created_at', 'role');
        
        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter by role
        if ($role && in_array($role, ['user', 'admin', 'staff'])) {
            $query->where('role', $role);
        } else {
            // Default: don't show admin users (unless specifically requested)
            $query->where('role', '!=', 'admin');
        }
        
        $users = $query->latest()->paginate($perPage);
                    
        return response()->json([
            'success' => true,
            'message' => 'Users retrieved successfully',
            'data' => $users->items(),
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total()
        ]);
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin,staff',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dibuat',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        $user = User::select('id', 'name', 'email', 'created_at', 'role')
                    ->findOrFail($id);
                    
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8|confirmed',
            'role' => 'sometimes|in:user,admin,staff',
        ]);
        
        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }
        
        $user->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'User berhasil diupdate',
            'data' => $user->only(['id', 'name', 'email', 'role'])
        ]);
    }

    /**
     * Remove the specified user.
     */
    public function destroy(string $id)
    {
        // Cegah hapus diri sendiri
        if (Auth::id() == $id) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus akun sendiri'
            ], 403);
        }
        
        $user = User::findOrFail($id);
        $user->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }
    
    /**
     * Get all orders with pagination
     */
    public function orders(Request $request)
    {
        $status = $request->query('status');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        
        $query = Pesanan::with(['user:id,name', 'items.produk'])
                        ->latest();
        
        // Filter by status
        if ($status) {
            $query->where('status', $status);
        }
        
        // Filter by date range
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }
        
        $orders = $query->paginate(15);
        
        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }
    
    /**
     * Get order details
     */
    public function showOrder($id)
    {
        $order = Pesanan::with(['user:id,name,email,phone', 'items.produk'])
                       ->findOrFail($id);
                       
        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }
    
    /**
     * Update order status
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Pesanan::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,dikirim,selesai,dibatalkan',
            'catatan_admin' => 'nullable|string|max:1000'
        ]);
        
        $order->update($validated);
        
        // TODO: Kirim notifikasi ke user jika diperlukan
        
        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diupdate',
            'data' => $order->only(['id', 'nomor_pesanan', 'status'])
        ]);
    }
    
    /**
     * Get dashboard statistics
     */
    public function statistics()
    {
        try {
            // Total counts
            $totalUsers = User::where('role', 'user')->count();
            $totalAdmins = User::where('role', 'admin')->count();
            $totalProducts = Kuliner::count(); // Using Kuliner as product model
            
            // Orders statistics (if Pesanan table exists)
            $totalOrders = 0;
            $pendingOrders = 0;
            $processingOrders = 0;
            $completedOrders = 0;
            $cancelledOrders = 0;
            $revenueThisMonth = 0;
            $revenueTotal = 0;
            
            if (class_exists('App\Models\Pesanan')) {
                $totalOrders = Pesanan::count();
                $pendingOrders = Pesanan::where('status', 'menunggu')->count();
                $processingOrders = Pesanan::where('status', 'diproses')->count();
                $completedOrders = Pesanan::where('status', 'selesai')->count();
                $cancelledOrders = Pesanan::where('status', 'dibatalkan')->count();
                
                // Revenue this month
                $revenueThisMonth = Pesanan::where('status', 'selesai')
                                          ->whereMonth('created_at', now()->month)
                                          ->whereYear('created_at', now()->year)
                                          ->sum('total_harga');
                
                // Total revenue
                $revenueTotal = Pesanan::where('status', 'selesai')
                                      ->sum('total_harga');
            }
            
            // Virtual Tours statistics
            $totalVirtualTours = 0;
            if (class_exists('App\Models\VirtualTour')) {
                $totalVirtualTours = VirtualTour::count();
            }
            
            // Monthly revenue chart (last 6 months)
            $chartData = [];
            if (class_exists('App\Models\Pesanan')) {
                $monthlyRevenue = Pesanan::select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('MONTH(created_at) as month'),
                        DB::raw('SUM(total_harga) as total'),
                        DB::raw('COUNT(*) as count')
                    )
                    ->where('status', 'selesai')
                    ->where('created_at', '>=', now()->subMonths(6))
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'asc')
                    ->orderBy('month', 'asc')
                    ->get();
                
                $chartData = $monthlyRevenue->map(function($item) {
                    $monthName = date('M Y', mktime(0, 0, 0, $item->month, 1, $item->year));
                    return [
                        'month' => $monthName,
                        'revenue' => (float) $item->total,
                        'orders' => (int) $item->count
                    ];
                })->values();
            }
            
            // Recent users (last 5)
            $recentUsers = User::where('role', 'user')
                               ->latest()
                               ->take(5)
                               ->select('id', 'name', 'email', 'created_at')
                               ->get();
            
            // Recent products (last 5)
            $recentProducts = Kuliner::latest()
                                     ->take(5)
                                     ->select('id', 'title as nama', 'price as harga', 'created_at')
                                     ->get();
            
            // Product statistics
            $productStats = [
                'total' => $totalProducts,
                'average_price' => Kuliner::avg('price') ?? 0,
                'min_price' => Kuliner::min('price') ?? 0,
                'max_price' => Kuliner::max('price') ?? 0,
            ];
            
            return response()->json([
                'success' => true,
                'message' => 'Dashboard statistics retrieved successfully',
                'data' => [
                    // User statistics
                    'users' => [
                        'total' => $totalUsers,
                        'admins' => $totalAdmins,
                        'recent' => $recentUsers
                    ],
                    
                    // Product statistics
                    'products' => array_merge($productStats, [
                        'recent' => $recentProducts
                    ]),
                    
                    // Order statistics
                    'orders' => [
                        'total' => $totalOrders,
                        'pending' => $pendingOrders,
                        'processing' => $processingOrders,
                        'completed' => $completedOrders,
                        'cancelled' => $cancelledOrders
                    ],
                    
                    // Revenue statistics
                    'revenue' => [
                        'this_month' => (float) $revenueThisMonth,
                        'total' => (float) $revenueTotal,
                        'formatted_this_month' => 'Rp ' . number_format($revenueThisMonth, 0, ',', '.'),
                        'formatted_total' => 'Rp ' . number_format($revenueTotal, 0, ',', '.'),
                    ],
                    
                    // Virtual tours
                    'virtual_tours' => [
                        'total' => $totalVirtualTours
                    ],
                    
                    // Chart data
                    'charts' => [
                        'monthly_revenue' => $chartData
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get statistics: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Export orders to Excel/CSV
     */
    public function exportOrders(Request $request)
    {
        $validated = $request->validate([
            'format' => 'required|in:csv,xlsx',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);
        
        $query = Pesanan::with(['user:id,name', 'items.produk'])
                       ->where('status', 'selesai');
        
        if (!empty($validated['start_date']) && !empty($validated['end_date'])) {
            $query->whereBetween('created_at', [
                $validated['start_date'],
                $validated['end_date']
            ]);
        }
        
        $orders = $query->get();
        
        // Format data untuk export
        $exportData = [];
        
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $exportData[] = [
                    'Nomor Pesanan' => $order->nomor_pesanan,
                    'Tanggal' => $order->created_at->format('d/m/Y H:i'),
                    'Nama Pelanggan' => $order->user->name,
                    'Produk' => $item->produk->nama,
                    'Jumlah' => $item->jumlah,
                    'Harga Satuan' => $item->harga_satuan,
                    'Subtotal' => $item->subtotal,
                    'Total' => $order->total_harga,
                    'Status' => ucfirst($order->status),
                    'Metode Pembayaran' => $order->metode_pembayaran,
                    'Alamat Pengiriman' => $order->alamat_pengiriman
                ];
            }
        }
        
        $fileName = 'laporan-pesanan-' . now()->format('Y-m-d-H-i-s') . '.' . $validated['format'];
        $filePath = 'exports/' . $fileName;
        
        // Simpan file ke storage
        Storage::disk('public')->put($filePath, '');
        
        // TODO: Implementasi export ke format yang sesuai (CSV/Excel)
        // Untuk sementara kita kembalikan data JSON-nya dulu
        
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diekspor',
            'data' => $exportData,
            'download_url' => url('storage/' . $filePath)
        ]);
    }
    
    /**
     * Backup database
     */
    public function backupDatabase()
    {
        // Pastikan direktori backup ada
        $backupPath = storage_path('app/backups');
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }
        
        $fileName = 'backup-' . now()->format('Y-m-d-H-i-s') . '.sql';
        $filePath = $backupPath . '/' . $fileName;
        
        // Perintah untuk backup database MySQL
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.host'),
            config('database.connections.mysql.database'),
            $filePath
        );
        
        // Eksekusi perintah
        exec($command, $output, $returnVar);
        
        if ($returnVar !== 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan backup database'
            ], 500);
        }
        
        // Simpan ke storage
        $publicPath = 'backups/' . $fileName;
        Storage::disk('public')->put($publicPath, file_get_contents($filePath));
        
        // Hapus file sementara
        unlink($filePath);
        
        return response()->json([
            'success' => true,
            'message' => 'Backup database berhasil',
            'download_url' => url('storage/' . $publicPath)
        ]);
    }
}
