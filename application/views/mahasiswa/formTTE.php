<head>
	<script type="text/javascript">
		$('input[type="file"]').on('change', function() {
			var val = $(this).val();
			$(this).siblings('label').text(val);
		});
	</script>
</head>
<div style="height: 400px;">
<form method="POST" action="<?= base_url('Mahasiswa/signFile') ;?> " enctype="multipart/form-data">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	<div class="form-group">
		<div class="input-group">
			<div class="custom-file">
				<input type="file" id="TTE" name="TTE" class="custom-file-input col custom-file-control" required>
				<label class="custom-file-label">File Dokumen PDF</label>					
			</div>
		</div>
		<small>Unggah File yang Ingin Ditandatangani</small>

	</div>
	<div class="form-row">
		<div class="form-group col-md col">
			<input class="form-control form-control-sm" type="number" name="nik" id="nik" placeholder="NIK" required>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md col">
			<input class="form-control form-control-sm" type="password" name="passphrase" id="passphrase" placeholder="Passphrase" required>
		</div>
	</div>
	<?php
		$notif = $this->session->flashdata('notif');
		if($notif != NULL){
			echo '
				<div class="alert alert-danger">'.$notif.'</div>
			';
		}
	?>
	<div>
		<button class="btn btn-outline-primary" type="submit"> Tanda Tangan </button>
	</div>

</form>
</div>
