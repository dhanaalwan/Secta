<!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
<style type="text/css">


/* USER LIST TABLE */
.user-list tbody td > img {
    position: relative;
	max-width: 50px;
	float: left;
	margin-right: 15px;
}
.user-list tbody td .user-link {
	display: block;
	font-size: 1.25em;
	padding-top: 3px;
	margin-left: 60px;
}
.user-list tbody td .user-subhead {
	font-size: 0.875em;
	font-style: italic;
}


    </style>
</head>
<body>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="main-box clearfix">
          <div class="table-responsive">
            <table class="table user-list" style="width: 100%;">
              <thead>
                <tr>
                  <th>
                    <span>Nama File</span>
                  </th>
                  <th>
                    <span>Created</span>
                  </th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img src="<?= base_url('assets/images/logo/pdf.png')?>" alt="">
                    <a href="#" class="user-link">ICP_Dhana_signed.pdf</a>
                  </td>
                  <td> 2013/08/08 </td>
                  
                  <td style="width: 20%;">
                    <a href="#" class="table-link danger">
                      <!-- <span class="fa-stack"> -->
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Hapus</a>
                      <!-- </span> -->
                    </a>
                  </td>
                </tr>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
</body>