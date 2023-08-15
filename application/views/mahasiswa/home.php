<head>
	<?php
		//$load = 0;
		$activeornot_notif = 'active';
		$activeornot_notif2 = 'show';
		$activeornot_ide = '';
		$activeornot_ide2 = '';
		$activeornot_ta = '';
		$activeornot_ta2 = '';
		$activeornot_tte = '';
		$activeornot_tte2 = '';		

		if ($load == 1){
			$activeornot_notif = '';
			$activeornot_notif2 = '';
			$activeornot_ide = 'active';
			$activeornot_ide2 = 'show';
			$activeornot_ta = '';
			$activeornot_ta2 = '';
			$activeornot_tte = '';
			$activeornot_tte2 = '';
		} else if ($load == 2) {
			$activeornot_notif = '';
			$activeornot_notif2 = '';
			$activeornot_ide = '';
			$activeornot_ide2 = '';
			$activeornot_ta = 'active';
			$activeornot_ta2 = 'show';
			$activeornot_tte = '';
			$activeornot_tte2 = '';
		} else if ($load == 3) {
			$activeornot_notif = '';
			$activeornot_notif2 = '';
			$activeornot_ide = '';
			$activeornot_ide2 = '';
			$activeornot_ta = '';
			$activeornot_ta2 = '';
			$activeornot_tte = 'active';
			$activeornot_tte2 = 'show';
		}
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			<?php if ($activeornot_notif == 'active') {?>
				$('#Pemberitahuan').load('<?php echo base_url('controllerGlobal/notifikasi');?>');
			<?php } elseif ($activeornot_ide == 'active') {?>
				$('#tabelideTugasAkhir').load('<?php echo base_url('Mahasiswa/ideTugasAkhir');?>');
				$('#form_ide').load('<?php echo base_url('Mahasiswa/form_ide');?>');
			<?php } elseif ($activeornot_ta == 'active') {?>
				$('#tabelMyTugasAkhir').load('<?php echo base_url('Mahasiswa/myTugasAkhir');?>');
			<?php } elseif ($activeornot_tte == 'active') {?>
				$('#form_tte').load('<?php echo base_url('Mahasiswa/form_tte');?>');
				$('#list_tte').load('<?php echo base_url('Mahasiswa/list_tte');?>');
			<?php }?>

			$('#navTugasAkhir').click(function() {
				$('#tabelMyTugasAkhir').load('<?php echo base_url('Mahasiswa/myTugasAkhir');?>');
			});
			$('#myprofil').load('<?php echo base_url('controllerGlobal/myProfil');?>');
			
			$('#v-pills-home-tab').click(function() {
				$('#Pemberitahuan').load('<?php echo base_url('controllerGlobal/notifikasi');?>');
			});
			$(".btn-menu").click(function() {
				$("#mhs_profil").toggle('slow');
			});

			$("#navPanduan").click(function () {
				$('#panduan').load("<?php echo base_url('ControllerGlobal/panduan');?>");
			});

			$("#v-pills-tte-tab").click(function () {
				$('#form_tte').load('<?php echo base_url('Mahasiswa/form_tte');?>');
				$('#list_tte').load('<?php echo base_url('Mahasiswa/list_tte');?>');
			});

			$("#navIdetugasakhir").click(function () {
				$('#tabelideTugasAkhir').load('<?php echo base_url('Mahasiswa/ideTugasAkhir');?>');
				$('#form_ide').load('<?php echo base_url('Mahasiswa/form_ide');?>');
			});

			
			
		});

	</script>
</head>
<body>
	<div class="container-fluid">
		<div>
			<div class="col-md">
				<div class="row">
					<div class="col-md">
						<div class="nav nav-pills mb-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a href="#" class="btn-menu nav-link"><i class="fas fa-bars"></i></a>
							<?php 
								echo '
									<a class="nav-item nav-link '.$activeornot_notif.'" id="v-pills-home-tab" data-toggle="tab" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-bullhorn fa-sm"></i> Pengumuman 
									</a>
									<a class="nav-item nav-link '.$activeornot_ide.' '.($_SESSION['Status'] == 'TugasAkhir' && !$tugasakhir ? '' : 'disabled').'" id="navIdetugasakhir" data-toggle="tab" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"> <i class="fas fa-file-alt fa-sm"></i> Idea Concept Paper 
									</a>

									<a class="nav-item nav-link '.$activeornot_ta.' '.($_SESSION['Status'] == 'TugasAkhir' && $tugasakhir ? '' : 'disabled').'" id="navTugasAkhir" data-toggle="tab" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false" ><i class="fas fa-pencil-alt"></i> Tugas Akhir </a>

									<a class="nav-item nav-link '.$activeornot_tte.'" id="v-pills-tte-tab" data-toggle="tab" href="#v-pills-tte" role="tab" aria-controls="v-pills-tte" aria-selected="false"><i class="fas fa-file-pen"></i> TTE 
									</a>
								';
							?>

							<a class="nav-link nav-item" id="navPanduan" data-toggle="list" href="#list-panduan" role="tab" aria-controls="panduan">
								<i class="fas fa-question-circle"></i> Panduan</a>
						</div>
					</div>
					<div class="col-md-auto">
						<span class="text-right"> 
							<?php $status = $_SESSION['Adminprodi'] === 1 ? 'Adminprodi' : $_SESSION['Status'];
							echo $status.' '.$users->row()->ProgramStudi.' '.$_SESSION['BidangMinat'] ?>
							<h5>
								<?= $_SESSION['Nama'] ?> / <?= $_SESSION['ID'] ?>
							</h5>
						</span>
					</div>
				</div>
			</div>
			<div class="row m-2">
				<div class="col-md-2" id="mhs_profil" style="display: none">
					<div id="myprofil">
					</div>
				</div>

				<div class="col-md mb-3">
					<div class="tab-content" id="v-pills-tabContent">
						<?php
							echo'
								<div class="tab-pane fade '.$activeornot_notif2.' '.$activeornot_notif.'" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
									<div id="Pemberitahuan"></div>
								</div>

								<div class="tab-pane fade '.$activeornot_ide2.' '.$activeornot_ide.'" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
									<div class="card border-primary">
										<div class="card-body">
											<div class="row">
												<div class="col-md-5 mb-1" id="form_ide">
												</div>

												<div id="tabelideTugasAkhir" class="col-md">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade '.$activeornot_ta2.' '.$activeornot_ta.'" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
									<div class="mb-3 card container" id="tabelMyTugasAkhir">
									</div>
								</div>
								<div class="tab-pane fade '.$activeornot_tte2.' '.$activeornot_tte.'" id="v-pills-tte" role="tabpanel" aria-labelledby="v-pills-tte-tab">
									<div class="card border-primary">
										<div class="card-body">
											<div class="row">
												<div class="col-md-6 mb-1" id="form_tte">
												</div>
												<div class="col-md-6 mb-1" id="list_tte">
												</div>
											</div>
										</div>
									</div>
								</div>

							';
						?>
						
						<div class="tab-pane fade" id="list-panduan" role="tabpanel" aria-labelledby="list-panduan-list">
						<div id='panduan' class="container"></div>
						
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