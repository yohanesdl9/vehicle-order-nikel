<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo-sm.png') ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/sweet-alert2/sweetalert2.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/select2/select2.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/plugins/nestable/jquery.nestable.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/buttons.bootstrap4.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatables/responsive.bootstrap4.min.css') ?>" /> 
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.16/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css') ?>" />

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.min.css') ?>" >
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/icons.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/metisMenu.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/app.min.css') ?>" />
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/metismenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/waves.js') ?>"></script>
    <script src="<?= base_url('assets/js/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.slimscroll.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= base_url('assets/plugins/moment/moment.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/jvectormap/jquery-jvectormap-us-aea-en.js') ?>"></script>
    <script src="<?= base_url('assets/pages/jquery.analytics_dashboard.init.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/flot-chart/jquery.flot-dataType.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/sweet-alert2/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/select2/select2.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/buttons.colVis.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/responsive.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/moment/moment.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <style>
      select[readonly].select2 + .select2-container {
        pointer-events: none;
        touch-action: none;
      }
    </style>
    <script>
      $(document).ready(function(){
        $(".select2").select2({
          width: '100%'
        });

        $('.datatable').DataTable({
          ordering: false
        });
      });
    </script>
  </head>
  <body>
    <div class="topbar">
      <div class="topbar-left">
				<a href="<?= base_url() ?>" class="logo">
					<span><img src="<?= base_url('assets/images/logo-sm.png') ?>" alt="logo-small" class="logo-sm"></span>
					<span>
						<img src="<?= base_url('assets/images/logo.png') ?>" alt="logo-large" class="logo-lg logo-light">
						<img src="<?= base_url('assets/images/logo-dark.png') ?>" alt="logo-large" class="logo-lg">
					</span>
				</a>
      </div>
      <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav mb-0">
          <li>
            <button class="nav-link button-menu-mobile waves-effect waves-light"><i class="ti-menu nav-icon"></i></button>
          </li>
        </ul>
        <ul class="list-unstyled topbar-nav float-right mb-0">
          <li class="dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              <img src="<?= base_url('assets/images/users/user-1.png') ?>" alt="profile-user" class="rounded-circle" /> 
              <span class="ml-1 nav-user-name hidden-sm"><?= $this->session->userdata('nama') ?><i class="mdi mdi-chevron-down"></i> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <a class="dropdown-item" href="<?= base_url('user/profile') ?>"><i class="ti-user text-muted mr-2"></i> Profile</a>
              <div class="dropdown-divider mb-0"></div> -->
              <a class="dropdown-item" href="#" onclick="confirmLogout()"><i class="ti-power-off text-muted mr-2"></i> Logout</a>
            </div>
          </li>
        </ul>
      </nav>
    </div>
    <div class="left-sidenav">
      <ul class="metismenu left-sidenav-menu">
				<?php $to_do = $this->M_app->get_pemesanan_to_verify(); ?>
				<li <?= str_replace(base_url(), '', current_url()) == 'dashboard' ? 'class="mm-active"' : '' ?>><a href="<?= base_url('dashboard') ?>"><i class="ti-check-box"></i><span>Dashboard</span></a></li>
				<li <?= str_replace(base_url(), '', current_url()) == 'pemesanan' ? 'class="mm-active"' : '' ?>>
					<a href="<?= base_url('pemesanan') ?>"><i class="fas fa-sticky-note"></i>
						<span>Pesan Kendaraan <?= $to_do > 0 ? ('<span class="right badge badge-danger">' . $to_do . '</span>') : '' ?></span>
					</a>
				</li>
				<?php if ($this->session->userdata('privileges') == 'admin') { ?>
        <li class="navbar-header">Admin</li>
				<li <?= str_replace(base_url(), '', current_url()) == 'kendaraan' ? 'class="mm-active"' : '' ?>><a href="<?= base_url('kendaraan') ?>"><i class="fas fa-car-alt"></i><span>Kendaraan</span></a></li>
				<li <?= str_replace(base_url(), '', current_url()) == 'perusahaan' ? 'class="mm-active"' : '' ?>><a href="<?= base_url('perusahaan') ?>"><i class="fas fa-building"></i><span>Rental Kendaraan</span></a></li>
				<li <?= str_replace(base_url(), '', current_url()) == 'pegawai' ? 'class="mm-active"' : '' ?>><a href="<?= base_url('pegawai') ?>"><i class="fas fa-user"></i><span>Pegawai</span></a></li>
				<li <?= str_replace(base_url(), '', current_url()) == 'user' ? 'class="mm-active"' : '' ?>><a href="<?= base_url('user') ?>"><i class="fas fa-users-cog"></i><span>Manajemen User</span></a></li>
				<li <?= str_replace(base_url(), '', current_url()) == 'log' ? 'class="mm-active"' : '' ?>><a href="<?= base_url('log') ?>"><i class="fas fa-list-alt"></i><span>Log Aktivitas</span></a></li>
        <?php } ?>
      </ul>
    </div>
    <div class="page-wrapper">
      <div class="page-content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-title-box">
                <h4 class="page-title"><?= $title ?></h4>
              </div>
            </div>
          </div>
          <?php $this->load->view($content); ?>
        </div>
        <footer class="footer text-center text-sm-left">
          &copy; <?= date('Y') ?> Yohanes Dwi Listio. <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Yohanes Dwi Listio</span>
        </footer>
      </div>
    </div>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script>
    var validationPerformed = false;

    function confirmLogout(){
      Swal.fire({
        title: "Apakah Anda ingin keluar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak"
      }).then((result) => {
        if (result.value) {
          window.location.href = '<?= base_url('login/logout') ?>';
        }
      });
    }

		function confirmHapus(url){
      Swal.fire({
        title: "Apakah Anda yakin?",
				text: "Anda tidak akan dapat mengembalikan data Anda!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak"
      }).then((result) => {
        if (result.value) {
          window.location.href = url;
        }
      });
    }
    
    function runFormValidation(e, formId, url) {
      if (validationPerformed) {
        $(formId).unbind('submit').submit();
        return;
      }

      var postData = new FormData($(formId)[0]);
      $.ajax({  
        url: url,
        type: "POST",
        data: postData,
				dataType: 'JSON',
				contentType: false,
				cache: false,
				async: false,
				processData: false,
        success: function(data) {
          if (data.status) {
            validationPerformed = true;
            $(formId).unbind('submit').submit();
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
    }
    </script>
  </body>
</html>
