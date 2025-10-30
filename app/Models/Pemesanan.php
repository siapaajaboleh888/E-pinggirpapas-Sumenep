use App\Models\Pemesanan;

// Create dengan auto-generate nomor
$pemesanan = Pemesanan::create([
'produk_id' => $request->produk_id,
'nama_pemesan' => $request->nama_pemesan,
'email' => $request->email,
'telepon' => $request->telepon,
'alamat_pengiriman' => $request->alamat_pengiriman,
'jumlah' => $request->jumlah,
'harga_satuan' => $produk->price,
'total_harga' => $produk->price * $request->jumlah,
]);

// Query dengan scope
$pending = Pemesanan::pending()->get();
$today = Pemesanan::today()->get();
$search = Pemesanan::search('John')->get();

// Update status
$pemesanan->confirm();
$pemesanan->updateStatus('shipped');