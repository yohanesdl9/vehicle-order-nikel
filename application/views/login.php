<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="<?= base_url('assets/images/logo-sm.png') ?>">

    <link href="<?= base_url('assets/plugins/sweet-alert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/metisMenu.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" />

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/metismenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/waves.js') ?>"></script>
    <script src="<?= base_url('assets/js/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.slimscroll.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/sweet-alert2/sweetalert2.min.js') ?>"></script>    

  </head>
  <body class="account-body accountbg">

    <div class="container">
      <div class="row vh-100 ">
        <div class="col-12 align-self-center">
          <div class="auth-page">
            <div class="card auth-card shadow-lg">
              <div class="card-body">
                <div class="px-3">
                  <img src="<?= base_url('assets/images/logo-sm.png') ?>" height="100" class="ml-auto mr-auto d-block">         
                  <div class="text-center auth-logo-text">
                    <?php if($this->session->flashdata('message')) { ?>
                    <div class="alert alert-<?= $this->session->flashdata('color') ?> alert-dismissible mt-2" role="alert">
                      <?= $this->session->flashdata('message') ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> 
                    <?php } ?> 
                  </div>
									<form class="form-horizontal auth-form my-4" action="<?= base_url('login/auth') ?>" method="POST" id="formLogin">
										<div class="form-group">
											<label for="username">Username</label>
											<div class="input-group mb-3">
												<span class="auth-form-icon"><i class="dripicons-user"></i> </span>                                                                                                              
												<input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username">
											</div>                                    
										</div>
										<div class="form-group">
											<label for="userpassword">Password</label>                                            
											<div class="input-group mb-1"> 
												<span class="auth-form-icon">
													<i class="dripicons-lock"></i> 
												</span>                                                       
												<input type="password" class="form-control" name="password" id="userpassword" placeholder="Masukkan Password">
											</div>
										</div>
										<div class="form-group">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="show_password" class="form-check-input">
												<label class="form-check-label" for="show_password">Tampilkan Password</label>
											</div>     
										</div>
										<div class="form-group mb-0 row">
											<div class="col-12 mt-2">
												<button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
											</div>
										</div>                         
									</form>
                </div>
              </div>
            </div>
          </div>
        </div>       
      </div>
    </div>    
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
		<script>
		$('#show_password').change(function(){
			var checked = $(this).prop('checked');
			if (checked) {
				$('#userpassword').attr('type', 'text');
			} else {
				$('#userpassword').attr('type', 'password');
			}
		});

		var validationPerformed = false;

		$("#formLogin").submit(function(e){
			if (validationPerformed) {
        $(this).unbind('submit').submit();
        return;
      }

			var postData = new FormData($('#formLogin')[0]);

      $.ajax({  
        url: '<?= base_url('login/auth_validation') ?>',
        type: "POST",
        data: postData,
				dataType: 'JSON',
				contentType: false,
				cache: false,
				async: false,
				processData: false,
        success: function(data) {
					console.log(data);
          if (data.status) {
            validationPerformed = true;
            $(this).unbind('submit').submit();
          } else {
            e.preventDefault();
            Swal.fire({
              icon: 'error',
              title: 'Oh Snap!',
              html: data.message
            });
          }
        },
        failure: function(){
          e.preventDefault();
          Swal.fire({
            icon: 'error',
            title: 'Oh Snap!',
            text: 'Proses gagal. Harap mencoba lagi nanti.'
          });
        }
      });
		});
		</script>
  </body>
</html>
