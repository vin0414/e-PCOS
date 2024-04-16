<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Appointment</title>
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
        input[type='text'],input[type='phone'],input[type='date'],select{padding:10px;}
      </style>
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
          <li><a class="nav-link active" href="<?=site_url('customer/consult-now')?>">Appointment</a></li>
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
        <div class="card">
          <div class="card-body">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Patient's Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-2">List of Appointment</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="tab-1">
                  <br/>
                  <form method="POST" class="row g-3" id="frmPatient">
                  <div class="col-12 form-group">
                      <div class="row g-3">
                        <div class="col-lg-4">
                          <label>Date Appointment</label>
                          <input type="date" class="form-control" name="date" id="date" required/>
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
                            <option>Gynecology</option>
                            <option>Obstetrics</option>
                            <option>Obstetrics and Gynecology</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 form-group">
                      <div class="row g-3">
                        <div class="col-lg-4">
                          <label>Surname</label>
                          <input type="text" class="form-control" name="surname" required/>
                        </div>
                        <div class="col-lg-4">
                          <label>First Name</label>
                          <input type="text" class="form-control" name="firstname" required/>
                        </div>
                        <div class="col-lg-2">
                          <label>Middle Initial</label>
                          <input type="text" class="form-control" name="mi" required/>
                        </div>
                        <div class="col-lg-2">
                          <label>Suffix</label>
                          <input type="text" class="form-control" name="suffix" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 form-group">
                      <div class="row g-3">
                        <div class="col-lg-4">
                          <label>Date of Birth</label>
                          <input type="date" class="form-control" name="bdate" required/>
                        </div>
                        <div class="col-lg-4">
                          <label>Contact No</label>
                          <input type="phone" class="form-control" name="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="11" minlength="11" required/>
                        </div>
                        <div class="col-lg-4">
                          <label>Gender</label>
                          <select class="form-control" name="gender" style="padding:10px;" required>
                            <option value="">Choose</option>
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 form-group">
                      <label>Complete Address</label>
                      <textarea name="address" class="form-control" style="height:120px;"></textarea>
                    </div>
                    <div class="col-12 form-group">
                      <input type="submit" class="btn btn-primary form-control" id="btnSend" name="btnSend" value="Submit"/>
                    </div>
                  </form>
                </div>
                <div class="tab-pane" id="tab-2">
                  <br/>
                  <div class="table-responsive">
                      <table class="table table-striped table-bordered" id="table1">
                          <thead>
                              <th class="bg-primary text-white">Date</th>
                              <th class="bg-primary text-white">Time</th>
                              <th class="bg-primary text-white">Type of Appointment</th>
                              <th class="bg-primary text-white">Patient's Name</th>
                              <th class="bg-primary text-white">Status</th>
                              <th class="bg-primary text-white">Action</th>
                          </thead>
                          <tbody>
                            <?php foreach($reservation as $row): ?>
                              <tr>
                                <td><?php echo $row['Date'] ?></td>
                                <td><?php echo $row['Time'] ?></td>
                                <td><?php echo $row['Event_Name'] ?></td>
                                <td><?php echo $row['Surname'] ?> <?php echo $row['Suffix'] ?>,<?php echo $row['Firstname'] ?> <?php echo $row['MiddleName'] ?></td>
                                <td>
                                  <?php if($row['Status']==0){ ?>
                                    <span class="badge bg-warning">PENDING</span>
                                  <?php }else if($row['Status']==1){?>
                                    <span class="badge bg-primary">RESERVED</span>
                                  <?php }else if($row['Status']==3){?>
                                    <span class="badge bg-success">COMPLETED</span>
                                  <?php }else{ ?>
                                    <span class="badge bg-danger">CANCELLED</span>
                                  <?php } ?>
                                </td>
                                <td>
                                  <?php if($row['Status']==0){ ?>
                                    <button type="button" class="btn btn-danger btn-sm cancel" value="<?php echo $row['reservationID'] ?>"><span class="bi bi-x"></span>&nbsp;Cancel</button>
                                  <?php }else{ ?>
                                    -
                                  <?php } ?>  
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
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
      <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        new DataTable('#table1');
      </script>
      <script>
        $(document).ready(function()
        {
          today();availableTime();
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
        $(document).on('click','.cancel',function()
        {
          var confirmation = confirm("Do you want to cancel this reservation?");
          if(confirmation)
          {
            var val = $(this).val();
            $.ajax({
              url:"<?=site_url('cancel-reservation')?>",method:"POST",
              data:{value:val},
              success:function(response)
              {
                if(response==="success")
                {
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
        function today()
        {
          var date = new Date(); // Now
          date.setDate(date.getDate()+1);
          $('#date').attr('min',convert(date));
          document.getElementById('date').value=convert(date);
        }
        function convert(str) 
        {
          var date = new Date(str),
          mnth = ("0" + (date.getMonth() + 1)).slice(-2),
          day = ("0" + date.getDate()).slice(-2);
          return [date.getFullYear(), mnth, day].join("-");
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

        $('#btnSend').on('click',function(e)
        {
          e.preventDefault();
          $(this).attr("value","Submitting...");
          var data = $('#frmPatient').serialize();
          $.ajax({
            url:"<?=site_url('save')?>",method:"POST",
            data:data,
            success:function(response)
            {
              if(response==="Success")
              {
                Swal.fire({
										title: "Great!",
										text: "Successfully submitted",
										icon: "success"
										});
                location.reload();
              }
              else
              {
                Swal.fire({
										title: "Invalid",
										text: response,
										icon: "warning"
										});
              }
              $('#btnSend').attr("value","Submit");
            }
          });
        });
      </script>
   </body>
</html>