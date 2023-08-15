<head>
    <script type="text/javascript">
        $('input[type="file"]').on('change', function() {
            var val = $(this).val();
            $(this).siblings('label').text(val);
        });
    </script>
</head>
<div class="grid-container">

        <div class="card card-outline-secondary container table-responsive" style="padding: 50px;">
		<h6 class="mb-3">List Pengumpulan Berkas</h6>
        <a href="#" style="width: 140px;" class="btn btn-info btn-sm text-light mb-3" data-toggle="modal" data-target="#modal_tambah_berkas"><i class="fas fa-plus"></i> Tambah Berkas</a>
		<div>
            <div>
                <table class="table table-hover" style="font-size: 12px;" id="table-pul">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Berkas</th>
                            <th scope="col" style="width: 50px;">Link Pengumpulan</th>
                            <th scope="col">File Berkas</th>
                            <th scope="col" style="width: 60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            if ($kegiatan != FALSE) {
                                    foreach ($kegiatan->result() as $k) {
                                    echo '
                                        <tr>
                                            <th scope="row">'.$no.'</th>
                                            <td>'.htmlentities($k->NamaBerkas).'</td>
                                            <td><a href="'.htmlentities($k->LinkPengumpulan).'" target="_BLANK">'.htmlentities($k->LinkPengumpulan).'</a></td>
                                            <td>
                                            <a href="'. base_url('assets/Berkas Pelengkap/'.$k->FileKegiatan).'" target="_BLANK">
                                                '.$k->FileKegiatan.'
                                            </a>
                                            </td>
                                            <td>
                                                <a style="font-size:10px;" href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_berkas" onclick="prepare_edit_berkas('.$k->ID.')"><i class="fas fa-pencil-alt text-light"></i></a>
                                                <a style="font-size:10px;" href="'.base_url('Adminprodi/hapusBerkas/'.$k->ID).'" class="btn btn-danger btn-sm remove"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    ';
                                    $no++;
                                }
                            } else{
                                echo '';
                            }
                            
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
	</div>

<div id="modal_tambah_berkas" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <h6>Tambah Pengumpulan Berkas</h6><br>
    <form method="POST" action="<?= base_url('Adminprodi/tambahBerkas') ;?>" enctype="multipart/form-data">
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
        <div class="form-row">
            <div class="form-group col-md col">
                <select name="nama_giat" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="Nilai Akhir Seminar">Nilai Akhir Seminar</option>
                    <option value="Nilai Akhir Sidang">Nilai Akhir Sidang</option>
                    <option value="Catatan Perbaikan">Catatan Perbaikan</option>
                    <option value="Berita Acara">Berita Acara</option>
                    <option value="Penilaian Seminar">Penilaian Seminar</option>
                    <option value="Penilaian Sidang">Penilaian Sidang</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md col">
                <textarea class="form-control form-control-sm"  name="link" id="link" placeholder="Link Pengumpulan" required></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" id="filegiat" name="filegiat" class="custom-file-input col custom-file-control" enctype="multipart/form-data" required>
                    <label class="custom-file-label">File Kegiatan</label>                   
                </div>
            </div>
            <small>Unggah File Berkas</small>

        </div>
        <div>
            <button class="btn btn-outline-primary" type="submit"> Tambah </button>
        </div>

    </form>
    </div>
</div>
<div id="modal_edit_berkas" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-content bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <h6>Edit Berkas</h6><br>
    <form method="POST" action="<?= base_url('Adminprodi/updateBerkas') ;?>" enctype="multipart/form-data">
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
        <input type="hidden" name="edit_id" id="edit_id">
        <div class="form-row">
            <div class="form-group col-md col">
                <select name="edit_nama_giat" class="form-control" required>
                    <option value="Nilai Akhir Seminar">Nilai Akhir Seminar</option>
                    <option value="Nilai Akhir Sidang">Nilai Akhir Sidang</option>
                    <option value="Catatan Perbaikan">Catatan Perbaikan</option>
                    <option value="Berita Acara">Berita Acara</option>
                    <option value="Penilaian Seminar">Penilaian Seminar</option>
                    <option value="Penilaian Sidang">Penilaian Sidang</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md col">
                <textarea class="form-control form-control-sm"  name="edit_link" id="edit_link" placeholder="Link Pengumpulan" required></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" id="edit_filegiat" name="edit_filegiat" class="custom-file-input col custom-file-control" enctype="multipart/form-data" required>
                    <label class="custom-file-label">File Kegiatan</label>                   
                </div>
            </div>
            <small>Unggah File Berkas</small>

        </div>
        <div>
            <button class="btn btn-outline-primary" type="submit"> Simpan </button>
        </div>

    </form>
    </div>
</div>
<style type="text/css">

</style>
<script type="text/javascript">
    $(document).ready(function () {
      $('#table-pul').DataTable();
    });

    function prepare_edit_berkas(id)
    {
        $("#edit_id").empty();
        $("#edit_nama_giat").val();
        $("#edit_link").empty();

        $.getJSON('<?php echo base_url(); ?>index.php/adminprodi/get_berkas_by_id/' + id,  function(data){
            $("#edit_id").val(data.ID);
            $("#edit_nama_giat").val(data.NamaBerkas);
            $("#edit_link").val(data.LinkPengumpulan);
        });
    }

    $('.remove').on('click',function(){
        var getLink = $(this).attr('href');
        var pesan = "Yakin ingin menghapus Berkas?";
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