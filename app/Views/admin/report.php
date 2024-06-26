<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Data Analytics</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url('assets/img/logo.png')?>" rel="icon">
  <link href="<?php echo base_url('assets/img/logo.png')?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
  <style>
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;color:#fff;background-color: #0275d8;}

    /* Just common table stuff. Really. */
    table  { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px 16px;color:#000; }
    tbody{color:#000;}
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
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
      <a href="<?=site_url('admin/dashboard')?>" class="logo me-auto"><img src="<?php echo base_url('assets/img/logo.png')?>" alt="" class="img-fluid"> PCOSPhil</a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="<?=site_url('admin/dashboard')?>">Dashboard</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/manage')?>">Manage</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/members')?>">Members</a></li>
          <li><a class="nav-link active" href="<?=site_url('admin/report')?>">Report</a></li>
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
          <div class="col-12 form-group">
            <div class="card">
              <div class="card-header bg-primary text-white"><span class="bi bi-bar-chart"></span>&nbsp;Generate Analytics</div>
              <div class="card-body">
                <form method="GET" class="row g-3" id="frmReport">
                  <div class="col-lg-3 form-group">
                    <label>From</label>
                    <input type="date" class="form-control" name="fromdate" id="fromdate"/>
                  </div>
                  <div class="col-lg-3 form-group">
                    <label>To</label>
                    <input type="date" class="form-control" name="todate" id="todate"/>
                  </div>
                  <div class="col-lg-2 form-group">
                    <label>&nbsp;</label>
                    <input type="submit" class="btn btn-primary text-white form-control" value="Generate" id="btnGenerate"/>
                  </div>
                  <div class="col-lg-2 form-group">
                    <label>&nbsp;</label>
                    <a href="" class="btn btn-outline-primary form-control" id="btnPrint">Print</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-12 form-group">
            <div class="row g-3">
              <div class="col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">Total Respondents</h6>
                    <h1 id="totalRespondent">0</h1>
                    <small><button type="button" id="btnView" class="btn btn-link btn-sm">View Response</button></small>
                  </div>
                </div>
                <br/>
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">Percentage (High Risk)</h6>
                    <h1 id="totalHigh">0%</h1>
                  </div>
                </div>
                <br/>
                <div class="card">
                  <div class="card-body">
                    <table class="table-responsive table-bordered table-striped">
                      <thead>
                          <th class="bg-primary text-white">Location</th>
                          <th class="bg-primary text-white">Volume</th>
                      </thead>
                      <tbody id="locations"></tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-lg-9">
                <div class="row g-3">
                  <div class="col-12 form-group">
                    <div class="card">
                      <div class="card-body">
                        <h6 class="card-title">Age Bracket</h6>
                        <div id="ageContainer" style="height:300px;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 form-group">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title">Survey</div>
                        <div id="results"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
  <div class="modal" id="modal-loading" data-backdrop="static">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
				<div class="modal-body text-center">
					<div class="spinner-border"></div>
					<div>Loading</div>
				</div>
				</div>
			</div>
		</div>
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url('assets/vendor/purecounter/purecounter_vanilla.js')?>"></script>
  <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?php echo base_url('assets/vendor/glightbox/js/glightbox.min.js')?>"></script>
  <script src="<?php echo base_url('assets/vendor/swiper/swiper-bundle.min.js')?>"></script>
  <script src="<?php echo base_url('assets/vendor/php-email-form/validate.js')?>"></script>

  <!-- Template Main JS File -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="<?php echo base_url('assets/js/main.js')?>"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script>
    $('#btnView').on('click',function(e)
    {
      e.preventDefault();
      var fromdate = $('#fromdate').val();
      var todate = $('#todate').val();
      window.location.href="view-response?fromdate="+fromdate+"&todate="+todate;
    });
    $('#btnGenerate').on('click',function(e)
    {
      e.preventDefault();
      var data = $('#frmReport').serialize();
      $('#modal-loading').modal('show');
      $.ajax({
        url:"<?=site_url('generate-reports')?>",method:"GET",
        data:data,success:function(response)
        {
          $('#totalRespondent').html(response);
        }
      });
      $.ajax({
        url:"<?=site_url('high-risk')?>",method:"GET",
        data:data,success:function(response)
        {
          $('#totalHigh').html(response);
        }
      });
      $.ajax({
          url:"<?=site_url('age-chart')?>",method:"GET",
          dataType:"JSON",
          data:data,
          success:function(data)
          {
              var chart = new CanvasJS.Chart("ageContainer", {
                animationEnabled: true,
                exportEnabled: false,
                theme: "light1",
                title:{
                  text: "",
                },
                data: [{
                  type: "splineArea",
                  indexLabel: "{label} ({y})",
                  indexLabelPlacement: "inside",
                  indexLabelFontColor: "#36454F",
                  indexLabelFontSize: 10,
                  indexLabelFontWeight: "bolder",
                  dataPoints: data
                }]
              });
              chart.render();  
          }
      });

      $.ajax({
        url:"<?=site_url('respondents-answer')?>",method:"GET",
        data:data,success:function(response)
        {
          $('#results').html(response);
        }
      });

      $.ajax({
        url:"<?=site_url('respondents-location')?>",method:"GET",
        data:data,success:function(response)
        {
          $('#modal-loading').modal('hide');
          $('#locations').html(response);
        }
      });
    });
  </script>
</body>

</html>