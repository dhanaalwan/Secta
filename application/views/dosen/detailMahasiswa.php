<head> 
	<script type="text/javascript">

		$(document).ready(function(){

			$(".status").on('submit',
				function(e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;
					var id = $(this).attr("id");
					var nama = $(this).attr('nama');


					if (window.FormData) {
						formdata = new FormData(form[0]);
					}	
					swal({
						title: nama+" Akan Di Setujui",
						text: "Sekali DiSetujui Tidak Akan Bisa Diubah!",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								type: 'POST',
								url: form.attr('action'),
								data: formdata ? formdata: form.serialize(),
								contentType: false,
								processData: false,
								cache: false,
								beforeSend: function() {
									$('.loading').show();
								},
								success: function() {
									$('.loading').fadeOut('slow');
									$(".btn" + id).prop("disabled",true);
									$("#TugasAkhir").fadeIn("slow");
								}
							});
						}
					});
				});

			$(".catatan").on('submit',
				function(e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;
					var ID = form.attr('id');

					if (window.FormData) {
						formdata = new FormData(form[0]);
					}

					var formAction = form.attr('action')+ID;

					$.ajax({
						type: 'POST',
						url: formAction,
						data: formdata ? formdata: form.serialize(),
						contentType: false,
						processData: false,
						cache: false,
						beforeSend: function() {
							$('.loading').show();
						},
						success: function() {
							location.reload();
						}
					});
				});
		});

	</script>
</head>
<?php foreach ($tugasakhir->result() as $u) { ?>
	
	<div class="container-fluid">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-2 mr-3">
						<img class="card-img-top" src="<?= base_url($u->Foto === '' ? 'assets/web/user.png' : 'assets/images/users/'.$u->Foto ) ;?>">
					</div>
					<div class="col-md">
						<div class="form-row">
							<div class="form-group col-md-auto">
								<p class="h5"> <?= $u->Nama;?> / <?= $u->ID;?>  </p>
								<p class="text-subtitle h6">
									<i class="fas fa-envelope fa-sm"></i> <?= $u->Email;?> <br> 
									<i class="fas fa-phone fa-sm"></i> <?= $u->NoHP === '' ? 'Mahasiswa ini belum menambahkan nomor' : $u->NoHP;?> 
								</p>
							</div>						
							<div class="form-group col-md text-right">
								<div>
									<h4><?= $u->JudulTugasAkhir;?></h4>
								</div>
							</div>
						</div>

						<?php if ($pembimbing) {
							foreach ($pembimbing->result() as $p) {
								if ($u->IDTugasAkhir === $p->IDTugasAkhirPmb) {
									$StaProposal = $p->StatusProposal;
									$StaTugasAkhir = $p->StatusTugasAkhir;
									$icp = $u->FileICP;
									?>

									<div class="form-row">
										<div class="form-group">
											<a class="card-body" href="<?php echo base_url("ControllerGlobal/downloadFile/ICP/".$icp) ?>"><i class="fa fa-download"></i> ICP </a>
											<a class="btn btn-sm"
											<?php if (!empty($u->FileProposal)) { echo "href=".base_url("ControllerGlobal/downloadFile/Proposal/".$u->FileProposal);
											}  ?>> <i class="fa fa-download"></i> Proposal <span class="badge badge-light"> disetujui oleh: <?= $uploader->row_array()['Nama'] ?></span> </a>
										</div>
										<div class="form-group ml-2">
											<form class="status" id="<?= $p->IDPembimbing;?>" nama="Proposal" method="POST" action="<?= base_url('Dosen/accUsers/'.$u->IDTugasAkhir.'/Proposal');?>">
												<input type="submit" class="btn<?= $p->IDPembimbing;?> btn btn-outline-primary btn-sm" value="Menyetujui Proposal" <?= $StaProposal ? 'disabled' : '' ?> >
											</form>
										</div> 

										<div class="form-group ml-2"> 
											<div id="TugasAkhir" class="form-row" <?php if (!$StaProposal) { echo 'style="display: none"';	} ?>>
											<div class="form-group ml-2">
											<a class="btn btn-sm"
											<?php if (!empty($u->FileTugasAkhir)) { echo "href=".base_url("ControllerGlobal/downloadFile/TugasAkhir/".$u->FileTugasAkhir);	} ?>> <i class="fa fa-download"></i> <span class="badge badge-light"><?= $uploader->row_array()['Nama'] ?></span> </a>
												</div>
												<div class="form-group col-md"> 
													<form id="<?= $p->IDPembimbing;?>" class="status" nama="TugasAkhir" method="POST" action="<?= base_url('Dosen/accUsers/'.$u->IDTugasAkhir.'/TugasAkhir');?>">
														<input type="submit" <?= $StaTugasAkhir ? 'Disabled' : '' ?> class="btn<?= $p->IDPembimbing;?> btn btn-outline-primary btn-sm" value="Menyetujui Tugas Akhir" 
														<?php if ($proposal->num_rows() === 0) {
															echo 'disabled';
															if ($StaProposal) {
																$status = 'Proposal telah disetujui. Mohon tungu persetujuan dari pembimbing lain untuk dapat menyetujui tugas akhir ';
															} else {
																$status = 'Proposal ini telah disetujui pembimbing yang lain.';
															}
														} else {
															$status = 'Silahkan Setujui Jika Sudah Sesuai <br>';
														} ?>>
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="alert alert-info">
										<?= $status ?>	
									</div>
									
								<?php } } } ?>
							</div>
						</div>
						<?php if ($pembimbing) { ?>
							<form id="catatanBimbingan" method="POST" action="<?= base_url('dosen/catatan/'.$u->IDTugasAkhir.'/'.$u->ID.'/'.$isTugasAkhir);?>">
								<div class="form-group">
									<h6 class="text-right"> Catatan Bimbingan </h6>
									<textarea class="form-control" name="note" required></textarea>
								</div>
								<div class="form-group">
									<input type="file" class="form-control" name="<?= 'file'.$isTugasAkhir ?>" required>
									<small>Unggah File Revisi <?= $isTugasAkhir ?></small>
								</div>
								<div class="form-group">
									<button type="submit" class='btn btn-primary'><i class='fas fa-paper-plane'></i> Kirim</button>
								</div>
							</form>
						<?php } } ?>
						<hr>
						<div class="form-row">
							<div class="form-group col-8">
								<h5> <i class="fas fa-pencil-alt fa-xs"></i> Kartu Bimbingan </h5>	
							</div>

							<?php foreach ($tugasakhir->result() as $p);
							{ ?>
								<div class="form-group col-4 text-right">
									<a href="<?= base_url('Cetak/kartu/'.$p->ID);?>"> <button class="btn btn-outline-primary btn-sm"> <i class="fas fa-print"></i> Cetak</button>		</a>
								</div>
							<?php } ?>
						</div>
						<?php if (!$konsultasi) { ?>
							<div class="card card-outline-secondary">
								<div class="row align-items-center m-5">
									<div class="col-md mb-5">
										<h2>Belum Ada Catatan Bimbingan</h2>
										Catatan bimbingan belum di isi oleh pembimbing, jika anda pembimbing silahkan isi catatan bimbingan mahasiswa ini dengan memasukan form catatan di atas. Tanggal bimbingan akan secara otomatis masuk saat anda memasukan catatan saat itu juga.
									</div>
									<div class="col-md-3">
										<img src="<?= base_url('assets/web/sad.jpg') ?>" >	
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="table-responsive">
								<table class="table small">
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggal</th>
											<th>Pembimbing</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1 ?>
										<?php foreach ($konsultasi->result() as $k) { ?>
											<tr>
												<td><?= $no++;?></td>
												<td><?= longdate_indo($k->TanggalBimbingan);?></td>
												<td><?= $k->Nama;?></td>
											</tr>
											<tr>
												<th> Catatan </th>
												<td colspan="2"><?= $k->Catatan;?></td>
											</tr>
										<?php } ?>	

									</tbody>
								</table>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>


			<script>
			$("#catatanBimbingan").on('submit', 
				function(e) {
				e.preventDefault();
				var form = $(this)
				var formData = false;
				if (window.FormData) {
					formdata = new FormData(form[0])
				}

				var formAction = form.attr('action');

				$.ajax({
					url: formAction,
					type: 'POST',
					cache:false,
					contentType:false,
					processData:false,
					dataType: 'json',
					data: formdata ? formdata: form.serialize(),
					beforeSend: function () {
					 	swal('Loading')
					},
					success: function (result) {
						swal('Berhasil')
						setTimeout(function() {
							location.reload();
						}, 1000)
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						swal(errorThrown, 'Cek Database Dimana Mungkin Ada NPM / NIP yang Sama')
  					}
				})
			});
			</script>