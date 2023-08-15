
<div id="panduan">
	<?php { ?>
	<div class="card">
		<div class='row align-items-center m-4'>
			<div class='col-md'>
				<?php if ($_SESSION['Status'] === 'Dosen' && $_SESSION['Adminprodi']) { ?>
					<h2>Berikut Panduan Dalam Menggunakan Sistem Ini Untuk Admin Program Studi</h2>
					<section class="signup-step-container">
							<div class="container">
								<div class="row d-flex justify-content-center">
									<div class="col-md-12">
										<div class="wizard">
											<div class="wizard-inner">
												<div class="connecting-line"></div>
												<ul class="nav nav-tabs" role="tablist">
													<li role="presentation" class="active">
														<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">N</span> <i>Fitur Notifikasi</i></a>
													</li>
													<li role="presentation" class="disabled">
														<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">ICP</span> <i>Fitur Idea Concept Project</i></a>
													</li>
													<li role="presentation" class="disabled">
														<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">TA</span> <i>Fitur Tugas Akhir</i></a>
													</li>
													<li role="presentation" class="disabled">
														<a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">K</span> <i>Fitur Kegiatan Tugas Akhir</i></a>
													</li>
												</ul>
											</div>
							
											<form role="form" action="index.html" class="login-box">
												<div class="tab-content" id="main_form">
													<div class="tab-pane active" role="tabpanel" id="step1">
														<h4 class="text-left">- Fitur ini hanya untuk menerima pemberitahuan atau notifikasi</h4>
														<h4 class="text-left">- Fitur ini hanya dapat menghapus pesan yang masuk</h4>
														<h4 class="text-left">- Cara untuk menghapus yakni dengan menekan tombol delete jika ada pesan masuk</h4>

														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn next-step">Lanjut ke panduan ICP</button></li>
														</ul>
													</div>

													<div class="tab-pane active" role="tabpanel" id="step2">
													<ol>
														<h4 class="text-left">Fitur ini digunakan Admin Prodi/Pokil untuk menerima ICP dan menentukan dosen pembimbing dari mahasiswa</h4>
														<li class="text-left">ICP Mahasiswa dapat lebih dari satu</li>
														<li class="text-left">Review ICP secara manual</li>
														<li class="text-left">Memberikan catatan untuk mahasiswa tersebut</li>
														<li class="text-left">Memilih dosen pembimbing yang sudah terdaftar dalam sistem</li>
														<li class="text-left">Klik Pilih</li>
														<li class="text-left">Dapat memilih untuk menerima atau menolak ICP</li>
														<li class="text-left">Jika menolak, notifikasi menolak akan masuk ke akun mahasiswa tersebut. Dan jika diterima, nama mahasiswa di halaman ICP akan hilang dan akan muncul di fitur tugas akhir</li>
													</ol>															
														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn prev-step">Kembali</button></li>
															<li><button type="button" class="default-btn next-step">Lanjut ke Panduan Tugas Akhir</button></li>
														</ul>
													</div>

													<div class="tab-pane" role="tabpanel" id="step3">
													<ol>
														<h4 class="text-left">Fitur ini digunakan Admin Prodi/Pokil untuk melihat progress Tugas Akhir Mahasiswa</h4>
														<li class="text-left">Tugas Akhir disajikan berupa tabel</li>
														<li class="text-left">Dapat melihat nama mahasiswa dan dosen pembimbingnya</li>
														<li class="text-left">Dapat melihat progress proposal dan tugas akhir</li>
														<li class="text-left">Ketika proposal atau tugas akhir sudah di acc oleh dosen pembimbing, maka pada kolom akan ada gambar centang. Ketika masih kosong artinya belum di acc</li>
														<li class="text-left">File proposal atau tugas akhir dapat di download secara langsung ketika tombol unduh pada kolom proposal atau tugas akhir sudah berwarna biru</li>
														<li class="text-left">Detail progress tugas akhir juga dapat dilihat dengan menekan nama mahasiswa atau dosen pembimbing</li>
													</ol>
														
														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn prev-step">Kembali</button></li>
															<li><button type="button" class="default-btn next-step">Lanjut ke Panduan Kegiatan TA</button></li>
														</ul>
													</div>
													<div class="tab-pane" role="tabpanel" id="step4">
													<ol>
														<h4 class="text-left">Fitur ini digunakan Admin Prodi/Pokil untuk mengirimkan pemberitahuan atau informasi sebagai pengingat Kegiatan Tugas Akhir Mahasiswa</h4>
														<li class="text-left">Dapat berupa pengingat untuk deadline pengumpulan atau pemberitahuan untuk seminar atau sidang tugas akhir</li>
														<li class="text-left">Mengisi tempat, tanggal, dan waktu kegiatan</li>
														<li class="text-left">Memilih mahasiswa yang ditujukan (dapat satu atau lebih)</li>
														<li class="text-left">Memilih tombol kirim</li>
													</ol>
																												
														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn prev-step">Kembali</button></li>
															<li><button type="button" class="default-btn next-step">Selesai</button></li>
														</ul>
													</div>
													<div class="clearfix"></div>
												</div>
												
											</form>
										</div>
									</div>
								</div>
							</div>
					</section>
				<?php }

				elseif ($_SESSION['Status'] === 'Dosen') { ?>
				<h2>Berikut Panduan Dalam Menggunakan Sistem Ini Untuk Dosen</h2>
					<section class="signup-step-container">
							<div class="container">
								<div class="row d-flex justify-content-center">
									<div class="col-md-12">
										<div class="wizard">
											<div class="wizard-inner">
												
												<ul class="nav nav-tabs" role="tablist">

													<li role="presentation" class="active">
														<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">N</span> <i>Fitur Notifikasi</i></a>
													</li>
													
													<li role="presentation" class="disabled">
														<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"><span class="round-tab">TA</span> <i>Fitur Tugas Akhir</i></a>
													</li>
													
												</ul>
											</div>
							
											<form role="form" action="index.html" class="login-box">
												<div class="tab-content" id="main_form">
													<div class="tab-pane active" role="tabpanel" id="step1">
														<h4 class="text-left">- Fitur ini hanya untuk menerima pemberitahuan atau notifikasi</h4>
														<h4 class="text-left">- Fitur ini hanya dapat menghapus pesan yang masuk</h4>
														<h4 class="text-left">- Cara untuk menghapus yakni dengan menekan tombol delete jika ada pesan masuk</h4>

														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn next-step">Lanjut ke panduan Tugas Akhir</button></li>
														</ul>
													</div>												
													<div class="tab-pane" role="tabpanel" id="step2">
													<ol>
														<h5 class="text-left">Fitur ini digunakan Dosen Pembimbing untuk melakukan proses bimbingan Tugas Akhir</h5>
														<li class="text-left">Data Tugas Akhir disajikan berupa tabel dan dapat melihat nama mahasiswa dan dosen pembimbingnya</li>
														<li class="text-left">Tugas Akhir tersedia ketika mahasiswa sudah diterima ICPnya dan sudah ditentukan dosen pembimbingnya oleh Jurusan</li>
														<li class="text-left">Proses Tugas Akhir diawali dengan mahasiswa mengerjakan proposal</li>
														<li class="text-left">File proposal atau tugas akhir dapat di download secara langsung ketika tombol unduh pada kolom proposal atau tugas akhir sudah berwarna biru (sudah menggunggah)</li>
														<li class="text-left">Proses bimbingan dilakukan dengan memilih tombol nama mahasiswa bimbingan kemudian akan muncul detail dari mahasiswa tersebut</li>
														<li class="text-left">Untuk pemilihan tombol nama dosen akan memunculkan detail dosen yang isinya kolom data mahasiswa yang dibimbing</li>
														<li class="text-left">Dosen pembimbing dapat mengunduh dan memberi catatan kepada mahasiswa bimbingan dengan mengisi kolom catatan bimbingan dan mengunggah file yang akan direvisi</li>
														<li class="text-left">Dosen pembimbing dapat mengunduh dan memberi catatan kepada mahasiswa bimbingan dengan mengisi kolom catatan bimbingan dan mengunggah file yang akan direvisi</li>
														<li class="text-left">Catatan akan otomatis masuk ke kolom kartu bimbingan yang akan direkapitulasi oleh sistem, pengguna cukup pilih tombol cetak untuk melihat keseluruhan bimbingan</li>
														<li class="text-left">Pembimbing dapat memilih tombol "Menyetujui Proposal" ketika hendak acc proposal mahasiswa bimbingannya</li>
														<li class="text-left">Ketika proposal atau tugas akhir sudah di acc oleh dosen pembimbing, maka pada kolom akan ada gambar centang. Ketika masih kosong artinya belum di acc</li>
														<li class="text-left">Setelah proses proposal selesai, akan mengulang proses yang sama dari poin 3 untuk pengerjaan Tugas Akhir sampai pada tahap "Menyetujui Tugas Akhir"</li>
													</ol>
														
														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn prev-step">Kembali</button></li>
															<li><button type="button" class="default-btn next-step">Selesai</button></li>
														</ul>
													</div>
													
													<div class="clearfix"></div>
												</div>
												
											</form>
										</div>
									</div>
								</div>
							</div>
					</section>
				<?php }

				elseif ($_SESSION['Status'] === 'Mahasiswa' || $_SESSION['Status'] === 'TugasAkhir') { ?>
				<h2>Berikut Panduan Dalam Menggunakan Sistem Ini Untuk Mahasiswa</h2>
					<section class="signup-step-container">
							<div class="container">
								<div class="row d-flex justify-content-center">
									<div class="col-md-12">
										<div class="wizard">
											<div class="wizard-inner">
												<div class="list-inline" class=""></div>
												<ul class="nav nav-tabs" role="tablist">
													<li role="presentation" class="active">
														<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">N</span> <i>Fitur Notifikasi</i></a>
													</li>
													<li role="presentation" class="disabled">
														<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">ICP</span> <i>Fitur Idea Concept Project</i></a>
													</li>
													<li role="presentation" class="disabled">
														<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">TA</span> <i>Fitur Tugas Akhir</i></a>
													</li>
												</ul>
											</div>
							
											<form role="form" action="index.html" class="login-box">
												<div class="tab-content" id="main_form">
													<div class="tab-pane active" role="tabpanel" id="step1">
														<h4 class="text-left">- Fitur ini hanya untuk menerima pemberitahuan atau notifikasi</h4>
														<h4 class="text-left">- Fitur ini hanya dapat menghapus pesan yang masuk</h4>
														<h4 class="text-left">- Cara untuk menghapus yakni dengan menekan tombol delete jika ada pesan masuk</h4>

														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn next-step">Lanjut ke panduan ICP</button></li>
														</ul>
													</div>

													<div class="tab-pane active" role="tabpanel" id="step2">
													<ol>
														<h4 class="text-left">Fitur ini digunakan Mahasiswa untuk mengerjakan ICP yang akan diajukan ke Jurusan</h4>
														<li class="text-left">Mahasiswa mengisi latar belakang / mengunggah file ICP yang akan diajukan</li>
														<li class="text-left">Mahasiswa mengisi judul tugas akhir yang akan diajukan</li>
														<li class="text-left">Memilih tombol Kirim</li>
														<li class="text-left">History pengiriman dapat dilihat di bawah kolom</li>
														<li class="text-left">Mahasiswa menunggu feedback dari Jurusan apakah ICP diterima atau ditolak</li>
														<li class="text-left">Selalu cek notifikasi untuk pemberitahuan penerimaan ICP</li>
														<li class="text-left">Jika ICP sudah di acc Jurusan, fitur ini akan terdisable otomatis dan dapat dilanjutkan ke fitur Tugas Akhir</li>
													</ol>	
																										
														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn prev-step">Kembali</button></li>
															<li><button type="button" class="default-btn next-step">Lanjut ke Panduan Tugas Akhir</button></li>
														</ul>
													</div>

													<div class="tab-pane" role="tabpanel" id="step3">
													<ol>
														<h4 class="text-left">Fitur ini digunakan Mahasiswa untuk mengerjakan Proposal dan Tugas Akhir</h4><br>

														<h5 class="text-left">Tahap Proposal</h5>
														<li class="text-left">Mahasiwa mengunggah proposal berbentuk PDF</li>
														<li class="text-left">Menunggu catatan bimbingan dari dosen pembimbing</li>
														<li class="text-left">Mahasiswa dapat mencetak kartu bimbingan dengan memilih tombol Cetak</li>
														<li class="text-left">Menunggu proposal di acc oleh dosen pembimbing</li>
														<li class="text-left">Jika proposal sudah di acc, mahasiswa dapat ke tahap selanjutnya</li>
													</ol>
													<ol>
														<br><h5 class="text-left">Tahap Tugas Akhir</h5>
														<li class="text-left">Mahasiwa mengunggah tugas akhir berbentuk PDF</li>
														<li class="text-left">Menunggu catatan bimbingan dari dosen pembimbing</li>
														<li class="text-left">Mahasiswa dapat mencetak kartu bimbingan dengan memilih tombol Cetak</li>
														<li class="text-left">Menunggu tugas akhir di acc oleh dosen pembimbing</li>
													</ol>	
														
														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn prev-step">Kembali</button></li>
															<li><button type="button" class="default-btn next-step">Selesai</button></li>
														</ul>
													</div>
													
													<div class="clearfix"></div>
												</div>
												
											</form>
										</div>
									</div>
								</div>
							</div>
					</section>
				<?php }

				elseif ($_SESSION['Status'] === 'Admin') { ?>
				<h2>Berikut Panduan Dalam Menggunakan Sistem Ini Untuk Admin User/Pengguna</h2>
					<section class="signup-step-container">
							<div class="container">
								<div class="row d-flex justify-content-center">
									<div class="col-md-12">
										<div class="wizard">
											<div class="wizard-inner">
												<div class="connecting-line"></div>
												<ul class="nav nav-tabs" role="tablist">
													<li role="presentation" class="active">
														<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">B</span> <i>Fitur pada Beranda</i></a>
													</li>
													<li role="presentation" class="disabled">
														<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">M</span> <i>Fitur Mahasiswa</i></a>
													</li>
													<li role="presentation" class="disabled">
														<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">D</span> <i>Fitur Dosen</i></a>
													</li>
													<li role="presentation" class="disabled">
														<a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">P</span> <i>Fitur Pengaturan</i></a>
													</li>
												</ul>
											</div>
							
											<form role="form" action="index.html" class="login-box">
												<div class="tab-content" id="main_form">
													<div class="tab-pane active" role="tabpanel" id="step1">
														<ol>
														<h4 class="text-left">Fitur ini digunakan Admin untuk menambah data Program Studi dan Bidang Minat</h4>
														<li class="text-left">Admin harus menambah data program studi dan bidang minat terlebih dahulu sebelum menambah data mahasiswa dan dosen</li>
														<li class="text-left">Pilih tombol tambah Program Studi</li>
														<li class="text-left">Masukkan ID Program Studi dan Nama Program Studi</li>
														<li class="text-left">Pilih tombol Simpan</li>
														<li class="text-left">Pilih tombol tambah Bidang Minat</li>
														<li class="text-left">Masukkan ID Bidang Minat, Nama Bidang Minat, dan Pilih Program Studi yang sudah ditambahkan sebelumnya</li>
														<li class="text-left">Pilih tombol Simpan</li>
														<li class="text-left">Tabel data program studi dan bidang minat dapat dilihat pada kolom</li>
													</ol>															
														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn prev-step">Kembali</button></li>
															<li><button type="button" class="default-btn next-step">Lanjut ke Panduan Mahasiswa</button></li>
														</ul>
													</div>

													<div class="tab-pane" role="tabpanel" id="step2">
													<ol>
														<h4 class="text-left">Fitur ini digunakan Admin untuk melihat dan menambah data Mahasiswa</h4>
														<li class="text-left">Tidak ada fitur registrasi mahasiswa, semua akun dibuat oleh Admin</li>
														<li class="text-left">Admin dapat menambahkan data mahasiswa dengan mengisi form di Tambah Mahasiswa yakni NPM, Nama, Program Studi, Bidang Minat, dan Email</li>
														<li class="text-left">Pilih tombol Tambah</li>
														<li class="text-left">Password default akun yang ditambahkan adalah '12345'</li>
														<li class="text-left">Pada kolom Status masih tertulis "Mahasiswa". Ini artinya pada aktor mahasiswa belum aktif dan belum dapat mengerjakan ICP</li>
														<li class="text-left">Admin harus mengubah Status menjadi "TugasAkhir" dengan klik kanan open in new tab</li>
														<li class="text-left">Jika Status sudah menjadi "Tugas Akhir", maka mahasiswa dapat memulai pengerjaan ICP</li>
													</ol>
														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn prev-step">Kembali</button></li>
															<li><button type="button" class="default-btn next-step">Lanjut ke Panduan Dosen</button></li>
														</ul>
													</div>

													<div class="tab-pane active" role="tabpanel" id="step3">
													<ol>
														<h4 class="text-left">Fitur ini digunakan Admin untuk melihat dan menambah data Dosen</h4>
														<li class="text-left">Tidak ada fitur registrasi dosen, semua akun dibuat oleh Admin</li>
														<li class="text-left">Admin dapat menambahkan data mahasiswa dengan mengisi form di Tambah Mahasiswa yakni NIP, Nama, Program Studi, Bidang Minat, dan Email</li>
														<li class="text-left">Pilih tombol Tambah</li>
													</ol>															
														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn prev-step">Kembali</button></li>
															<li><button type="button" class="default-btn next-step">Lanjut ke Pengaturan</button></li>
														</ul>
													</div>

													<div class="tab-pane" role="tabpanel" id="step4">
													<ol>
														<h4 class="text-left">Fitur ini digunakan Admin untuk mengganti password</h4>
														<li class="text-left">Mengisi ID dari admin</li>
														<li class="text-left">Masukkan password yang lama</li>
														<li class="text-left">Masukkan password yang baru</li>
														<li class="text-left">Memilih tombol Simpan</li>
													</ol>						
														<ul class="list-inline pull-right">
															<li><button type="button" class="default-btn prev-step">Kembali</button></li>
															<li><button type="button" class="default-btn next-step">Selesai</button></li>
														</ul>
													</div>
													<div class="clearfix"></div>
												</div>
												
											</form>
										</div>
									</div>
								</div>
							</div>
					</section>
				<?php } ?>

			</div>
			
			<div class='col-md-3'>
				<img class="card-img-top" src="<?= base_url('assets/web/jelaskan.jpg')?>">
			</div>
		</div>
	</div>

		<?php } ?>
	</div>

</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/wizard.js'); ?>"></script>

