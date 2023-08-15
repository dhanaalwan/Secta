<head>
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/web/icon.ico');?>" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title> Website SECTA</title>
	<script src="<?=base_url('assets/js/fontawesome-all.js');?>">
	</script>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login_new/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login_new/font-awesome.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login_new/icon-font.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login_new/animate.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login_new/hamburgers.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login_new/select2.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login_new/util.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login_new/main.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css');?>">
	
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/sweetalert.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.validate.min.js');?>"></script>

	<script type="text/javascript">
		$(document).ready(function () {

			$("#btn-login").click(function () {
				var formAction = $("#form-login").attr('action');
				var datalogin = {
					nim: $("#nim").val(),
					password: $("#password").val(),
					<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
				};

				if (!$("#nim").val() || !$("#password").val()) {
					swal({text: 'NPM/NIP atau password tidak boleh kosong', button: false})
					return false;
				} else {
					$.ajax({
						type: "POST",
						url: formAction,
						data: datalogin,
						beforeSend: function () {
							$('#loading').fadeIn();
						},
						success: function (result) {
							$('#loading').fadeOut('slow');
							if (result <= 4) {
								swal({title: 'Login Berhasil !',text: 'Tunggu Sebentar...', button: false});
							} else {
								swal({title: 'Login Gagal !',text: 'NPM/NIP atau Password salah !', button: false, icon: 'error', timer: 2000})
							}

							var user;
							switch (result) {
								case '1':
									user = 'Dosen';
									break;
								case '2':
									user = 'Mahasiswa';
									break;
								case '3':
									user = 'Adminprodi';
									break;
								case '4':
									user = 'Admin';
									break;
								default:
									return false;
							}
							setTimeout(function () {
								window.location = "<?=base_url();?>" + user
							}, 1000);

						}

					});
					return false;
				}
				
			});

			var htmlElement = document.documentElement.clientHeight;
			var bodyElement = document.body;
			window.scrollTo(0,(htmlElement/2)-250);

		});


	</script>
</head>

<body>
	<div class="limiter">
         <div class="container-login100" style="background-image: url('assets/web/ta3.jpg');">
            <div class="wrap-login100 p-t-190 p-b-30">
               <form class="login100-form validate-form" action="<?=base_url('Home/session');?>" id="form-login" method="POST">
                  <div class="login100-form-avatar">
                     <img src="<?=base_url('assets/web/icon.png');?>">
                  </div>
                  <span class="login100-form-title p-t-20 p-b-45">
                  <h5> Sistem E-Control Tugas Akhir (SECTA) Jurusan Kriptografi</h5>
                  </span>
                  <?php
						$notif = $this->session->flashdata('notif');
						if($notif != NULL){
							echo '
								<div class="alert alert-danger">'.$notif.'</div>
							';
						}
					?>
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                  <div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
                     <input class="input100" type="text" name="nim" id="nim" placeholder="NPM">
                     <span class="focus-input100"></span>
                     <span class="symbol-input100">
                     <i class="fa fa-user"></i>
                     </span>
                  </div>
                  <div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
                     <input class="input100" type="password" name="password" id="password" placeholder="Password">
                     <span class="focus-input100"></span>
                     <span class="symbol-input100">
                     <i class="fa fa-lock"></i>
                     </span>
                  </div>
                  <div class="container-login100-form-btn p-t-10">
                     <button class="login100-form-btn" id="btn-login" type="submit">
                     Login
                     </button>
                  </div>
                  <div class="text-center w-full p-t-25 p-b-230">
                     <a href="https://colorlib.com/etc/lf/Login_v12/index.html#" class="txt1">
                     Forgot Username / Password?
                     </a>
                  </div>
                  <div class="text-center w-full">
                     <a class="txt1" href="https://colorlib.com/etc/lf/Login_v12/index.html#">
                     Create new account
                     <i class="fa fa-long-arrow-right"></i>
                     </a>
                  </div>
               </form>
            </div>
         </div>
      </div>
</body>

<div id="loading" class="modal" style="display:none; background-color:rgba(0, 0, 200, 0.5);">
	<div class="modal-dialog modal-dialog-centered ">
		<div class="alert alert-info alert-white rounded modal-content">
			<strong> <i class="fas fa-spinner fa-pulse"> </i> Sedang Memproses </strong>
		</div>
	</div>
</div>
<div id="success" class="modal" style="display:none; background-color:rgba(200, 0, 0, 0.5);">
	<div class="modal-dialog modal-dialog-centered ">
		<div class="alert alert-success alert-white rounded modal-content">
			<strong> <i class="fas fa-check"></i> Login Success !</strong>
		</div>
	</div>
</div>
<div id="warning" class="modal" style="display:none;">
	<div class="modal-dialog modal-dialog-centered ">
		<div class="alert alert-warning alert-white rounded modal-content">
			<strong> <i class="fas fa-exclamation"></i> Peringatan !</strong>
			Nama akun dan/atau kata sandi tidak boleh kosong!
		</div>
	</div>
</div>

<div id="failed" class="modal" style="display:none;">
	<div class="modal-dialog modal-dialog-centered ">
		<div class="alert alert-failed alert-white rounded modal-content">
			<strong><i class="fas fa-user-times"></i> Login gagal !</strong>
			Nama akun dan/atau kata sandi salah!
		</div>
	</div>
</div>
<div id="not" class="modal" style="display:none;">
	<div class="modal-dialog modal-dialog-centered ">
		<div class="alert alert-failed alert-white rounded modal-content">
			<strong><i class="fas fa-user-times"></i> Pendaftaran Belum Di Konfirmasi / Anda Belum Tugas Akhir !</strong>
			Silahkan Cek Ke Jurusan Untuk Informasi Lebih Lanjut!
		</div>
	</div>
</div>

<form id="form_forget" action="<?=base_url('home/lupa');?>" style="display: none">
	<div id="lupa" class="row">
		<div class="form-group col-md">
			<input class="form-control" type="email" name="email" placeholder="Masukan Email">
			<small>Silahkan Masukan Email Untuk Mereset Password</small>
		</div>
		<div class="form-group col-3">
			<input class="btn btn-primary" type="submit" name="btnSubmit" value="Submit" />
		</div>
	</div>
</form>
<div id="tabelformDaftar" style="display: none;">
</div>
<div id="log" style="display: none;">
	<small class="form-text text-muted" id="text-login"> Sudah Punya Akun? Silahkan <a href="#" class="daftar text-primary">
			Login </a>
	</small>
</div>

