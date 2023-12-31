<head>
	<script type="text/javascript">
		$(document).ready(function () {
			// berfungsi untuk menghapus data
			$(".hapusNotif").on('click', (function (e) {
				e.preventDefault();
				var form = $(this);
				var formdata = false;
				var id = $(this).attr("id");

				if (window.FormData) {
					formdata = new FormData(form[0]);
				}
				swal({
						title: "Menghapus Pemberitahuan?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								type: "POST",
								url: form.attr("href"),
								data: formdata ? formdata : form.serialize(),
								contentType: false,
								processData: false,
								cache: false,
								success: function () {
									$("#Notifikasi").load('ControllerGlobal/notifikasi');
								}
							});
						} else {
							swal("Data Tidak Dihapus!");
						}
					});
			}));
		});

	</script>
	<style type="text/css">
      .modal-dialog{
        width: 800px;
      }
      .email-app {
        display: flex;
      }

      .email-app .email-toolbars-wrapper {
        background-color: #ffffff;
        width: 20%;
        margin-right: 1.5rem;
        border-radius: 4px;
        box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
      }

      .email-app .email-toolbars-wrapper .toolbar-header {
        padding: 1rem;
        flex-flow: row;
        display: flex;
        align-items: center;
      }

      .email-app .email-toolbars-wrapper .toolbar-header .btn-compose-mail {
        background: #F4F7FD;
        font-weight: 300;
        letter-spacing: .5px;
        border: none;
        transition: all, 0.3s;
        color: #ffffff;
        background-image: -webkit-linear-gradient(left, #22b9ff 0%, rgba(34, 185, 255, 0.7) 100%);
        background-image: -o-linear-gradient(left, #22b9ff 0%, rgba(34, 185, 255, 0.7) 100%);
        background-image: linear-gradient(to right, #22b9ff 0%, rgba(34, 185, 255, 0.7) 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FF22B9FF', endColorstr='#B322B9FF', GradientType=1);
      }

      @media (prefers-reduced-motion: reduce) {
        .email-app .email-toolbars-wrapper .toolbar-header .btn-compose-mail {
          transition: none;
        }
      }

      .email-app .email-toolbars-wrapper .toolbar-header .btn-compose-mail svg {
        color: #ffffff;
        width: 22px;
        height: 22px;
      }

      .email-app .email-toolbars-wrapper .toolbar-header .btn-compose-mail:hover {
        box-shadow: 0px 1px 6px 0px rgba(34, 185, 255, 0.75);
      }

      .email-app .email-toolbars-wrapper .toolbar-body .toolbar-title {
        color: #727686;
        padding: 0 1rem .5rem 1rem;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .toolbar-menu {
        padding: 0;
        margin-bottom: 1rem;
        height: auto;
        list-style-type: none;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .toolbar-menu li {
        display: flex;
        align-items: center;
        padding: .5rem 1rem;
        transition: 0.4s;
        position: relative;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .toolbar-menu li:hover {
        color: #22b9ff;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .toolbar-menu li:hover a {
        color: #22b9ff;
        font-weight: 600;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .toolbar-menu li svg {
        margin-right: 0.625rem;
        width: 1rem;
        height: 1rem;
        line-height: 1.5;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .toolbar-menu li a {
        flex: 1;
        color: #394044;
        font-size: 14px;
        text-decoration: none;
        transition: all, 0.3s;
      }

      @media (prefers-reduced-motion: reduce) {
        .email-app .email-toolbars-wrapper .toolbar-body .toolbar-menu li a {
          transition: none;
        }
      }

      .email-app .email-toolbars-wrapper .toolbar-body .toolbar-menu li.active a {
        color: #22b9ff;
        font-weight: 600;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .toolbar-menu li.active svg {
        color: #22b9ff;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-header {
        padding: 1rem;
        justify-content: space-between;
        display: flex;
        align-items: center;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-header .contact-left {
        display: flex;
        align-items: center;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-header .contact-left .title {
        margin: 0 1rem 0 0;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-header .dropdown {
        float: right;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list {
        padding: 0 1rem;
        list-style-type: none;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item {
        padding: .625rem 0;
        display: block;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item:last-child {
        border-bottom: 0;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item a {
        text-decoration: none;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item a .pro-pic {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        padding: 0;
        width: 20%;
        max-width: 40px;
        position: relative;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item a .pro-pic img {
        max-width: 100%;
        width: 100%;
        border-radius: 100%;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item a .pro-pic .active {
        width: 12px;
        height: 12px;
        background: #17d1bd;
        border-radius: 100%;
        position: absolute;
        top: 6px;
        right: -4px;
        border: 2px solid #ffffff;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item a .pro-pic .inactive {
        width: 12px;
        height: 12px;
        background: #dde1e9;
        border-radius: 100%;
        position: absolute;
        top: 6px;
        right: -4px;
        border: 2px solid #ffffff;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item a .pro-pic .busy {
        width: 12px;
        height: 12px;
        background: #F95062;
        border-radius: 100%;
        position: absolute;
        top: 6px;
        right: -4px;
        border: 2px solid #ffffff;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item a .user {
        width: 100%;
        padding: 5px 10px 0 15px;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item a .user .user-name {
        margin: 0;
        font-weight: 400;
        font-size: 13px;
        line-height: 1;
        color: #394044;
      }

      .email-app .email-toolbars-wrapper .toolbar-body .contact-list .contact-list-item a .user .user-designation {
        font-size: 12px;
        color: #727686;
        overflow: hidden;
        max-width: 100%;
        white-space: nowrap;
        margin-bottom: 0;
      }

      .email-app .email-list-wrapper {
        width: 100%;
        margin-right: 1.5rem;
      }

      .email-app .email-list-wrapper .email-list-scroll-container {
        height: 100vh;
        position: relative;
      }

      .email-app .email-list-wrapper .email-list-header {
        padding: 1rem 0;
        flex-direction: row;
        justify-content: space-between;
        display: flex;
        align-items: center;
      }

      .email-app .email-list-wrapper .email-list {
        height: calc(100vh - 70px);
        list-style-type: none;
        padding: 0;
      }

      .email-app .email-list-wrapper .email-list .email-list-item {
        margin-bottom: 1.2rem;
        background-color: #ffffff;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        border-radius: 4px;
        box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
      }

      .email-app .email-list-wrapper .email-list .email-list-item.active {
        border: 1.5px solid #22b9ff;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .recipient {
        display: flex;
        align-items: center;
        flex-shrink: 0;
        padding: 0;
        margin-bottom: .7rem;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .recipient img {
        margin-right: .5rem;
        width: 40px;
        height: 40px;
        border-radius: 100%;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .recipient .recipient-name {
        font-weight: 500;
        font-size: 14px;
        line-height: 1;
        color: #727686;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .recipient .recipient-name:hover {
        color: #22b9ff;
        text-decoration: none;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-subject {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #394044;
        font-size: 1rem;
        font-weight: 400;
        margin-bottom: .7rem;
        text-decoration: none;
        line-height: 1.5;
        transition: all, 0.3s;
      }

      @media (prefers-reduced-motion: reduce) {
        .email-app .email-list-wrapper .email-list .email-list-item .email-subject {
          transition: none;
        }
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-subject .unread {
        flex-shrink: 0;
        margin-left: 1rem;
        width: .5rem;
        height: .5rem;
        border-radius: 100%;
        display: block;
        background: #22b9ff;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-subject:hover {
        color: #22b9ff;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-footer .email-action a {
        margin-right: .2rem;
        transition: all, 0.3s;
      }

      @media (prefers-reduced-motion: reduce) {
        .email-app .email-list-wrapper .email-list .email-list-item .email-footer .email-action a {
          transition: none;
        }
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-footer .email-action a.starred {
        color: #fd7e14;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-footer .email-action a.starred .fill {
        stroke-width: 1px;
        fill: #fd7e14;
        color: #fd7e14;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-footer .email-action a.important {
        color: #ffc107;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-footer .email-action a.important .fill {
        stroke-width: 1px;
        fill: #ffc107;
        color: #ffc107;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-footer .email-action a.attachment {
        color: #727686;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-footer .email-action a.attachment:hover {
        color: #22b9ff;
        text-decoration: none;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-footer .email-action a svg {
        width: 20px;
        height: 20px;
      }

      .email-app .email-list-wrapper .email-list .email-list-item .email-footer .email-time {
        color: #B1BAC5;
      }

      .email-app .email-desc-wrapper {
        width: 50%;
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 4px;
        box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
      }

      .email-app .email-desc-wrapper .email-header {
        margin-bottom: 1.5rem;
      }

      .email-app .email-desc-wrapper .email-header .email-date {
        color: #727686;
        font-size: 13px;
        margin-bottom: .5rem;
      }

      .email-app .email-desc-wrapper .email-header .email-subject {
        color: #394044;
        font-size: 1.2rem;
        line-height: 1.5;
        font-weight: 500;
        margin-bottom: .8rem;
        flex-shrink: 0;
      }

      .email-app .email-desc-wrapper .email-header .recipient {
        margin: 0;
        font-size: 14px;
        line-height: 1;
        color: #727686;
      }

      .email-app .email-desc-wrapper .email-header .recipient span {
        font-weight: 500;
        color: #394044;
      }

      .email-app .email-desc-wrapper .email-body {
        min-height: 350px;
        color: #727686;
        margin-bottom: 2rem;
      }

      .email-app .email-desc-wrapper .email-body p {
        font-size: 13px;
        margin-bottom: 1rem;
        line-height: 2;
      }

      .email-app .email-desc-wrapper .email-attachment {
        margin-bottom: 2rem;
      }

      .email-app .email-desc-wrapper .email-attachment .file-info {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
      }

      .email-app .email-desc-wrapper .email-attachment .file-info .file-size {
        color: #B1BAC5;
        margin-right: .5rem;
        display: flex;
        align-items: center;
      }

      .email-app .email-desc-wrapper .email-attachment .file-info .file-size svg {
        width: 20px;
        height: 20px;
        margin-right: .5rem;
      }

      .email-app .email-desc-wrapper .email-attachment .file-info .btn,
      .email-app .email-desc-wrapper .email-attachment .file-info .wizard>.actions a,
      .wizard>.actions .email-app .email-desc-wrapper .email-attachment .file-info a,
      .email-app .email-desc-wrapper .email-attachment .file-info .fc button,
      .fc .email-app .email-desc-wrapper .email-attachment .file-info button {
        font-size: 13px;
        margin-right: .5rem;
        padding: 0.1875rem .7rem;
        box-shadow: none;
      }

      .email-app .email-desc-wrapper .email-attachment .attachment-list {
        padding: 0;
        height: 100%;
      }

      .email-app .email-desc-wrapper .email-attachment .attachment-list .attachment-list-item {
        display: inline-block;
        text-align: center;
        vertical-align: middle;
        width: 80px;
        height: 80px;
        overflow: hidden;
        margin: 0 .5rem .5rem 0;
        background-color: #d3f1ff;
        border-radius: 4px;
      }

      .email-app .email-desc-wrapper .email-attachment .attachment-list .attachment-list-item span {
        height: 80px;
        display: table-cell;
        vertical-align: middle;
        width: 80px;
        font-weight: 300;
        font-size: 1.5rem;
      }

      .email-app .email-desc-wrapper .email-attachment .attachment-list .attachment-list-item img {
        width: 100%;
        height: 100%;
      }

      .email-app .email-desc-wrapper .email-attachment .attachment-list .attachment-list-item:hover {
        cursor: pointer;
      }

      .email-app .email-desc-wrapper .email-action .btn,
      .email-app .email-desc-wrapper .email-action .wizard>.actions a,
      .wizard>.actions .email-app .email-desc-wrapper .email-action a,
      .email-app .email-desc-wrapper .email-action .fc button,
      .fc .email-app .email-desc-wrapper .email-action button {
        margin-right: .7rem;
      }

      .email-app .email-desc-wrapper .email-action .btn:first-child i,
      .email-app .email-desc-wrapper .email-action .wizard>.actions a:first-child i,
      .wizard>.actions .email-app .email-desc-wrapper .email-action a:first-child i,
      .email-app .email-desc-wrapper .email-action .fc button:first-child i,
      .fc .email-app .email-desc-wrapper .email-action button:first-child i {
        font-size: 13px;
        margin-left: .5rem;
      }

      .email-app .email-desc-wrapper .email-action .btn:last-child i,
      .email-app .email-desc-wrapper .email-action .wizard>.actions a:last-child i,
      .wizard>.actions .email-app .email-desc-wrapper .email-action a:last-child i,
      .email-app .email-desc-wrapper .email-action .fc button:last-child i,
      .fc .email-app .email-desc-wrapper .email-action button:last-child i {
        font-size: 13px;
        margin-right: .5rem;
      }

      @media (max-width: 575px) {

        .email-app .email-toolbars-wrapper,
        .email-app .email-desc-wrapper {
          display: none;
        }

        .email-app .email-list-wrapper {
          width: 100%;
          margin: 0;
        }
      }

      @media (min-width: 600px) and (max-width: 1024px) {
        .email-app .email-toolbars-wrapper {
          display: none;
        }

        .email-app .email-desc-wrapper {
          width: 60%;
        }

        .email-app .email-list-wrapper {
          width: 40%;
        }
      }
    </style>
</head>

<div id="Notifikasi">
	<?php if ($_SESSION['Status'] === 'Mahasiswa') { ?>
	<div class='card container' style="overflow: auto; background-color: white; border: none; padding:30px; margin-bottom: 10px;" >
		<h6 class="mb-3">Perkembangan Tugas Akhir</h6>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:40%">40%</div>
		</div>
	</div>
	<?php }?>

	<?php if (!$Notifikasi) { ?>
	<div class="card">
		<div class='row align-items-center m-4'>
			<div class='col-md'>
				<?php if ($_SESSION['Status'] === 'Dosen') { ?>
				<h2>Selamat Datang,
					<?= $_SESSION['Nama']?>.</h2>
				Pemberitahuan masih kosong, ini halaman dimana anda sebagai pembimbing menerima notifikasi dari prodi/pokil mengenai tugas akhir dan mahasiswa yang anda bimbing untuk melihat mahasiswa siapa yang anda bimbing. Anda bisa melihat di navigasi Tugas Akhir.
				<?php }

				elseif ($_SESSION['Status'] === 'TugasAkhir') { ?>
				<h2>Selamat Datang,
					<?= $_SESSION['Nama']?>. Sang Pejuang Tugas Akhir.</h2>
				Selamat ya karena menempuh semester akhir dimana setiap mahasiswa PoltekSSN pasti akan mengalami yang namanya Fase pengerjaan Tugas Akhir. Saat ini Pemberitahuanmu Kosong. Di Navigasi Idea Concept Paper Kamu Bisa mengajukan ide TA yang mungkin kamu punya. Jadi bersiap siaplah jika sering di <b>TOLAK</b>. Semangat untuk tugas akhirmu !!!
				<?php }

				elseif ($_SESSION['Status'] === 'Mahasiswa') { ?>
				<h2>Selamat Datang,
					<?= $_SESSION['Nama']?>. Mahasiswa Baru Ya.</h2>
				Saat ini sistem hanya bisa melakukan login ! sistem ini akan bisa di gunakan jika admin telah menerima dan memvalidasimu jika kau sudah mulai melakukan tugas akhir ! tetep semangat ya menjalani kehidupanmu di kampus !!! Jika kamu sudah memasuki semester akhir dan masih belum bisa mengakses ide tugas akhir. silahkan tanyakan ke jurusan yah.
				<?php } ?>
			</div>
			<div class='col-md-3'>
				<img class="card-img-top" src="<?= base_url('assets/web/jelaskan.jpg')?>">
			</div>
		</div>
	</div>
	<?php } else { ?>
	<div class='card container' style="padding-top: 30px; padding-left: 30px; padding-bottom: 30px; overflow: auto; height: 480px;" >
		<h6 class="mb-3">Notifikasi</h6>
		
			<div class="content-wrapper">
        <div class="email-app card-margin">
          <div class="email-list-wrapper">
            <div id="email-app-body" class="email-list-scroll-container ps ps--active-y">
              <ul class="email-list">
              	<?php foreach ($Notifikasi->result() as $p) { ?>
                <li class="email-list-item active">
                  <div class="recipient">
                    <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="Profile Picture" />
                    <a href="#" class="recipient-name">Admin Jurusan <?php echo substr($p->Penerima, 10);?></a>
                  </div>
                  <a href="#" class="email-subject"><?php echo htmlentities($p->Judul);?>
                  </a>
                  <div class="email-footer">
                    <div class="email-action">
                        <a href="#" class="btn btn-primary btn-sm" style="width:30px;height: 30px;" data-toggle="modal" data-target="#modal_detail" onclick="prepare_detil_pum(<?php echo ($p->ID);?>)"><i class="fas fa-eye text-light" style="width: 13px;"></i></a>
                      <?php 
                        if ($_SESSION['Status'] === 'Dosen') {
                      ?>
                            <a style="width:30px;height: 30px;" href="<?php echo base_url('Adminprodi/hapusNotif/'.$p->ID);?>" class="btn btn-danger btn-sm remove"><i class="fas fa-trash-alt" style="width: 13px;"></i></a>
                      <?php
                        }
                      ?>
                    </div>
                    <span class="email-time"><?php echo $p->TanggalPengumuman;?></span>
                  </div>
                </li>
                  <?php }?>
              </ul>
            </div>
          </div>
        </div>
      	</div>

		
	</div>
<?php }?>

</div>
  <div id="modal_detail" class="modal fade" role="dialog">
      <div class="modal-dialog modal-content modal-lg bg-light rounded h-80 p-4" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div>
          <div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h6 class="mb-4">Pengumuman</h6>
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
  <script type="text/javascript">
    
    function prepare_detil_pum(id)
    {
      $(".modal-body-detail").empty();

      $.getJSON('<?php echo base_url(); ?>index.php/ControllerGlobal/get_detail_pum_by_id/' + id,  function(data){
        $(".modal-body-detail").html(data.show_detil);
      });

      //$('#cetak_nota').attr('href','<?php echo base_url();?>index.php/transaksi/cetak_nota/' + id);
    }
    $('.remove').on('click',function(){
        var getLink = $(this).attr('href');
        var pesan = "Yakin ingin menghapus Pengumuman?";
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