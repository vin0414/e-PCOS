<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Take A Test</title>
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
      <link href="../assets/css/wizard-form.css" rel="stylesheet">
         
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
          <li><a class="nav-link active" href="<?=site_url('customer/take-a-test')?>">Take A Test</a></li>
          <li><a class="nav-link" href="<?=site_url('customer/consult-now')?>">Appointment</a></li>
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
        <div class="row g-3">
          <div class="col-lg-3"></div>
          <div class="col-lg-6">
            <div class="card" id="frmStart">
              <div class="card-body">
                <center>
                <img src="../assets/img/logo.png" alt="" class="img-fluid">
                </center>
                <h2 class="text-center">Take A Survey</h2>
                <p class="text-center"><b>Important Notice</b></p>
                <p class="text-center">Polycystic Ovarian Syndrome (PCOS) Risk Assessment<br/>
                Please be aware that the PCOS risk assessment questions provided are only a tool for determining the likelihood of the condition and should not be used as a substitute for professional medical advice or diagnosis. Their goal is to help people recognize probable PCOS symptoms therefore, a trained healthcare practitioner should conduct a more thorough examination.  If you believe you have PCOS or notice any symptoms, you should see a doctor for a proper diagnosis and treatment.</p>
                <center>
                  <button type="button" class="btn btn-primary btn-lg" id="btnStart"><i class="bi bi-arrow-right"></i>&nbsp;START</button>
                </center>
              </div>
            </div>
            <div class="card" id="frmQuestion" style="display:none;">
              <div class="card-body">
                <h4 class="card-title"><i class="bi bi-clipboard-data"></i>&nbsp;PCOS Awareness Survey</h4>
                <hr/>
                <form method="POST" class="row g-3" id="frmSurvey">
                <input type="hidden" name="customer" value="<?php echo session()->get('sess_id') ?>"/>
                <?php foreach($survey as $row): ?>
                  <div class="col-12 form-group">
                    <h6><b><?php echo $row->Question ?></b></h6>
                      <?php
                      $db;$this->db = db_connect();
                      $builder = $this->db->table('tblchoice');
                      $builder->select('choiceID,Details');
                      $builder->WHERE('questionID',$row->questionID);
                      $data = $builder->get();
                      foreach($data->getResult() as $rows)
                      {
                       ?>
                      <input type="radio" style="width:15px;height:15px;" name="<?php echo $row->questionID ?>" value="<?php echo $rows->choiceID ?>"/>&nbsp;<label><?php echo $rows->Details ?></label><br/>
                      <?php } ?>
                  </div>
                <?php endforeach; ?>
                <input type="submit" class="form-control btn btn-primary text-white" id="btnSave" value="Submit"/>
                </form>
              </div>
            </div>
            <div class="card" id="successMessage" style="display:none;">
            </div>
          </div>
          <div class="col-lg-3"></div>
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
      <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
      <script src="../assets/js/main.js"></script>
      <script>
        $('#btnStart').on('click',function(e)
        {
          e.preventDefault();
          document.getElementById('frmStart').style="display:none";
          document.getElementById('frmQuestion').style="display:block";
        });
      </script>
   </body>
</html>