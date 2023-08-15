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
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login_new/change_pwd.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css');?>">
	
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/sweetalert.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.validate.min.js');?>"></script>

</head>

<body>
	<div class="limiter">
         <div class="container-login100" style="background-image: url('assets/web/ta3.jpg'); opacity: 0.7;">
            <div class="wrap-login100">
            	<div style="background-color: white; padding:50px; width: 500px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 20px;">
            		<div>
		               <form class="login100-form validate-form" action="<?=base_url('ControllerGlobal/ubahPasswordDefault/' . $_SESSION['ID'] . '/users');?>" id="form-login" method="POST">
		                  <div class="login100-form-avatar">
		                     <img src="<?=base_url('assets/web/icon.png');?>">
		                  </div>
		                  <span class="login100-form-title p-t-20 p-b-45" style="color:#66686b;">
		                  <h5>Perbarui Password Anda!</h5>
		                  </span>
		                  <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		                  <?php
									$notif = $this->session->flashdata('notif');
									if($notif != NULL){
										echo '
											<div class="alert alert-danger">'.$notif.'</div>
										';
									}
								?>
		                  <div class="wrap-input100 validate-input m-b-10" data-validate="Old Password is required">
		                     <input class="input100" type="password" name="pass_lama" id="pass_lama" placeholder="Password Lama" style="border: 1px solid;">
		                     <span class="focus-input100"></span>
		                     <span class="symbol-input100">
		                     <i class="fa fa-user"></i>
		                     </span>
		                  </div>
		                  <div class="wrap-input100 validate-input m-b-10" data-validate="New Password is required">
		                     <input class="input100" type="password" name="pass_baru" id="pass_baru" placeholder="Password Baru" style="border: 1px solid;">
		                     <span class="focus-input100"></span>
		                     <span class="symbol-input100">
		                     <i class="fa fa-lock"></i>
		                     </span>
		                  </div>
		                  <div class="container-login100-form-btn p-t-10">
		                     <button class="login100-form-btn" id="btn-login" type="submit">
		                     Simpan
		                     </button>
		                  </div>
		               </form>
	            	</div>
               </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
<?php if(@$_SESSION['sukses']){ ?>
    <script>
    	var text2='<?php echo $_SESSION['sukses'];?>';
        Swal.fire({            
            icon: 'success',                   
            title: 'Sukses',    
            text: text2,                        
            timer: 3000,                                
            showConfirmButton: false
        })
    </script>
<?php unset($_SESSION['sukses']); } ?>
<?php if(@$_SESSION['gagal']){ ?>
    <script>
    	var text2='<?php echo $_SESSION['gagal'];?>';
        Swal.fire({            
            icon: 'error',                   
            title: 'Gagal',    
            text: text2,                        
            timer: 3000,                                
            showConfirmButton: false
        })
    </script>
<?php unset($_SESSION['gagal']); } ?>