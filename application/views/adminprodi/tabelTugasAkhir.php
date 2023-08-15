<head>

</head>

<div class="card card-outline-secondary container table-responsive" style="padding: 50px;">
	<?php if (!$ta3) { ?>
		<div class="row align-items-center m-5">
			<div class="col-md mb-5">
				<h2> Tidak Ada Mahasiswa yang Memulai Tugas Akhir </h2>
				Maaf saat ini tidak ada yang memulai Tugas Akhir.

			</div>
			<div class="col-md-3">
				<img src="<?= base_url('assets/web/sad.jpg') ?>">
			</div>
		</div>

	<?php } else{ ?>
		<h5>Tugas Akhir Mahasiswa</h5>
		<table class="table table-hover" style="margin-bottom: 20px; font-size: 10px;" id="table-ta" >
			<thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col" style="width:400px;">Judul</th>
                    <th scope="col">Proposal</th>
                    <th scope="col">Tugas Akhir</th>
                    <th scope="col">Ketua Penguji</th>
                    <th scope="col">Penguji 1</th>
                    <th scope="col">Penguji 2</th>
                    <th scope="col">Nilai Proposal</th>
                    <th scope="col">Nilai 70</th>
                    <th scope="col">Nilai 100</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width:10000px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                	foreach ($ta3->result() as $m) {
                    		
	                        echo '
	                            <tr>
	                            	<td>'.$no.'</td>
	                            	<td>'.htmlentities($m->Nama).'</td>
	                                <td>'.htmlentities($m->JudulIde).'</td>
	                                <td><a href="'. base_url('assets/Proposal/'.$m->FileProposal).'" target="_BLANK">'.htmlentities($m->FileProposal).'</a>
	                                </td>
	                                <td><a href="'. base_url('assets/TugasAkhir100/'.$m->FileTugasAkhir).'" target="_BLANK">'.htmlentities($m->FileTugasAkhir).'</a>
	                                </td>
	                                <td>'.htmlentities($m->NamaKetuaPenguji).'</td>
	                                <td>'.htmlentities($m->NamaPenguji1).'</td>
	                                <td>'.htmlentities($m->NamaPenguji2).'</td>
	                                <td>'.htmlentities($m->nilai1).'</td>
	                                <td>'.htmlentities($m->nilai2).'</td>
	                                <td>'.htmlentities($m->nilai3).'</td>
	                                <td><span class="badge badge-warning rounded-pill d-inline">'.htmlentities($m->StatusTA).'</span></td>
	                                <td>
		                        		<a style="font-size:8px;" href="#" class="btn btn-info btn-sm btn-tambah-penguji" data-toggle="modal" data-target="#modal_tambah_penguji" onclick="prepare_tambah('.htmlentities($m->IDTugasAkhir).','.htmlentities($m->IDDosen).')"><i class="fas fa-plus text-light"></i></a>
		                        		<a style="width: 35px; height: 25px; font-size:10px;" href="#" class="btn btn-primary btn-sm btn-tambah-nilai text-light" data-toggle="modal" data-target="#modal_tambah_nilai" onclick="prepare_nilai('.htmlentities($m->IDTugasAkhir).')">Nilai</a>
		                        		<a style="font-size:10px;" href="#" class="btn btn-success btn-sm btn-tambah-penguji" href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_edit_penguji" onclick="prepare_edit_penguji('.htmlentities($m->IDTugasAkhir).','.htmlentities($m->IDDosen).','.htmlentities($m->IDKetuaPenguji).','.htmlentities($m->IDPenguji2).')"><i class="fas fa-pencil-alt text-light"></i></a>
		                            </td>
		                        	';
		                        	
	                        	

	                        echo '
	                            </tr>';    
	                                
	                        $npm = htmlentities($m->ID);
	                        $no++;

                    	
                    }
                    
                    
                ?>
            </tbody>
    	</table>
    	<?php }
    	?>
    
</div>
<div id="modal_tambah_penguji" class="modal fade" role="dialog">
    <div class="modal-dialog modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    	<div>
    		<div>
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h6 class="mb-4">Tambah Penguji</h6>
	    	</div>
	        <form action="<?= base_url('Adminprodi/tambahPengujiTA/1') ;?>" method="post">
	        	<div>
	        		<input type="hidden" id="tambah_id_ta" name="tambah_id_ta">
	        		<input type="hidden" id="tambah_pmb" name="tambah_pmb">
		            <label>Ketua Penguji</label>
					<select name="tambah_pilihan_penguji" id="tambah_pilihan_penguji" class="form-control" required>
						<option value="" >Pilih</option>
						<?php
						foreach ($dosen->result() as $d) {
							echo "<option value='" . htmlentities($d->IDDosen) . "'>" . htmlentities($d->NamaDosen) . "</option>";
						}
						?>
					</select>
					<br>

		        </div>
		        <div>
		            <label>Penguji 2</label>
					<select name="tambah_pilihan_penguji2" id="tambah_pilihan_penguji2" class="form-control" required>
						<option value="" >Pilih</option>
						<?php
						foreach ($dosen->result() as $d) {
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

<div id="modal_edit_penguji" class="modal fade" role="dialog">
    <div class="modal-dialog modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    	<div>
    		<div>
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h6 class="mb-4">Edit Penguji</h6>
	    	</div>
	        <form action="<?= base_url('Adminprodi/tambahPengujiTA/2') ;?>" method="post">
	        	<div>
	        		<input type="hidden" id="edit_id_ta" name="edit_id_ta">
	        		<input type="hidden" id="edit_pmb" name="edit_pmb">
		            <label>Ketua Penguji</label>
					<select name="edit_pilihan_penguji" id="edit_pilihan_penguji" class="form-control" required>
						<?php
						foreach ($dosen->result() as $d) {
							echo "<option value='" . htmlentities($d->IDDosen) . "'>" . htmlentities($d->NamaDosen) . "</option>";
						}
						?>
					</select>
					<br>

		        </div>
		        <div>
		            <label>Penguji 2</label>
					<select name="edit_pilihan_penguji2" id="edit_pilihan_penguji2" class="form-control" required>
						<?php
						foreach ($dosen->result() as $d) {
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

<div id="modal_tambah_nilai" class="modal fade" role="dialog">
    <div class="modal-dialog modal-content modal-lg bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    	<div>
    		<div>
		    	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h6 class="mb-4">Tambah Nilai</h6>
	    	</div>
	        <form action="<?= base_url('Adminprodi/tambahNilai') ;?>" method="post">
	        	<input type="hidden" id="nilai_id_ta" name="nilai_id_ta">
	        	<div class="container">
	        		<div class="form-row">
						<div class="form-group col-md col">
							<label><strong>Nilai apa yang ingin diinputkan?</strong></label>
							<select name="giat" class="form-control" required>
								<option value="">Pilih</option>
								<?php
								foreach ($kegiatan->result() as $d) {
									echo "<option value='" . $d->ID . "'>" . $d->Kegiatan . "</option>";
								}
								?>
			                </select>
						</div>
					</div>
	        		<div class="row">
	        			<label><strong>Penilaian Ketua Penguji</strong></label>
	        			<div class="col">
	        				<div class="form-row">
								<div class="form-group col-md col">
									<input class="form-control form-control-sm" type="number" name="kp_dokumen" id="kp_dokumen" placeholder="Penilaian Dokumen" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md col">
									<input class="form-control form-control-sm" type="number" name="kp_penulisan" id="kp_penulisan" placeholder="Penilaian Penulisan" required>
								</div>
							</div>
	        			</div>
	        			<div class="col">
	        				<div class="form-row">
								<div class="form-group col-md col">
									<input class="form-control form-control-sm" type="number" name="kp_penyajian" id="kp_penyajian" placeholder="Penilaian Penyajian/Presentasi" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md col">
									<input class="form-control form-control-sm" type="number" name="kp_pengetahuan" id="kp_pengetahuan" placeholder="Penilaian Pengetahuan" required>
								</div>
							</div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<label><strong>Penilaian Penguji 1</strong></label>
	        			<div class="col">
	        				<div class="form-row">
								<div class="form-group col-md col text-dark">									
									<input class="form-control form-control-sm" type="number" name="p1_dokumen" id="p1_dokumen" placeholder="Penilaian Dokumen" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md col">
									<input class="form-control form-control-sm" type="number" name="p1_penulisan" id="p1_penulisan" placeholder="Penilaian Penulisan" required>
								</div>
							</div>
	        			</div>
	        			<div class="col">
	        				<div class="form-row">
								<div class="form-group col-md col">
									<input class="form-control form-control-sm" type="number" name="p1_penyajian" id="p1_penyajian" placeholder="Penilaian Penyajian/Presentasi" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md col">
									<input class="form-control form-control-sm" type="number" name="p1_pengetahuan" id="p1_pengetahuan" placeholder="Penilaian Pengetahuan" required>
								</div>
							</div>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<label><strong>Penilaian Penguji 2</strong></label>
	        			<div class="col">
	        				<div class="form-row">
								<div class="form-group col-md col text-dark">									
									<input class="form-control form-control-sm" type="number" name="p2_dokumen" id="p2_dokumen" placeholder="Penilaian Dokumen" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md col">
									<input class="form-control form-control-sm" type="number" name="p2_penulisan" id="p2_penulisan" placeholder="Penilaian Penulisan" required>
								</div>
							</div>
	        			</div>
	        			<div class="col">
	        				<div class="form-row">
								<div class="form-group col-md col">
									<input class="form-control form-control-sm" type="number" name="p2_penyajian" id="p2_penyajian" placeholder="Penilaian Penyajian/Presentasi" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md col">
									<input class="form-control form-control-sm" type="number" name="p2_pengetahuan" id="p2_pengetahuan" placeholder="Penilaian Pengetahuan" required>
								</div>
							</div>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
	  $('#table-ta').DataTable();
	  $('#table-ta2').DataTable();

	  // Function to add options to a select element
	  function addOption(select, text, value) {
	    const option = new Option(text, value);
	    select.add(option);
	  }
	  });
	
	function prepare_tambah(id,iddosen)
	{
		$("#tambah_id_ta").val(id);
		$("#tambah_pmb").val(iddosen);
	}

	function prepare_edit_penguji(id,iddosen,idketua,idpenguji2)
	{
			$("#edit_id_ta").val(id);
			$("#edit_pmb").val(iddosen);
			$("#edit_pilihan_penguji").val(idketua);
			$("#edit_pilihan_penguji2").val(idpenguji2);
	}

	function prepare_nilai(id)
	{
		$("#nilai_id_ta").empty();
		$("#nilai_id_ta").val(id);
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
	
</script>