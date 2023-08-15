<head>
    <script type="text/javascript">
        $('input[type="file"]').on('change', function() {
            var val = $(this).val();
            $(this).siblings('label').text(val);
        });
    </script>
</head>

	<div class="card container grid-child" style="background-color: white; border: none; padding:30px; margin-bottom: 10px; height: 100%;" >
	<h6>Tambah Pengumuman</h6><br>
	<form method="POST" action="<?= base_url('Adminprodi/tambahPengumuman') ;?>" enctype="multipart/form-data">
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
        <div class="form-row">
            <div class="form-group col-md col">
                <input class="form-control form-control-sm" type="text" name="judul" id="judul" placeholder="Judul Pengumuman" required>
            </div>
        </div>
		<div class="form-row">
			<div class="form-group col-md col">
				<textarea class="form-control form-control-sm"  name="pesan" id="pesan" placeholder="Pesan" required></textarea>
			</div>
		</div>
        <div class="form-row">
            <div class="form-group col-md col">
                Penerima
                <?php if ($user_admin->result()[0]->IDProgramStudiUser == 1) { ?>
                    <input class="form-control form-control-sm bg-info text-light" type="text" name="penerima" id="penerima" value="Mahasiswa Kamsib" readonly>
                <?php } else{?>
                    <input class="form-control form-control-sm bg-success text-light" type="text" name="penerima" id="penerima" value="Mahasiswa Kriptografi" readonly>
                <?php }?>
                
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" id="filegiat" name="filegiat" class="custom-file-input col custom-file-control">
                    <label class="custom-file-label">File Pengumuman</label>                   
                </div>
            </div>
            <small>Unggah File Kegiatan</small>

        </div>
		<div>
			<button class="btn btn-outline-primary" type="submit"> Tambah </button>
		</div>

	</form>
	</div>
