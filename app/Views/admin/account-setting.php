<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Profile</title>
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
      <a href="<?=site_url('admin/dashboard')?>" class="logo me-auto"><img src="../assets/img/logo.png" alt="" class="img-fluid"> PCOSPhil</a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="<?=site_url('admin/dashboard')?>">Dashboard</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/manage')?>">Manage</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/members')?>">Members</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/report')?>">Report</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/settings')?>">Settings</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/maintenance')?>">Maintenance</a></li>
          <li class="dropdown"><a href="#" class="active"><span><?php echo session()->get('sess_fullname'); ?></span> <i class="bi bi-chevron-down"></i></a>
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
        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Account Information
                    </div>
                    <div class="card-body">
                        <form method="POST" class="row g-3" id="frmAccount">
                            <div class="col-12">
                                <label>Complete Name *</label>
                                <input type="text" class="form-control" name="fullname" value="<?=$account['Fullname']?>" required/>
                            </div>
                            <div class="col-12">
                                <label>Email Address *</label>
                                <input type="email" class="form-control" name="email" value="<?=$account['EmailAddress']?>" required/>
                            </div>
                            <div class="col-12">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <label>System Role *</label>
                                        <select class="form-control" style="padding:10px;" name="role" required>
                                            <option value="">Choose</option>
                                            <option <?php if($account['Role']=="Administrator") echo 'selected="selected"'; ?>>Administrator</option>
                                            <option <?php if($account['Role']=="Standard User") echo 'selected="selected"'; ?>>Standard User</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Account Status</label>
                                        <input type="text" class="form-control" value="<?php if($account['Status']==1){echo "Active";}else{echo "Inactive";}?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        <form method="POST" class="row g-3" id="frmChange" action="<?=base_url('change-password')?>">
                            <div class="col-12">
                                <label>New Password *</label>
                                <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  name="new_password" required/>
                            </div>
                            <div class="col-12">
                                <label>Re-type Password *</label>
                                <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  name="retype_password" required/>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary" id="btnSave">Save Changes</button>
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
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>