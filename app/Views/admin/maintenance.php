<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Maintenance</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/logo.png" rel="icon">
  <link href="../assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
    input[type='text'],input[type='email'],input[type='password']{padding:10px;}
  </style>
</head>

<body>
   <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:pcos-system2024@gmail.com">pcos-system2024@gmail.com</a>
        <i class="bi bi-phone"></i> +1 5589 55488 55
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div>
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <!-- <h1 class="logo me-auto"><a href="/">e-PCOS</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="<?=site_url('admin/dashboard')?>" class="logo me-auto"><img src="<?php echo base_url('assets/img/logo.png')?>" alt="" class="img-fluid"> PCOSPhil</a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="<?=site_url('admin/dashboard')?>">Dashboard</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/manage')?>">Manage</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/members')?>">Members</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/report')?>">Report</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/settings')?>">Settings</a></li>
          <li><a class="nav-link active" href="<?=site_url('admin/maintenance')?>">Maintenance</a></li>
          <li class="dropdown"><a href="#"><span><?php echo session()->get('sess_fullname'); ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?=site_url('admin/profile')?>">Account Settings</a></li>
              <li><a href="<?=site_url('logout')?>">Sign-out</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <main id="main" style="margin-top:100px;">
    <!-- ======= Contact Section ======= -->
    <section class="why-us">
      <div class="container">
        <div class="card">
          <div class="card-header"><span class="bi bi-gear"></span>&nbsp;Maintenance</div>
          <div class="card-body">
          <?php if(!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('fail'); ?>
            </div>
          <?php endif; ?>
          <?php if(!empty(session()->getFlashdata('success'))) : ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?= session()->getFlashdata('success'); ?>
              </div>
          <?php endif; ?>
            <ul class="nav nav-pills">
              <li class="nav-item">
                  <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Audit Trail</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Back-up and Restore</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <br/>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="table1">
                    <thead>
                        <th class="bg-primary text-white">Date</th>
                        <th class="bg-primary text-white">Time</th>
                        <th class="bg-primary text-white">Fullname</th>
                        <th class="bg-primary text-white">Activities</th>
                    </thead>
                    <tbody>
                      <?php foreach($logs as $row): ?>
                        <tr>
                          <td><?php echo $row->Date ?></td>
                          <td><?php echo $row->Time ?></td>
                          <td><?php echo $row->Fullname ?></td>
                          <td><?php echo $row->Activities ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane show" id="tab-2">
                <br/>
                <form method="POST" class="row g-3" enctype="multipart/form-data" action="<?=base_url('restore')?>">
                  <div class="col-12 form-group">
                    <div class="row g-3">
                      <div class="col-lg-4">
                        <label>Server</label>
                        <input type="text" class="form-control" name="server" value="localhost" required/>
                      </div>
                      <div class="col-lg-4">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="root" required/>
                      </div>
                      <div class="col-lg-4">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" value="Fastcat_01" required/>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 form-group">
                    <label>Database Name</label>
                    <input type="text" class="form-control" name="database" value="db_poll_survey" required/>
                  </div>
                  <div class="col-12 form-group">
                    <label>File</label>
                    <input type="file" class="form-control" name="file" required/>
                  </div>
                  <div class="col-12 form-group">
                    <button type="submit" class="btn btn-primary" id="btnUpload" name="restore"><span class="fa fa-upload"></span>&nbsp;Restore</button>
                    <a href="<?=site_url('download')?>" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Back-Up</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url('assets/vendor/purecounter/purecounter_vanilla.js')?>"></script>
  <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?php echo base_url('assets/vendor/glightbox/js/glightbox.min.js')?>"></script>
  <script src="<?php echo base_url('assets/vendor/swiper/swiper-bundle.min.js')?>"></script>
  <script src="<?php echo base_url('assets/vendor/php-email-form/validate.js')?>"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url('assets/js/main.js')?>"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script>
    new DataTable('#table1');
  </script>
</body>

</html>