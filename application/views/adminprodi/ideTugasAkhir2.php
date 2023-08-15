<head>

</head>

<div class="card card-outline-secondary container table-responsive" style="padding: 50px;">
	<?php if (!$idetugasakhir) { ?>
		<div class="row align-items-center m-5">
			<div class="col-md mb-5">
				<h2> Tidak Ada Mahasiswa yang Mengajukan ICP </h2>
				Maaf saat ini tidak ada yang mengajukan idea concept paper.

			</div>
			<div class="col-md-3">
				<img src="<?= base_url('assets/web/sad.jpg') ?>">
			</div>
		</div>

	<?php } else { ?>
		<table class="table table-hover" id="table-ide" style="width: 100%; font-size: 10px;">
			<thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col" style="width:300px;">Judul</th>
                    <th scope="col">Dosen</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $npm = 0;
                    if (!$mahasiswagroup) {?>
                    	<div class="row align-items-center m-5">
							<div class="col-md mb-5">
								<h2> Tidak Ada Mahasiswa Program Studi <?php echo $id_prodi_user;?> yang Mengajukan ICP </h2>
								Maaf saat ini tidak ada yang mengajukan idea concept paper.
							</div>
							<div class="col-md-3">
								<img src="<?= base_url('assets/web/sad.jpg') ?>">
							</div>
						</div>
                    <?php }else{
                    	foreach ($mahasiswagroup->result() as $m) {
	                    		
		                        echo '
		                            <tr>
		                            	<td>'.$no.'</td>
		                            	<td>'.htmlentities($m->Nama).'</td>
		                                <td>'.htmlentities($m->JudulIde).'</td>
		                                <td>'.htmlentities($m->NamaDosen).'</td>';
		                        if ($m->StatusIde=='ICP Diajukan') {
		                        	echo '<td><span class="badge badge-warning rounded-pill d-inline">'.htmlentities($m->StatusIde).'</span></td>
			                        	<td>
									        <a style="font-size:10px;" href="#" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#modal_detail_icp_admin" onclick="prepare_detil_ide('.$m->IDIde.')"><i class="fas fa-info-circle"></i></a>
			                        		<a style="font-size:10px;" href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_edit" onclick="prepare_edit_dosen('.$m->IDIde.')"><i class="fas fa-pencil-alt text-light"></i></a>
			                                <a style="font-size:10px;" href="'.base_url('Adminprodi/acceptIde/'.$m->IDIde).'" class="alert-terima btn btn-success btn-sm" onclick="">Terima</i></a>
			                                <a style="font-size:10px;" href="'.base_url('Adminprodi/rejectIde/'.$m->IDIde).'" class="alert-terima btn btn-danger btn-sm" id="tolak" onclick="">Tolak</i></a>
			                                <a style="font-size:10px;" href="'.base_url('Adminprodi/hapusIde/'.$m->IDIde.'/idetugasakhir').'" class="btn btn-danger btn-sm remove"><i class="fas fa-trash-alt"></i></a>
			                            </td>
			                        	';
		                        	
		                        } else if ($m->StatusIde=='ICP Diterima' || $m->StatusIde=='ICP Ditolak') {
		                        	if ($m->StatusIde=='ICP Diterima') {
		                        		echo '
		                        			<td><span class="badge badge-success rounded-pill d-inline">'.htmlentities($m->StatusIde).'</span></td>
		                        		';
		                        	} else if ($m->StatusIde=='ICP Ditolak') {
		                        		echo '
		                        			<td><span class="badge badge-danger rounded-pill d-inline">'.htmlentities($m->StatusIde).'</span></td>
		                        		';		                        	
		                        	}
		                        	echo '<td>
		                        		<span class="fa-stack">
								        	<a href="#" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#modal_detail_icp_admin" onclick="prepare_detil_ide('.$m->IDIde.')"><i class="fas fa-info-circle"></i></a>
								        </span>
		                        	</td>';
		                        }

		                        echo '
		                            </tr>';    
		                                
		                        $npm = $m->ID;
		                        $no++;
	                    	
	                    }
                    }
                    
                ?>
            </tbody>
    	</table>



    <?php }?>
</div>
<div id="modal_edit" class="modal fade" role="dialog">
	    <div class="modal-dialog modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
	    	<div>
	    		<div>
			    	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h6 class="mb-4">Edit Dosen</h6>
		    	</div>
		        <form action="<?= base_url('Adminprodi/adminUpdateIde') ;?>" method="post" class="ideTugasAkhir">
		        	<div>
		        		<input type="hidden" id="edit_id_icp" name="edit_id_icp">
			            <label>Dosen Pembimbing</label>
						<select name="edit_pilihan_dosen" id="edit_pilihan_dosen" class="form-control" required>
							<?php
							foreach ($list_dosen as $d) {
								echo "<option value='" . htmlentities($d->IDDosen) . "'>" . htmlentities($d->NamaDosen) . "</option>";
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
		<div id="modal_detail_icp_admin" class="modal fade" role="dialog">
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
	$(document).ready(function(){
        $('#table-ide').DataTable();
    });
	function prepare_edit_dosen(id)
	{
		$("#edit_id_icp").empty();
		$("#edit_pilihan_dosen").empty();

		$.getJSON('<?php echo base_url(); ?>index.php/adminprodi/get_data_ide_by_id/' + id,  function(data){
			$("#edit_id_icp").val(data.IDIde);
			$("#edit_pilihan_dosen").val(data.IDDosen);
		});
	}
	function prepare_detil_ide(id)
	{
		$(".modal-body-detail").empty();

		$.getJSON('<?php echo base_url(); ?>index.php/adminprodi/get_detail_ide_by_id/' + id,  function(data){
			$(".modal-body-detail").html(data.show_detil);
		});

		//$('#cetak_nota').attr('href','<?php echo base_url();?>index.php/transaksi/cetak_nota/' + id);
	}
	$('.alert-terima').on('click',function(){
            var getLink = $(this).attr('href');
            var getId = $(this).attr('id');
            if (getId == 'tolak') {
            	var pesan = "Yakin tolak ICP?";
            } else{
            	var pesan = "Yakin terima ICP?";
            }
            Swal.fire({
                title: pesan,     
                text: 'Tuliskan catatan perbaikan ICP:',       
                icon: 'warning',
                input: 'textarea',
			  	inputAttributes: {
			    	autocapitalize: 'off'
			  	},
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"
            
            }).then(result => {
                //jika klik ya maka arahkan ke proses.php
                if(result.isConfirmed){
                    window.location.href = getLink +'/'+result.value;
                }
            })
            return false;
        });

	$('.remove').on('click',function(){
            var getLink = $(this).attr('href');
            var getId = $(this).attr('id');
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
</script>