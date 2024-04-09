<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Manage</title>
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
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
  <script>
      <?php $eventData = array();?>
		  <?php 
        $db;
        $this->db = db_connect();
        $builder = $this->db->table('tblreservation');
        $builder->select('*');
        $builder->WHERE('Status',1);
        $data = $builder->get();
        foreach($data->getResult() as $row)
        {
            $tempArray = array( "title" => $row->Event_Name,"description" =>'Consultation',"start" => $row->Date." ". $row->Time,"end" => $row->Date);
            array_push($eventData, $tempArray);
        }
        ?>
      const jsonData = <?php echo json_encode($eventData); ?>;
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          events:jsonData
        });
        calendar.render();
      });

    </script>
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
          <li><a class="nav-link active" href="<?=site_url('admin/manage')?>">Manage</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/members')?>">Members</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/report')?>">Report</a></li>
          <li><a class="nav-link" href="<?=site_url('admin/settings')?>">Settings</a></li>
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
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1"><span class="bi bi-calendar"></span>&nbsp;Calendar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-2"><span class="bi bi-calendar-plus"></span>&nbsp;Appointment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-3"><span class="bi bi-envelope"></span>&nbsp;Inquiries</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" id="tab-1">
              <br/>
              <div id="calendar"></div>
            </div>
            <div class="tab-pane" id="tab-2">
              <br/>
              <div class="row g-3">
                <div class="col-12 form-group">
                  <input type="search" class="form-control" id="search" placeholder="Search here"/>
                </div>
                <div class="col-12 form-group tableFixHead table-responsive" style="height:600px;overflow-y:auto;">
                  <table class="table-striped table-bordered">
                    <thead>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Patient's Complete Name</th>
                      <th>Details</th>
                      <th>Status</th>
                      <th>Action</th>
                    </thead>
                    <tbody id="tblconsultation"></tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-3">
              <br/>
              <table class="table table-striped table-bordered" id="tblinquiry">
                <thead>
                  <th class="bg-primary text-white">Name</th>
                  <th class="bg-primary text-white">Email</th>
                  <th class="bg-primary text-white">Subject</th>
                  <th class="bg-primary text-white">Message</th>
                  <th class="bg-primary text-white">Action</th>
                </thead>
                <tbody>
                  <?php foreach($inquire as $row): ?>
                    <tr>
                      <td><?php echo $row['Name'] ?></td>
                      <td><?php echo $row['Email'] ?></td>
                      <td><?php echo $row['Subject'] ?></td>
                      <td><?php echo substr($row['Message'],0,50) ?>...</td>
                      <td></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
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
    new DataTable('#tblinquiry');
  </script>
  <script>
    $(document).ready(function()
    {
      loadRecords();
    });
    function loadRecords()
    {
      $('#tblconsultation').html("<tr><td colspan='6'><center>Loading data...</center></td></tr>");
      $.ajax({
        url:"<?=site_url('reservation')?>",method:"GET",
        success:function(response)
        {
          if(response==="")
          {
            $('#tblconsultation').html("<tr><td colspan='6'><center>No Record(s)</center></td></tr>");
          }
          else
          {
            $('#tblconsultation').html(response);
          }
        }
      });
    } 
    $('#search').keyup(function()
    {
      var val = $(this).val();
      $('#tblconsultation').html("<tr><td colspan='6'><center>Searching data...</center></td></tr>");
      $.ajax({
        url:"<?=site_url('search-reservation')?>",method:"GET",
        data:{keyword:val},
        success:function(response)
        {
          if(response==="")
          {
            $('#tblconsultation').html("<tr><td colspan='6'><center>No Record(s)</center></td></tr>");
          }
          else
          {
            $('#tblconsultation').html(response);
          }
        }
      });
    });   
  </script>
</body>

</html>