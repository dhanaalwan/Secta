<head>
	<script type="text/javascript">
		$('input[type="file"]').on('change', function() {
			var val = $(this).val();
			$(this).siblings('label').text(val);
		});
	</script>
</head>
<style>
tr {
	height: 30px;
}
</style>
<div class="card-body" style="margin-top: 40px;">
	<div class="form-row">
		<div class="form-group col-md">

			<h5> <i class="fas fa-book fa-sm"></i> <?php foreach ($tugasakhir2->result() as $s) {
				echo htmlentities($s->JudulIde);?> 
			</h5>	

			

			<div class="form-row mt-3">
				<div class="form-group col-md">

					<?php 
					$statustugasakhir = $tugasakhir2->result()[0]->StatusTA;
					if ($statustugasakhir == 'Kosong') { 
						$file = $s->FileProposal;
						$sesi = 'Proposal';
					} else { 
						$file = $s->FileTugasAkhir;
						$sesi = 'TugasAkhir';
					} $sesi_ta = 0;?>
					<?php 

					$icp = $s->FileProposal;
					$proposal = $s->FileProposal;
					$tugasakhir = $s->FileTugasAkhir;

					if (empty($proposal)) {
						$disablep = 'disabled';
					} else {
						$disablep = '';
					}

					if (empty($tugasakhir)) {
						$disables = 'disabled';
					} else {
						$disables = '';
					} 
					?>

					<a class="card-body" target="_BLANK"<?php if (empty($proposal)) {
						echo "";
					} else {
						echo "href=".base_url("assets/Proposal/".$proposal);
					} ?>> 
						<img src="<?php echo (base_url('assets/images/logo/pdf.png')); ?>" alt="Download Proposal" style="width:30px;">
							File Proposal  
					</a>

					<a class="card-body" target="_BLANK"<?php if ($statustugasakhir == 'Kosong' ||$statustugasakhir == 'ProposalTerkirim') {
						echo "";
					} else {
						echo "href=".base_url("assets/TugasAkhir30/".$tugasakhir);
					} ?>> 
						<img src="<?php echo (base_url('assets/images/logo/pdf.png')); ?>" alt="Download TA 30%" style="width:30px;">
							File Tugas Akhir 30%  
					</a>

					<a class="card-body" target="_BLANK"<?php if ($statustugasakhir == 'Kosong' ||$statustugasakhir == 'ProposalTerkirim'||$statustugasakhir == 'TugasAkhir30Terkirim') {
						echo "";
					} else {
						echo "href=".base_url("assets/TugasAkhir70/".$tugasakhir);
					} ?>> 
						<img src="<?php echo (base_url('assets/images/logo/pdf.png')); ?>" alt="Download TA 70%" style="width:30px;">
							File Tugas Akhir 70%  
					</a>
					<a class="card-body" target="_BLANK"<?php if ($statustugasakhir == 'Kosong' ||$statustugasakhir == 'ProposalTerkirim'||$statustugasakhir == 'TugasAkhir30Terkirim'||$statustugasakhir == 'TugasAkhir70Terkirim') {
						echo "";
					} else {
						echo "href=".base_url("assets/TugasAkhir100/".$tugasakhir);
					} ?>> 
						<img src="<?php echo (base_url('assets/images/logo/pdf.png')); ?>" alt="Download TA 100%" style="width:30px;">
							File Tugas Akhir 100%  
					</a>

				</div>
				
			</div>
			<?php }?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6" style="height:480px; margin-bottom: 20px;">
			<div class="prp card bg-warning mb-3 text-dark" style="height:100%;">
				<div class="card-header" style="color:black;"><strong>PROPOSAL</strong></div>
				<div class="card-body m-3">
					<table style="margin-bottom: 10px; vertical-align:top;">
						<tbody>
							<tr>
								<td style="width: 30%;"><strong>Nama</strong></td>
								<td style="width: 7%;">:</td>
								<td><?php echo $tugasakhir2->result()[0]->Nama?></td>
							</tr>
							<tr>
								<td><strong>NPM</strong></td>
								<td>:</td>
								<td><?php echo $tugasakhir2->result()[0]->ID?></td>
							</tr>
							<tr>
								<td><strong>Judul Proposal</strong></td>
								<td>:</td>
								<td><?php echo htmlentities($tugasakhir2->result()[0]->JudulIde)?></td>
							</tr>
							<tr>
								<td><strong>File Proposal</strong></td>
								<td>:</td>
								<td>
									<?php if ($tugasakhir2->result()[0]->FileProposal!=''){?>
										<?php echo $tugasakhir2->result()[0]->FileProposal?>
									<?php } else{?>
										-
									<?php }?>
								</td>
							</tr>
							<tr>
								<td><strong>Ketua Penguji</strong></td>
								<td>:</td>
								<td>
									<?php if ($ketuapenguji->result()[0]->IDKetuaPenguji == NULL){?>
										-
									<?php } else{?>
										<?php echo $ketuapenguji->result()[0]->NamaDosen?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td><strong>Penguji 1</strong></td>
								<td>:</td>
								<td><?php echo $dosenpembimbing->result()[0]->NamaDosen?></td>
							</tr>
							<tr>
								<td><strong>Penguji 2</strong></td>
								<td>:</td>
								<td>
									<?php if ($penguji2->result()[0]->IDPenguji2 == NULL){?>
										-
									<?php } else{?>
										<?php echo $penguji2->result()[0]->NamaDosen?>
									<?php }?>
								</td>
							</tr>
						</tbody>
					</table>

				    <?php 
				    if ($sesi == 'Proposal') {
				    	if ($statustugasakhir == 'Kosong'): ?>
						<div class="form-group mr-3">
							<form method="post" id="mydata" action="<?php echo base_url('Mahasiswa/uploadData/'.$sesi.'/'.$s->IDTugasAkhir.'/ProposalTerkirim/'.$ketuapenguji->result()[0]->Email.'/'.$dosenpembimbing->result()[0]->Email.'/'.$penguji2->result()[0]->Email);?>" enctype="multipart/form-data">
								<div class="input-group">
									<div class="custom-file">
										<input type="file" name="Proposal" id="Proposal" class="custom-file-input col custom-file-control" required>
										<label class="custom-file-label">Upload <?= $sesi ?></label>					
									</div>
									<div class="input-group-append"> 
										<button class="btn btn-outline-primary" type="submit"> Upload </button>					
									</div>
								</div>
								<small> File harus berbentuk PDF </small>
							</form>		
						</div>
						<h5><span class="badge badge-secondary">Proposal Belum Diupload</span></h5>
					<?php endif; ?>
					<?php
				    } else{

				    	echo '
				    		<h5><span class="badge badge-success">Proposal Sudah Dikumpulkan</span></h5>
				    	';?>

				    	<script type="text/javascript">
				    		$(document).ready(function(){
							   $('.prp').addClass('bg-light text-dark').removeClass('text-white bg-warning');

							});
				    	</script>
				    <?php }?>
				    
			  	</div>

			</div>
		</div>
		<div class="col-sm-6" style="height:480px; margin-bottom: 20px;">
			<div class="ta card text-white bg-info mb-3" style="height:100%;">
				<div class="card-header" style="color:black;"><strong>TUGAS AKHIR</strong></div>
								<div class="card-body m-3">
					<table style="margin-bottom: 10px; vertical-align:top;">
						<tbody>
							<tr>
								<td style="width: 30%;"><strong>Nama</strong></td>
								<td style="width: 7%;">:</td>
								<td><?php echo $tugasakhir2->result()[0]->Nama?></td>
							</tr>
							<tr>
								<td><strong>NPM</strong></td>
								<td>:</td>
								<td><?php echo $tugasakhir2->result()[0]->ID?></td>
							</tr>
							<tr>
								<td><strong>Judul</strong></td>
								<td>:</td>
								<td><?php echo htmlentities($tugasakhir2->result()[0]->JudulIde)?></td>
							</tr>
							<tr>
								<td><strong>File Tugas Akhir</strong></td>
								<td>:</td>
								<td>
									<?php if ($tugasakhir2->result()[0]->FileTugasAkhir!=''){?>
										<?php echo $tugasakhir2->result()[0]->FileTugasAkhir?>
									<?php } else{?>
										-
									<?php }?>
								</td>
							</tr>
							<tr>
								<td><strong>Ketua Penguji</strong></td>
								<td>:</td>
								<td>
									<?php if ($ketuapenguji->result()[0]->IDKetuaPenguji == NULL){?>
										-
									<?php } else{?>
										<?php echo $ketuapenguji->result()[0]->NamaDosen?>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td><strong>Penguji 1</strong></td>
								<td>:</td>
								<td><?php echo $dosenpembimbing->result()[0]->NamaDosen?></td>
							</tr>
							<tr>
								<td><strong>Penguji 2</strong></td>
								<td>:</td>
								<td>
									<?php if ($penguji2->result()[0]->IDPenguji2 == NULL){?>
										-
									<?php } else{?>
										<?php echo $penguji2->result()[0]->NamaDosen?>
									<?php }?>
								</td>
							</tr>
						</tbody>
					</table>

				    <?php 
				    if ($sesi == 'TugasAkhir') {
				    	if ($statustugasakhir == 'ProposalTerkirim'): ?>
						<div class="form-group mr-3">
							<form method="post" id="mydata" action="<?php echo base_url('Mahasiswa/uploadData/TugasAkhir30/'.$s->IDTugasAkhir.'/TugasAkhir30Terkirim/'.$ketuapenguji->result()[0]->Email.'/'.$dosenpembimbing->result()[0]->Email.'/'.$penguji2->result()[0]->Email);?>" enctype="multipart/form-data">
								<div class="input-group">
									<div class="custom-file">
										<input type="file" name="TugasAkhir30" id="TugasAkhir30" class="custom-file-input col custom-file-control" required>
										<label class="custom-file-label">Upload <?= $sesi ?> 30%</label>					
									</div>
									<div class="input-group-append"> 
										<button class="btn btn-outline-dark" type="submit"> Upload </button>					
									</div>
								</div>
								<small> File harus berbentuk PDF </small>
							</form>		
						</div>
						<h5><span class="badge badge-secondary">TA 30% Belum Dikumpulkan</span></h5>
					<?php endif ?>
					<?php if ($statustugasakhir == 'TugasAkhir30Terkirim'): ?>
						<div class="form-group mr-3">
							<form method="post" id="mydata" action="<?php echo base_url('Mahasiswa/uploadData/TugasAkhir70/'.$s->IDTugasAkhir.'/TugasAkhir70Terkirim/'.$ketuapenguji->result()[0]->Email.'/'.$dosenpembimbing->result()[0]->Email.'/'.$penguji2->result()[0]->Email);?>" enctype="multipart/form-data">
								<div class="input-group">
									<div class="custom-file">
										<input type="file" name="TugasAkhir70" id="TugasAkhir70" class="custom-file-input col custom-file-control" required>
										<label class="custom-file-label">Upload <?= $sesi ?> 70%</label>					
									</div>
									<div class="input-group-append"> 
										<button class="btn btn-outline-dark" type="submit"> Upload </button>					
									</div>
								</div>
								<small> File harus berbentuk PDF </small>
							</form>		
						</div>
						<h5><span class="badge badge-success">TA 30% Sudah Dikumpulkan</span></h5>
						<h5><span class="badge badge-secondary">TA 70% Belum Dikumpulkan</span></h5>
					<?php endif; ?>
					<?php if ($statustugasakhir == 'TugasAkhir70Terkirim'): ?>
						<div class="form-group mr-3">
							<form method="post" id="mydata" action="<?php echo base_url('Mahasiswa/uploadData/TugasAkhir100/'.$s->IDTugasAkhir.'/TugasAkhir100Terkirim/'.$ketuapenguji->result()[0]->Email.'/'.$dosenpembimbing->result()[0]->Email.'/'.$penguji2->result()[0]->Email);?>" enctype="multipart/form-data">
								<div class="input-group">
									<div class="custom-file">
										<input type="file" name="TugasAkhir100" id="TugasAkhir100" class="custom-file-input col custom-file-control" required>
										<label class="custom-file-label">Upload <?= $sesi ?> 100%</label>					
									</div>
									<div class="input-group-append"> 
										<button class="btn btn-outline-dark" type="submit"> Upload </button>					
									</div>
								</div>
								<small> File harus berbentuk PDF </small>
							</form>		
						</div>
						<h5><span class="badge badge-success">TA 70% Sudah Dikumpulkan</span></h5>
						<h5><span class="badge badge-secondary">TA 100% Belum Dikumpulkan</span></h5>
					<?php endif; ?>
					<?php if ($statustugasakhir == 'TugasAkhir100Terkirim'): ?>
						<h5><span class="badge badge-success">TA 100% Sudah Dikumpulkan</span></h5>
						<script type="text/javascript">
				    		$(document).ready(function(){
							   $('.ta').addClass('bg-light text-dark').removeClass('text-white bg-info');

							});
				    	</script>
					<?php endif ?>
					<?php if ($statustugasakhir == 'TugasAkhir100Dikumpulkan'): ?>
						<h5><span class="badge badge-success">TA 100% Sudah Dikumpulkan ke Drive</span></h5>
						<script type="text/javascript">
				    		$(document).ready(function(){
							   $('.ta').addClass('bg-light text-dark').removeClass('text-white bg-info');

							});
				    	</script>
					<?php endif; 
				    } else{

				    	echo '
				    		<h5><span class="badge badge-secondary">Kosong</span></h5>
				    	';?>

				    	<script type="text/javascript">
				    		$(document).ready(function(){
							   $('.ta').addClass('bg-light text-dark').removeClass('text-white bg-info');

							});
				    	</script>
				    <?php }?>
				    
			  	</div>

			</div>
		</div>
	</div>

	<div class="card border-primary mb-3">
	  <div class="card-header">Link Pengumpulan Berkas Pelengkap Seminar/Sidang</div>
	  <div class="card-body text-primary">
	  	<?php 
	  	if ($list_berkas) {
	  		foreach ($list_berkas->result() as $b) {
	  	?>
		  		<h6 class="card-title text-primary">
			    	<a href="<?php echo htmlentities($b->LinkPengumpulan);?>" target="_blank">
			    		<?php echo htmlentities($b->NamaBerkas);?>
			    	</a>
				</h6>
		  	<?php
		  	}
	  	} else {
	  		echo '-';
	  	}
	  	?>
	  </div>
	</div>
</div>
<div id="modal_kumpulkan_proposal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    	<div>
    		<div>
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h6 class="mb-4">Kumpulkan Proposal</h6>
	    	</div>
	        <form action="<?= base_url('Mahasiswa/sendLink/'.$tugasakhir2->result()[0]->IDTugasAkhir.'/'.$sesi.'/ProposalDikumpulkan') ;?>" method="post">
	        	<div>
		            <div class="mb-3">
		                <label for="link" class="form-label">Link Pengumpulan Proposal</label>
		                <input type="text" class="form-control" id="link" name="link" aria-describedby="linkHelp">
                        <div id="linkHelp" class="form-text">Inputkan link dokumen PROPOSAL yang telah dikumpulkan pada drive.
                        </div>
		            </div>

		        </div>
		        <div>
			        <input type="submit" class="btn btn-outline-primary" name="submit" value="Simpan">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
	            
	        </form>
	    </div>
    </div>
</div>
<div id="modal_kumpulkan_ta70" class="modal fade" role="dialog">
    <div class="modal-dialog modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    	<div>
    		<div>
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h6 class="mb-4">Kumpulkan Tugas Akhir</h6>
	    	</div>
	        <form action="<?= base_url('Mahasiswa/sendLink/'.$tugasakhir2->result()[0]->IDTugasAkhir.'/'.$sesi.'/TugasAkhir70Dikumpulkan') ;?>" method="post">
	        	<div>
		            <div class="mb-3">
		                <label for="link" class="form-label">Link Pengumpulan TA 70%</label>
		                <input type="text" class="form-control" id="link" name="link" aria-describedby="linkHelp">
                        <div id="linkHelp" class="form-text">Inputkan link dokumen TUGAS AKHIR 70% yang telah dikumpulkan pada drive.
                        </div>
		            </div>

		        </div>
		        <div>
			        <input type="submit" class="btn btn-outline-primary" name="submit" value="Simpan">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
	            
	        </form>
	    </div>
    </div>
</div>
<div id="modal_kumpulkan_ta100" class="modal fade" role="dialog">
    <div class="modal-dialog modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    	<div>
    		<div>
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h6 class="mb-4">Kumpulkan Tugas Akhir</h6>
	    	</div>
	        <form action="<?= base_url('Mahasiswa/sendLink/'.$tugasakhir2->result()[0]->IDTugasAkhir.'/'.$sesi.'/TugasAkhir100Dikumpulkan') ;?>" method="post">
	        	<div>
		            <div class="mb-3">
		                <label for="link" class="form-label">Link Pengumpulan TA 100%</label>
		                <input type="text" class="form-control" id="link" name="link" aria-describedby="linkHelp">
                        <div id="linkHelp" class="form-text">Inputkan link dokumen TUGAS AKHIR 100% yang telah dikumpulkan pada drive.
                        </div>
		            </div>

		        </div>
		        <div>
			        <input type="submit" class="btn btn-outline-primary" name="submit" value="Simpan">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
	            
	        </form>
	    </div>
    </div>
</div>