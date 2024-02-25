<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Consult Now</title>
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
        input[type='text'],input[type='phone'],input[type='date'],select{padding:10px;}
      </style>
   </head>
   <body>
   <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
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
      <a href="<?=site_url('admin/dashboard')?>" class="logo me-auto"><img src="../assets/img/logo.png" alt="" class="img-fluid"> e-PCOS</a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="<?=site_url('customer/dashboard')?>">Dashboard</a></li>
          <li><a class="nav-link" href="<?=site_url('customer/take-a-test')?>">Take A Test</a></li>
          <li><a class="nav-link active" href="<?=site_url('customer/consult-now')?>">Consult Now</a></li>
          <li class="dropdown"><a href="#"><span><?php echo session()->get('sess_fullname'); ?></span> <i class="bi bi-chevron-down"></i></a>
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
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Patient's Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">List of Consultation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Prescription</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" id="tab-1">
              <br/>
              <form method="POST" class="row g-3" id="frmPatient" action="<?=base_url('save')?>">
              <div class="col-12 form-group">
                  <div class="row g-3">
                    <div class="col-lg-6">
                      <label>Date Consultation</label>
                      <input type="date" class="form-control" name="date" required/>
                    </div>
                    <div class="col-lg-6">
                      <label>Time</label>
                      <select class="form-control" name="time" required>
                        <option value="">Choose</option>
                        <option>08:00:00</option>
                        <option>10:00:00</option>
                        <option>12:00:00</option>
                        <option>14:00:00</option>
                        <option>16:00:00</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-12 form-group">
                  <div class="row g-3">
                    <div class="col-lg-5">
                      <label>Lastname</label>
                      <input type="text" class="form-control" name="surname" required/>
                    </div>
                    <div class="col-lg-5">
                      <label>Firstname</label>
                      <input type="text" class="form-control" name="firstname" required/>
                    </div>
                    <div class="col-lg-2">
                      <label>Middle Initial</label>
                      <input type="text" class="form-control" name="mi" required/>
                    </div>
                  </div>
                </div>
                <div class="col-12 form-group">
                  <div class="row g-3">
                    <div class="col-lg-4">
                      <label>Birth Date</label>
                      <input type="date" class="form-control" name="bdate" required/>
                    </div>
                    <div class="col-lg-4">
                      <label>Tel/Cell #</label>
                      <input type="phone" class="form-control" name="phone" required/>
                    </div>
                    <div class="col-lg-4">
                      <label>Gender</label>
                      <input type="text" class="form-control" name="gender" required/>
                    </div>
                  </div>
                </div>
                <div class="col-12 form-group">
                  <label>Complete Address</label>
                  <textarea name="address" class="form-control" style="height:120px;"></textarea>
                </div>
                <div class="col-12 form-group">
                  <button type="submit" class="btn btn-primary form-control" id="btnSend" name="btnSend">Submit</button>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="tab-2">
            </div>
            <div class="tab-pane" id="tab-3">
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