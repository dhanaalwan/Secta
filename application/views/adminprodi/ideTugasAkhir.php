<head>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".ideTugasAkhir").on('submit',
				function(e) {
					e.preventDefault();
					var form = $(this);
					var formdata = false;
					var id = $(this).attr('id');
					var name = $(this).attr('name');

					if (window.FormData) {
						formdata = new FormData(form[0]);
					}

					console.log(formdata)

					swal({
							title: "Idea Concept Paper",
							text: "Terima ICP Ini",
							type: "warning",
							showCancelButton: true,
							showConfirmButton: true,
							buttons: {
								cancel: true,
								confirm: "Tolak",
								false: 'Terima'
							},
							dangerMode: true,
						})
						.then((willDelete) => {

							if (willDelete != null) {



								$.ajax({
									type: 'POST',
									url: form.attr('action') + id + '/' + willDelete,
									data: formdata ? formdata : form.serialize(),
									contentType: false,
									processData: false,
									cache: false,
									success: function(result) {
										$('#idetugasakhir').load("<?php echo base_url('adminprodi/idetugasakhir'); ?>");
									}
								});
							}
						});
				});

			$("select").change(function() {
				var set = $(this).parent().next('div');
				var result = set.children('select').hide();
				var val = $(this).val();

				$.ajax({
					type: "POST",
					url: "<?= base_url('adminprodi/filterPembimbing'); ?>",
					data: {
						pmb1: val
					},
					dataType: "json",
					success: function(response) {
						if (response.list) {
							$(set).show('fast', function() {
								$(set.children('select')).html(response.list).show();
							});
						}
					},
				});
			});

		});
	</script>
</head>

<div class="card card-outline-secondary container">
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
		<table class="p-2" border="0" style="table-layout: fixed;">
    

    <?php
	$no=1;foreach ($idetugasakhir->result() as $u) {
		?>
    <?php $icp = $u->FileICP; //$getPenangananUser = $penangananmodel->getPenangananUser($item['id_keluhan']); ?>
        <!-- Get Keluhan User -->
        <hr>
        <tr class="card m-4"  style="background-color: red;">
            <td class="card-header pt-4 ">
				<div class="form-row">
				<div class="form-group col-md-1 col-2">
						<img class="card-img-top col-md-11" src="<?= base_url($u->Foto === '' ? 'assets/web/user.png' : 'assets/images/users/' . $u->Foto); ?>" alt="Card image">
					</div>
					<div class="form-group col-md col-10 mb-2">
						<h2><?php echo $u->Nama; ?></h2>
					</div>
				</div>
				</div>
			</td>
           
            <?php if(!empty($idetugasakhirpernama)){ ?>
				
				<?php $getIde = $this->IdeModel->getIde($u->IDIdeMahasiswa); ?>


               <?php if(!empty($getIde)){ ?>
                <td class="p-4 pl-5 pr-5">
                    <?php foreach ($getIde as $ide) : ?>
                       <h4> <i class="fa fa-file"></i> <?= "<b>".htmlentities($ide['JudulIde'])."</b>"?></h4>
						<i class="fa fa-calendar"></i> <?php echo $u->TanggalIde; ?> <br><br>

						<a class="card-body" href="<?php echo base_url("ControllerGlobal/downloadFile/ICP/".$icp) ?>"><i class="fa fa-download"></i> ICP </a>

					   <hr>
						<form id="<?= $u->IDIde; ?>" method="POST" name="<?= $u->ID; ?>" action="<?= base_url('Adminprodi/acceptTugasAkhir/'); ?>" class="ideTugasAkhir">
							<div class="form-group">
								<textarea class="form-control" name="catatan" placeholder="Catatan Untuk Mahasiswa" required></textarea>
							</div>
							<label>Dosen Pembimbing</label>
							<div class="form-row">
								<div class="form-group col-md">
									<select name="pmb1" class="form-control form-control-sm" required>
										<option value="">Pilih</option>
										<?php
										foreach ($dosen->result() as $data) {
											echo "<option value='" . $data->ID . "'>" . htmlentities($data->Nama) . "</option>";
										}
										?>
									</select>
									<small>Dosen Pembimbing</small>
								</div>
								<!-- <div class="form-group col-md" style="display: none">
									<select name="pmb2" class="form-control form-control-sm" required>
									</select>
									<small>Dosen Pembimbing 2</small>
								</div> -->
								<div class="form-group">
									<button class="btn btn-sm btn-primary float-right" type="submit">Pilih</button>
								</div>
							</div>
						</form>
						<hr>
						
                    <?php endforeach ?>
                </td>
                <?php }else{ ?>
                    <td>Pending</td>
                <?php } ?>

            <?php }else{ ?>
               <td>Pending</td>
                <td>belum ada</td>
                <td>belum ada</td>
                <td>belum ada</td>
            <?php } ?>
         
        </tr>

    <?php } } ?>
</table>
	

		
		
</div>