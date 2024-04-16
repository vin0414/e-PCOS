<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Profile</title>
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
         
   </head>
   <body>
   <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:pcos-system2024@gmail.com">pcos-system2024@gmail.com</a>
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
      <a href="/" class="logo me-auto"><img src="../assets/img/logo.png" alt="" class="img-fluid"> e-PCOS</a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="<?=site_url('customer/dashboard')?>">Dashboard</a></li>
          <li><a class="nav-link" href="<?=site_url('customer/take-a-test')?>">Take A Test</a></li>
          <li><a class="nav-link" href="<?=site_url('customer/consult-now')?>">Appointment</a></li>
          <li class="dropdown"><a href="#" class="active"><span><?php echo session()->get('sess_fullname'); ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?=site_url('customer/profile')?>">Account Settings</a></li>
              <li><a href="<?=site_url('sign-out')?>">Sign-out</a></li>
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
                            <input type="hidden" name="userID" value="<?php echo session()->get('sess_id') ?>"/>
                            <div class="col-12">
                                <label>Complete Name *</label>
                                <input type="text" class="form-control" name="fullname" value="<?php echo session()->get('sess_fullname') ?>" required/>
                            </div>
                            <div class="col-12">
                                <label>Email Address *</label>
                                <input type="email" class="form-control" name="email" value="<?php echo session()->get('customer_email') ?>" required/>
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
                        <form method="POST" class="row g-3" id="frmChange" action="<?=base_url('update-password')?>">
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
      <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
      <script>
        $('#btnSubmit').on('click',function(e)
        {
          e.preventDefault();
          var confirmation  = confirm('Do you want to update your information');
          if(confirmation)
          {
            var data = $('#frmAccount').serialize();
            $.ajax({
              url:"<?=site_url('update-information')?>",
              method:"POST",data:data,
              success:function(response)
              {
                if(response==="success")
                {
                  alert("Great! Successfully update the information");
                  location.reload();
                }
                else
                {
                  alert(response);
                }
              }
            });
            }
        });
      </script>
   </body>
</html>