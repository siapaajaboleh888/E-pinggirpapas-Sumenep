<section class="ftco-section ftco-no-pb ftco-no-pt">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				{{-- Alert Success --}}
				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="fa fa-check-circle"></i> {{ session('success') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif

				{{-- Alert Error --}}
				@if(session('error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="fa fa-exclamation-circle"></i> {{ session('error') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif

				{{-- Validation Errors --}}
				@if($errors->any())
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Terjadi kesalahan:</strong>
						<ul class="mb-0">
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif

				<div class="ftco-search d-flex justify-content-center">
					<div class="row">
						<div class="col-md-12 nav-link-wrap">
							<div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
								{{-- ✅ Ubah: Tiket Wisata → Pemesanan Garam --}}
								<a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">
									<i class="fa fa-shopping-cart"></i> Pesan Garam GFK
								</a>
								{{-- ✅ Ubah: Paket Travel → Lihat Katalog --}}
								<a class="nav-link" id="v-pills-2-tab" href="{{ route('produk.index') }}" role="tab" aria-controls="v-pills-2" aria-selected="false">
									<i class="fa fa-list"></i> Katalog Produk
								</a>
							</div>
						</div>
						<div class="col-md-12 tab-wrap">
							<div class="tab-content" id="v-pills-tabContent">
								<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
									{{-- ✅ Form dengan field yang sesuai database --}}
									<form action="{{ route('pemesanan.store') }}" method="POST" class="search-property-1">
										@csrf
										<div class="row no-gutters">
											{{-- ✅ Field: Pilih Produk Garam --}}
											<div class="col-md-12 d-flex">
												<div class="form-group p-4 border-0 w-100">
													<label for="produk_id">Pilih Produk Garam <span class="text-danger">*</span></label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-cube"></span></div>
														<select name="produk_id" id="produk_id" class="form-control @error('produk_id') is-invalid @enderror" required>
															<option value="">-- Pilih Produk Garam --</option>
															@if(isset($produks))
																@foreach($produks as $produk)
																	<option value="{{ $produk->id }}" 
																			data-price="{{ $produk->price }}"
																			{{ old('produk_id') == $produk->id ? 'selected' : '' }}>
																		{{ $produk->name }} - Rp {{ number_format($produk->price, 0, ',', '.') }}/{{ $produk->unit ?? 'kg' }}
																	</option>
																@endforeach
															@endif
														</select>
													</div>
													@error('produk_id')
														<small class="text-danger">{{ $message }}</small>
													@enderror
												</div>
											</div>

											{{-- ✅ Field: Nama Pemesan --}}
											<div class="col-md-6 d-flex">
												<div class="form-group p-4 border-0">
													<label for="nama_pemesan">Nama Lengkap <span class="text-danger">*</span></label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-user"></span></div>
														<input type="text" 
															   name="nama_pemesan" 
															   id="nama_pemesan"
															   class="form-control @error('nama_pemesan') is-invalid @enderror" 
															   placeholder="Nama Lengkap Anda"
															   value="{{ old('nama_pemesan') }}"
															   required>
													</div>
													@error('nama_pemesan')
														<small class="text-danger">{{ $message }}</small>
													@enderror
												</div>
											</div>

											{{-- ✅ Field: Email --}}
											<div class="col-md-6 d-flex">
												<div class="form-group p-4">
													<label for="email">Email <span class="text-danger">*</span></label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-envelope"></span></div>
														<input type="email" 
															   name="email" 
															   id="email"
															   class="form-control @error('email') is-invalid @enderror" 
															   placeholder="email@example.com"
															   value="{{ old('email') }}"
															   required>
													</div>
													@error('email')
														<small class="text-danger">{{ $message }}</small>
													@enderror
												</div>
											</div>

											{{-- ✅ Field: Telepon --}}
											<div class="col-md-6 d-flex">
												<div class="form-group p-4">
													<label for="telepon">Nomor Telepon <span class="text-danger">*</span></label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-phone"></span></div>
														<input type="tel" 
															   name="telepon" 
															   id="telepon"
															   class="form-control @error('telepon') is-invalid @enderror" 
															   placeholder="08xxxxxxxxxx"
															   value="{{ old('telepon') }}"
															   required>
													</div>
													@error('telepon')
														<small class="text-danger">{{ $message }}</small>
													@enderror
												</div>
											</div>

											{{-- ✅ Field: Jumlah (kg/ton) --}}
											<div class="col-md-6 d-flex">
												<div class="form-group p-4">
													<label for="jumlah">Jumlah Pesanan <span class="text-danger">*</span></label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-balance-scale"></span></div>
														<input type="number" 
															   name="jumlah" 
															   id="jumlah"
															   class="form-control @error('jumlah') is-invalid @enderror" 
															   placeholder="Jumlah (kg)"
															   value="{{ old('jumlah', 1) }}"
															   min="1"
															   required>
													</div>
													@error('jumlah')
														<small class="text-danger">{{ $message }}</small>
													@enderror
												</div>
											</div>

											{{-- ✅ Field: Alamat Pengiriman --}}
											<div class="col-md-12 d-flex">
												<div class="form-group p-4 w-100">
													<label for="alamat_pengiriman">Alamat Pengiriman <span class="text-danger">*</span></label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-map-marker"></span></div>
														<textarea name="alamat_pengiriman" 
																  id="alamat_pengiriman"
																  rows="3"
																  class="form-control @error('alamat_pengiriman') is-invalid @enderror" 
																  placeholder="Alamat lengkap dengan kecamatan, kota, kode pos"
																  required>{{ old('alamat_pengiriman') }}</textarea>
													</div>
													@error('alamat_pengiriman')
														<small class="text-danger">{{ $message }}</small>
													@enderror
												</div>
											</div>

											{{-- ✅ Field: Tanggal Pengiriman (Optional) --}}
											<div class="col-md-6 d-flex">
												<div class="form-group p-4">
													<label for="tanggal_pengiriman">Tanggal Pengiriman Diinginkan</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-calendar"></span></div>
														<input type="date" 
															   name="tanggal_pengiriman" 
															   id="tanggal_pengiriman"
															   class="form-control @error('tanggal_pengiriman') is-invalid @enderror"
															   value="{{ old('tanggal_pengiriman') }}"
															   min="{{ date('Y-m-d', strtotime('+1 day')) }}">
													</div>
													@error('tanggal_pengiriman')
														<small class="text-danger">{{ $message }}</small>
													@enderror
													<small class="text-muted">Kosongkan jika tidak ada preferensi khusus</small>
												</div>
											</div>

											{{-- ✅ Field: Catatan (Optional) --}}
											<div class="col-md-6 d-flex">
												<div class="form-group p-4">
													<label for="catatan">Catatan Tambahan</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-comment"></span></div>
														<textarea name="catatan" 
																  id="catatan"
																  rows="3"
																  class="form-control @error('catatan') is-invalid @enderror" 
																  placeholder="Catatan khusus (opsional)">{{ old('catatan') }}</textarea>
													</div>
													@error('catatan')
														<small class="text-danger">{{ $message }}</small>
													@enderror
												</div>
											</div>

											{{-- ✅ Estimasi Total Harga --}}
											<div class="col-md-12 d-flex">
												<div class="form-group p-4 w-100">
													<div class="alert alert-info">
														<strong>Estimasi Total Harga:</strong>
														<h4 class="mb-0 mt-2" id="total-harga">Rp 0</h4>
														<small class="text-muted">*Belum termasuk ongkos kirim</small>
													</div>
												</div>
											</div>

											{{-- ✅ Submit Button --}}
											<div class="col-md-12 d-flex">
												<div class="form-group d-flex w-100 border-0">
													<div class="form-field w-100 align-items-center d-flex">
														<button type="submit" class="align-self-stretch form-control btn btn-primary">
															<i class="fa fa-paper-plane"></i> Kirim Pemesanan
														</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

{{-- ✅ JavaScript untuk Auto-calculate Total Harga --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const produkSelect = document.getElementById('produk_id');
    const jumlahInput = document.getElementById('jumlah');
    const totalHargaDisplay = document.getElementById('total-harga');

    function calculateTotal() {
        const selectedOption = produkSelect.options[produkSelect.selectedIndex];
        const price = parseFloat(selectedOption.dataset.price) || 0;
        const quantity = parseInt(jumlahInput.value) || 0;
        const total = price * quantity;

        totalHargaDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Event listeners
    if (produkSelect && jumlahInput) {
        produkSelect.addEventListener('change', calculateTotal);
        jumlahInput.addEventListener('input', calculateTotal);

        // Calculate on page load if values exist
        if (produkSelect.value && jumlahInput.value) {
            calculateTotal();
        }
    }
});
</script>

{{-- ✅ CSS Tambahan (Optional) --}}
<style>
.form-field textarea {
    padding-left: 50px;
}
.form-field .icon {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    z-index: 1;
}
.alert {
    border-radius: 8px;
}
.text-danger {
    font-size: 0.875rem;
    margin-top: 0.25rem;
}
</style>