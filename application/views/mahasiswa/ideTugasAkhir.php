<?php if ($ide_tugasakhir) { ?>
	<div style="height: 30rem; overflow: auto; margin: 20px; padding-top: 5px;">
		<?php foreach ($ide_tugasakhir->result() as $u) {	
			echo '
			<div style="float:left;">
			<a href="#" data-toggle="modal" data-target="#modal_detail_ide" onclick="prepare_detil_ide('.$u->IDIde.')"><h6 class="card-title"> <i class="fas fa-book fa-xs"></i>  '.htmlentities($u->JudulIde).'</h6></a>

			<h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar-alt fa-xs"></i>  '.$u->TanggalIde.'</h6>
			</div>
			<div style="text-align:left; float:left;">';
			if($u->StatusIde == 'ICP Diajukan'){
				echo '
				<span class="badge badge-warning rounded-pill d-inline" style="margin-left:10px;">'.$u->StatusIde.'</span>
				';
			} else if ($u->StatusIde == 'ICP Diterima') {
				echo '
				<span class="badge badge-success rounded-pill d-inline" style="margin-left:10px;">'.$u->StatusIde.'</span>
				';
			} else if ($u->StatusIde == 'ICP Ditolak') {
				echo '
				<span class="badge badge-danger rounded-pill d-inline" style="margin-left:10px;">'.$u->StatusIde.'</span>
				';
			}
			echo '</div>
			<div style="text-align:right;">
			<span class="fa-stack">
	        	<a href="#" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#modal_detail_ide" onclick="prepare_detil_ide('.$u->IDIde.')"><i class="fas fa-info-circle"></i></a>
	        </span>
			';
			
			if ($u->StatusIde != "ICP Ditolak") {
				echo '
					<a href="#" class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#modal_edit" onclick="prepare_edit('.$u->IDIde.')">Edit</a>
				';
			}

			if ($u->StatusIde != "ICP Diterima") {
				echo '
					<a href="'.base_url('Mahasiswa/hapusIde/'.$u->IDIde).'" class="btn btn-danger btn-sm remove">Hapus</a>
				';
			}else if ($u->StatusIde == "ICP Diterima") {
				echo '
					<a href="'.base_url('Mahasiswa/ajukanTA/'.$u->IDIde.'/'.$_SESSION['ID']).'" class="alert-terima btn btn-success btn-sm" >Ajukan TA</a>
				';
			}

			echo '
			</div>
			<hr>
			';

		} ?>
	</div> 
<?php } else { ?>
	<div class='row align-items-center'>
		<div class='col-md'>
			<h2>Idea Concept Paper Tidak Ditemukan</h2>
			Hi, Taruna Satria!!! Silahkan ajukan ICPmu selengkap dan sebagus mungkin ya!! Isi form di sebelah kiri untuk mengajukan ICP yang ingin kamu ajukan! Semangat tarunaa!!
		</div>
		<div class='col-md-5'>
			<img class="card-img-top" src="<?= base_url('assets/web/ide.jpg')?>">
		</div>
	</div>
<?php } ?>
	<div id="modal_edit" class="modal fade" role="dialog">
	    <div class="modal-dialog modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
	    	<div>
	    		<div>
			    	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h6 class="mb-4">Edit ICP</h6>
		    	</div>
		        <form action="<?= base_url('Mahasiswa/updateIde') ;?>" method="post">
		        	<div>
		        		<input type="hidden" id="edit_id_icp" name="edit_id_icp">
			            <div class="mb-3">
			                <label for="judul" class="form-label">Judul ICP</label>
			                <input type="text" class="form-control" id="edit_judul_icp" name="edit_judul_icp">
			                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
			                </div> -->
			            </div>
			            <div class="mb-3">
			                <label for="status" class="form-label">Status</label>
			                <input type="text" class="form-control" id="edit_status" name="edit_status" style="color:#b3b3b3;" disabled>
			                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
			                </div> -->
			            </div>
			            <label>Dosen Pembimbing</label>
						<select name="edit_dosen" id="edit_dosen" class="form-control" required>
							<?php
							foreach ($list_dosen as $d) {
								echo "<option value='" . $d->IDDosen . "'>" . $d->NamaDosen . "</option>";
							}
							?>
						</select>
						<br>

			        </div>
			        <div>
				        <input type="submit" class="btn btn-outline-primary" name="submit" value="Simpan">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
		            
		        </form>
		    </div>
	    </div>
	</div>
	<div id="modal_hapus" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Konfirmasi Hapus ICP</h4>
	      </div>
	      <form action="<?= base_url('Mahasiswa/hapusIde') ;?>" method="post">
		      <div class="modal-body">
		        	<input type="hidden" name="hapus_id_icp"  id="hapus_id_icp">
		        	<p>Apakah anda yakin menghapus ICP <b><span id="hapus_judul"></span></b> ?</p>
		      </div>
		      <div class="modal-footer">
		        <input type="submit" class="btn btn-danger" name="submit" value="YA">
		        <button type="button" class="btn btn-default" data-dismiss="modal">TIDAK</button>
		      </div>
	      </form>
	    </div>

	  </div>
	</div>
	<div id="modal_detail_ide" class="modal fade" role="dialog">
	    <div class="modal-dialog modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
	    	<div>
	    		<div>
			    	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h6 class="mb-4">Detail ICP</h6>
		    	</div>
		        <form>
		        	<div class="modal-body-detail">

			        </div>
			        <br>
			        <div>
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
		            
		        </form>
		    </div>
	    </div>
	</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
	
	function prepare_kumpulkan(id)
	{
		$("#id_icp").empty();
		$("#judul_icp").empty();
		$("#status").empty();

		$.getJSON('<?php echo base_url(); ?>index.php/mahasiswa/get_data_ide_by_id/' + id,  function(data){
			$("#id_icp").val(data.IDIde);
			$("#judul_icp").val(data.JudulIde);
			$("#status").val(data.StatusIde);
		});
	}

	function prepare_edit(id)
	{
		$("#edit_id_icp").empty();
		$("#edit_judul_icp").empty();
		$("#edit_status").empty();
		$("#edit_link").empty();
		$("#edit_dosen").val();

		$.getJSON('<?php echo base_url(); ?>index.php/mahasiswa/get_data_ide_by_id/' + id,  function(data){
			$("#edit_id_icp").val(data.IDIde);
			$("#edit_judul_icp").val(data.JudulIde);
			$("#edit_status").val(data.StatusIde);
			$("#edit_link").val(data.LinkICP);
			$("#edit_dosen").val(data.IDDosen);
		});
	}

	function prepare_hapus(id)
	{
		$("#hapus_id_icp").empty();
		$("#hapus_judul").empty();

		$.getJSON('<?php echo base_url(); ?>index.php/mahasiswa/get_data_ide_by_id/' + id,  function(data){
			$("#hapus_id_icp").val(data.IDIde);
			$("#hapus_judul").text(data.JudulIde);
		});
	}

	$('.alert-terima').on('click',function(){
            var getLink = $(this).attr('href');
            var pesan = "Yakin ajukan Tugas Akhir? ICP selain yang diajukan akan dihapus!";
            
            Swal.fire({
                title: pesan,            
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"
            
            }).then(result => {
                //jika klik ya maka arahkan ke proses.php
                if(result.isConfirmed){
                    window.location.href = getLink
                }
            })
            return false;
        });

		$('.remove').on('click',function(){
            var getLink = $(this).attr('href');
            var pesan = "Yakin hapus ICP?";
            Swal.fire({
                title: pesan,           
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"
            
            }).then(result => {
                //jika klik ya maka arahkan ke proses.php
                if(result.isConfirmed){
                    window.location.href = getLink;
                }
            })
            return false;
        });

	function prepare_detil_ide(id)
	{
		$(".modal-body-detail").empty();

		$.getJSON('<?php echo base_url(); ?>index.php/mahasiswa/get_detail_ide_by_id/' + id,  function(data){
			$(".modal-body-detail").html(data.show_detil);
		});

		//$('#cetak_nota').attr('href','<?php echo base_url();?>index.php/transaksi/cetak_nota/' + id);
	}
</script>