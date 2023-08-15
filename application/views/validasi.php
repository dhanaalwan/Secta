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

</head>

<body>
	<div class="limiter">
         <div class="container-login100" style="background-image: url('assets/web/ta3.jpg');">
            <div class="wrap-login100 p-t-60 p-b-30">
               <form class="login100-form validate-form" action="<?=base_url();?><?=$this->session->userdata('keterangan');?>/validasiproses" id="form-login" method="POST" style="margin-top:none;">
						<div class="card card-body">
							<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
							<h6> Masukkan Kode OTP Yang Terkirim Ke Email Anda</h6>
							<input name="kodeotp" id="kodeotp" type="text" class="form-control form-group" placeholder="Kode OTP">
							
							<button id='btn-login' type="submit" class="btn btn-primary">Login</button>
							<p>
								batas waktu <span id="waktu"></span><br>
								<a href="<?php echo base_url() ?>">Kembali ke Home Login</a>
							</p>
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

<script type="text/javascript">
	var minutesToAdd=3;
	var currentDate = new Date();
	var countDownDate = new Date(currentDate.getTime() + minutesToAdd*60000);

	var x = setInterval(function() {

	  var now = new Date().getTime();
	    
	  var distance = countDownDate - now;
	    
	  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
	    
	  document.getElementById("waktu").innerHTML = minutes + ":" + seconds;
	    
	  if (distance < 0) {
	    clearInterval(x);
	    document.getElementById("waktu").innerHTML = "00:00";
	  }
	}, 1000);
</script>