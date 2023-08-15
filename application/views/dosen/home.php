<head>
	<script type="text/javascript">
		$(function () {

			$("#navIdeTugasAkhir").click(function () {
				$('#idetugasakhir').load("<?php echo base_url('adminprodi/ideTugasAkhir');?>");
			});

			$("#navKegiatan").click(function () {
				$('#formKegiatan').load("<?php echo base_url('adminprodi/formPengumuman');?>");
			});

			$("#navTugasAkhir").click(function () {
				$('#tabelTugasAkhir').load("<?php echo base_url('adminprodi/tabelTugasAkhir');?>");
			});

			$("#navDokumentasi").click(function () {
				$('#dokumentasi').load("<?php echo base_url('adminprodi/dokumentasi');?>");
			});

			$('#profil').load("<?php echo base_url('ControllerGlobal/myProfil');?>");

			$("#dosen_button").on('click', function () {
				$("#data_dosen").toggle('fast');
				$("#form_dosen").toggle('slow');
			});
			<?php 
				if ($ide_load == 1){
			?>
			$('#idetugasakhir').load("<?php echo base_url('adminprodi/ideTugasAkhir');?>");
			<?php
				}else if($ta_load == 1){
			?>
			$('#tabelTugasAkhir').load("<?php echo base_url('adminprodi/tabelTugasAkhir');?>");
			<?php
				}else if($pum_load == 1){
			?>
			$('#formKegiatan').load("<?php echo base_url('adminprodi/formPengumuman');?>");
			<?php
				}else if($berkas_load == 1){
			?>
			$('#linkpengumpulan').load("<?php echo base_url('adminprodi/linkPengumpulan');?>");
			<?php
				}
			?>
			$('#pemberitahuan').load("<?php echo base_url('ControllerGlobal/notifikasi') ;?>")
			
			$("#navPemberitahuan").click(function () {
				$('#pemberitahuan').load("<?php echo base_url('ControllerGlobal/notifikasi') ;?>");
			});
			

			$("#myprofil").on('click', function () {
				$("#profil").toggle('slow');
			});

			$("#navPanduan").click(function () {
				$('#panduan').load("<?php echo base_url('ControllerGlobal/panduan');?>");
			});

			$("#navLinkPengumpulan").click(function () {
				$('#linkpengumpulan').load("<?php echo base_url('adminprodi/linkPengumpulan');?>");
			});

		});

		function searchmhs(page_num) {
			page_num = page_num ? page_num : 0;
			var keywords = $('#keywords').val();
			var search = $('#search').val();
			$.ajax({
				type: 'POST',
				url: '<?= base_url(); ?>Dosen/tabelTugasAkhir/' + page_num,
				data: 'page=' + page_num + '&keywords=' + keywords + '&search=' + search,
				beforeSend: function () {
					$('.loading').show();
				},
				success: function (html) {
					console.log(html)
					$('#tabelTugasAkhir').html(html);
					$('.loading').fadeOut("slow");
				}
			});
		}

	</script>
</head>

<body>
	<div class="container-fluid mb-2">
		<div class="row">
			<div class="col-md">
				<div class="row">
					<div class="col-md">
						<div class="nav nav-pills mb-2 flex-column flex-sm-row" id="list-tab" role="tablist">
							<a class="nav-link" href="#" id="myprofil"><i class="fas fa-bars"></i></a>
							<?php
									if ($ide_load == 1 || $ta_load == 1 || $pum_load ==1 || $berkas_load == 1) {
										echo ' 
							<a class="nav-item nav-link" id="navPemberitahuan" data-toggle="list" href="#Notifikasi" role="tab"
							 aria-controls="settings">
							 	<i class="fas fa-envelope"></i> Notifikasi</a>';
							 }
							 else {
							 	echo '
							 		<a class="nav-item nav-link active" id="navPemberitahuan" data-toggle="list" href="#Notifikasi" role="tab"
							 aria-controls="settings">
							 	<i class="fas fa-envelope"></i> Notifikasi</a>';
							 }

							 ?>

							<?php if ($_SESSION['Adminprodi']) { 
								if ($ide_load == 1) {
							?>
							<a class="nav-item nav-link active" id="navIdeTugasAkhir" data-toggle="list" href="#list-home" role="tab" aria-controls="home">
								<i class="fas fa-lightbulb"></i> Idea Concept Paper </a>
							<?php } else {
							?>
								<a class="nav-item nav-link" id="navIdeTugasAkhir" data-toggle="list" href="#list-home" role="tab" aria-controls="home">
								<i class="fas fa-lightbulb"></i> Idea Concept Paper </a>
							<?php }
							if ($ta_load == 1) {
							?>
								<a class="nav-item nav-link active" id="navTugasAkhir" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
								<i class="fas fa-book"></i> Tugas Akhir </a>
							<?php
							} else{
							?>
								<a class="nav-item nav-link" id="navTugasAkhir" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
								<i class="fas fa-book"></i> Tugas Akhir </a>
							<?php
							}
							if ($pum_load == 1) {
							?>
								<?php if ($_SESSION['Adminprodi']) { ?>
								<a class="nav-link nav-item active" id="navKegiatan" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">
									<i class="fas fa-calendar-alt"></i> Input Pengumuman </a>
								<?php } ?>
							<?php
							} else{
							?>
								<?php if ($_SESSION['Adminprodi']) { ?>
								<a class="nav-link nav-item" id="navKegiatan" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">
									<i class="fas fa-calendar-alt"></i> Input Pengumuman </a>
								<?php } ?>
							<?php
							} if ($berkas_load == 1) {
							?>
								<a class="nav-link nav-item active" id="navLinkPengumpulan" data-toggle="list" href="#list-linkpengumpulan" role="tab" aria-controls="linkpengumpulan">
								<i class="fas fa-help"></i> Link Pengumpulan</a>
							<?php
							} else{
							?>
								<a class="nav-link nav-item" id="navLinkPengumpulan" data-toggle="list" href="#list-linkpengumpulan" role="tab" aria-controls="linkpengumpulan">
								<i class="fas fa-help"></i> Link Pengumpulan</a>
							<?php
							}
						}?>


							<a class="nav-link nav-item" id="navPanduan" data-toggle="list" href="#list-panduan" role="tab" aria-controls="panduan">
								<i class="fas fa-help"></i> Panduan</a>
							
							
						</div>
					</div>
					<div class="col-md-auto">
						<span class="text-right">
							<?php $status = $_SESSION['Adminprodi'] === 1 ? 'Adminprodi' : $_SESSION['Status'];
							echo $status.'  '.$users->row()->ProgramStudi.' '.$_SESSION['BidangMinat'] ?>
							<h5>
								<?= $_SESSION['Nama'] ?> / <?= $_SESSION['ID'] ?>
							</h5>
						</span>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-2 mb-3" id="profil" style="display: none">
					</div>
					<div class="col-md">
						<div class="tab-content" id="v-pills-tabContent">
							<div class="tab-content" id="nav-tabContent">
								<?php
									if ($ide_load == 1 || $ta_load == 1 || $pum_load ==1 || $berkas_load == 1) {
										echo ' 
											<div class="tab-pane fade" id="Notifikasi" role="tabpanel" aria-labelledby="list-settings-list">
										';
									} else {
										echo '
											<div class="tab-pane fade show active" id="Notifikasi" role="tabpanel" aria-labelledby="list-settings-list">
										';
									}
								?>
								
									<div>
										<div id="pemberitahuan"></div>
									</div>
								</div>

								<?php
									if ($ide_load == 1) {
										echo ' 
											<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
										';
									} else {
										echo '
											<div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
										';
									}
								?>

								
									<div id='idetugasakhir'>
									</div>
								</div>

								<?php
									if ($ta_load == 1) {
										echo ' 
											<div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
										';
									} else {
										echo '
											<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
										';
									}
								?>
									<div id="container" class="container">
										
										<div id="tabelTugasAkhir"></div>
									</div>
								</div>
								<?php
									if ($pum_load == 1) {
										echo ' 
											<div class="tab-pane fade show active" id="list-settings" role="tabpanel" aria-labelledby="list-messages-list">
										';
									} else {
										echo '
											<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-messages-list">
										';
									}
								?>
								
									<div id="formKegiatan" class="container">

									</div>
								</div>

								<div class="tab-pane fade" id="list-panduan" role="tabpanel" aria-labelledby="list-panduan-list">
									<div id='panduan' class="container">

									</div>
								</div>

								<?php
									if ($berkas_load == 1) {
										echo ' 
											<div class="tab-pane fade show active" id="list-linkpengumpulan" role="tabpanel" aria-labelledby="list-linkpengumpulan-list">
										';
									} else {
										echo '
											<div class="tab-pane fade" id="list-linkpengumpulan" role="tabpanel" aria-labelledby="list-linkpengumpulan-list">
										';
									}
								?>
								
									<div id='linkpengumpulan'>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
<?php if(@$_SESSION['sukses']){ ?>
    <script>
    	var text2='<?php echo $_SESSION['sukses'];?>';
        Swal.fire({            
            icon: 'success',                   
            title: 'Sukses',    
            text: text2,                        
            timer: 3000,                                
            showConfirmButton: false
        })
    </script>
<?php unset($_SESSION['sukses']); } ?>
<?php if(@$_SESSION['gagal']){ ?>
    <script>
    	var text2='<?php echo $_SESSION['gagal'];?>';
        Swal.fire({            
            icon: 'error',                   
            title: 'Gagal',    
            text: text2,                        
            timer: 3000,                                
            showConfirmButton: false
        })
    </script>
<?php unset($_SESSION['gagal']); } ?>