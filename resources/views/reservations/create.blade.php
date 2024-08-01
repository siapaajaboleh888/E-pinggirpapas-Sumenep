<section class="ftco-section ftco-no-pb ftco-no-pt">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
				@endif
				<div class="ftco-search d-flex justify-content-center">
					<div class="row">
						<div class="col-md-12 nav-link-wrap">
							<div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
								<a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Tiket Wisata</a>
								<a class="nav-link" id="v-pills-2-tab" href="https://www.youtube.com/" target="_blank" role="tab" aria-controls="v-pills-2" aria-selected="false">Paket Travel</a>
							</div>
						</div>
						<div class="col-md-12 tab-wrap">
							<div class="tab-content" id="v-pills-tabContent">
								<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
									<form action="{{ route('reservations.store') }}" method="POST" class="search-property-1">
										@csrf
										<div class="row no-gutters">
											<div class="col-md d-flex">
												<div class="form-group p-4 border-0">
													<label for="name">Nama</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-user"></span></div>
														<input type="text" name="name" class="form-control" placeholder="Nama" required>
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group p-4">
													<label for="total_orang">Total Tiket</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-users"></span></div>
														<input type="number" name="total_orang" class="form-control" placeholder="Jumlah Tiket" required>
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group p-4">
													<label for="tanggal">Tanggal</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-calendar"></span></div>
														<input type="date" name="tanggal" class="form-control" placeholder="Tanggal" required>
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group p-4">
													<label for="nomor_telepon">Nomor Telepon</label>
													<div class="form-field">
														<div class="icon"><span class="fa fa-phone"></span></div>
														<input type="tel" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon" required>
													</div>
												</div>
											</div>
											<div class="col-md d-flex">
												<div class="form-group d-flex w-100 border-0">
													<div class="form-field w-100 align-items-center d-flex">
														<input type="submit" value="Pesan Sekarang" class="align-self-stretch form-control btn btn-primary">
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