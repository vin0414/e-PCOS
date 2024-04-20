<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Re-Schedule</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url('assets/img/logo.png')?>" rel="icon">
  <link href="<?php echo base_url('assets/img/logo.png')?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/animate.css/animate.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/boxicons/css/boxicons.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/glightbox/css/glightbox.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/remixicon/remixicon.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendor/swiper/swiper-bundle.min.css')?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">
  <style>
    input[type='text'],input[type='phone'],input[type='date'],select{padding:10px;}
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
      <a href="<?=site_url('admin/dashboard')?>" class="logo me-auto"><img src="<?php echo base_url('assets/img/logo.png')?>" alt="" class="img-fluid">e-PCOS</a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="<?=site_url('admin/dashboard')?>">Dashboard</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/manage')?>">Manage</a></li>
          <li><a class="nav-link active" href="javascript:void(0);">Re-Book</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/members')?>">Members</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/report')?>">Report</a></li> 
          <li><a class="nav-link" href="<?=site_url('admin/settings')?>">Settings</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/maintenance')?>">Maintenance</a></li>
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
        <div class="row g-3">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header"><span class="bi bi-calendar-plus"></span>&nbsp;Reservation
                    <a href="<?=site_url('admin/manage')?>" class="btn btn-primary btn-sm" style="float:right;">Back</a>
                    </div>
                    <div class="card-body">
                        <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('fail'); ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST" class="row g-3" id="frmPatient" action="<?=base_url('rebook')?>">
                            <?php if($reservation): ?>
                            <input type="hidden" name="reservationID" value="<?php echo $reservation['reservationID'] ?>"/>
                            <div class="col-12 form-group">
                                <div class="row g-3">
                                    <div class="col-lg-4">
                                    <label>Date Appointment</label>
                                    <input type="date" class="form-control" name="date" id="date" value="<?php echo $reservation['Date'] ?>" required/>
                                    </div>
                                    <div class="col-lg-4">
                                    <label>Time of Appointment</label>
                                    <select class="form-control" name="time" id="time" style="padding:10px;" required>
                                        <option value="">Choose</option>
                                    </select>
                                    </div>
                                    <div class="col-lg-4">
                                    <label>Type of Appointment</label>
                                    <select class="form-control" name="type_appointment" style="padding:10px;" required>
                                        <option value="">Choose</option>
                                        <option <?php if($reservation['Event_Name']=="Gynecology") echo 'selected="selected"'; ?>>Gynecology</option>
                                        <option <?php if($reservation['Event_Name']=="Obstetrics") echo 'selected="selected"'; ?>>Obstetrics</option>
                                        <option <?php if($reservation['Event_Name']=="Obstetrics and Gynecology") echo 'selected="selected"'; ?>>Obstetrics and Gynecology</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row g-3">
                                    <div class="col-lg-4">
                                    <label>Surname</label>
                                    <input type="text" class="form-control" name="surname" value="<?php echo $reservation['Surname'] ?>" required/>
                                    </div>
                                    <div class="col-lg-4">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="firstname" value="<?php echo $reservation['Firstname'] ?>" required/>
                                    </div>
                                    <div class="col-lg-2">
                                    <label>Middle Initial</label>
                                    <input type="text" class="form-control" name="mi" value="<?php echo $reservation['MiddleName'] ?>" required/>
                                    </div>
                                    <div class="col-lg-2">
                                    <label>Suffix</label>
                                    <input type="text" class="form-control" name="suffix" value="<?php echo $reservation['Suffix'] ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row g-3">
                                    <div class="col-lg-4">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" name="bdate" value="<?php echo $reservation['BirthDate'] ?>" required/>
                                    </div>
                                    <div class="col-lg-4">
                                    <label>Contact No</label>
                                    <input type="phone" class="form-control" name="phone" value="<?php echo $reservation['Contact'] ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="11" minlength="11" required/>
                                    </div>
                                    <div class="col-lg-4">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender" style="padding:10px;" required>
                                        <option value="">Choose</option>
                                        <option <?php if($reservation['Gender']=="Male") echo 'selected="selected"'; ?>>Male</option>
                                        <option <?php if($reservation['Gender']=="Female") echo 'selected="selected"'; ?>>Female</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label>Complete Address</label>
                                <textarea name="address" class="form-control" style="height:120px;"><?php echo $reservation['Address'] ?></textarea>
                            </div>
                            <div class="col-12 form-group">
                                <input type="submit" class="btn btn-primary form-control" id="btnSend" name="btnSend" value="Submit"/>
                            </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
        $(document).ready(function()
        {
          availableTime();
        });
        function availableTime()
        {
          var date = $('#date').val();
          $.ajax({
            url:"<?=site_url('get-available-time')?>",method:"GET",
            data:{date:date},
            success:function(response)
            {
              if(response==="")
              {
                Swal.fire({
                  title: "Sorry",
                  text: "Full booked, Please select other dates",
                  icon: "info"
                  });
              }
              else
              {
                $('#time').append(response);
              }
            }
          });
        }
        $('#date').change(function()
        {
          $('#time').find('option').not(':first').remove();
          var date = $(this).val();
          $.ajax({
            url:"<?=site_url('get-available-time')?>",method:"GET",
            data:{date:date},
            success:function(response)
            {
              if(response==="")
              {
                Swal.fire({
                  title: "Sorry",
                  text: "Full booked, Please select other dates",
                  icon: "info"
                  });
              }
              else
              {
                $('#time').append(response);
              }
            }
          });
        });
      </script>
</body>

</html>