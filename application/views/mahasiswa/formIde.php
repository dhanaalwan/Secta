<head>
	<script type="text/javascript">
		$('input[type="file"]').on('change', function() {
			var val = $(this).val();
			$(this).siblings('label').text(val);
		});
	</script>
</head>
<div style="margin: 20px;">
<form method="POST" action="<?= base_url('Mahasiswa/sendIcpEmail') ;?>" enctype="multipart/form-data">	
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	<div class="form-group">
		<div class="input-group">
			<div class="custom-file">
				<input id="ICP" name="ICP" type="file" class="custom-file-input col custom-file-control" required>
				<label class="custom-file-label">File ICP</label>					
			</div>
		</div>
		<small>Unggah File Idea Concept Paper</small>

	</div>

	<div class="form-row">
		<div class="form-group col-md col">
			<input class="form-control form-control-sm" type="text" name="judul" id="judul" placeholder="Judul Tugas Akhir" required>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md col">
			<textarea class="form-control form-control-sm" type="text" name="pesan" id="pesan" placeholder="Isi pesan kepada dosen" required></textarea>
		</div>
	</div>
	<label>Dosen Pembimbing</label>
	<select name="dosen1" class="form-control" required>
		<option value="">Pilih</option>
		<?php
		foreach ($list_dosen as $d) {
			echo "<option value='" . htmlentities($d->IDDosen) . "'>" . htmlentities($d->NamaDosen) . "</option>";
		}
		?>
	</select>
	<br>
	<?php
		$notif = $this->session->flashdata('notif');
		if($notif != NULL){
			echo '
				<div class="alert alert-danger">'.$notif.'</div>
			';
		}
	?>
	<button class="btn btn-outline-primary" type="submit"> Upload </button>
</form>	

</div>