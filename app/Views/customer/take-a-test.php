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
      <a href="/" class="logo me-auto"><img src="../assets/img/logo.png" alt="" class="img-fluid"> PCOSPhil</a>

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
                <img src="../assets/img/logo.png" alt="" style="width:100px;" class="img-fluid">
                </center>
                <h3 class="text-center">Polycystic Ovarian Syndrome (PCOS)<br/> Risk Assessment</h3>
                <br/>
                <div class="text-center">Important Notice</div>
                <p class="text-center" style="font-size:12px;">Please be aware that the PCOS risk assessment questions provided are only a tool for determining the likelihood of the condition and should not be used as a substitute for professional medical advice or diagnosis. Their goal is to help people recognize probable PCOS symptoms therefore, a trained healthcare practitioner should conduct a more thorough examination.  If you believe you have PCOS or notice any symptoms, you should see a doctor for a proper diagnosis and treatment.</p>
                <center>
                  <button type="button" class="btn btn-primary btn-lg" id="btnStart"><i class="bi bi-arrow-right"></i>&nbsp;START</button>
                </center>
                <br/>
                <center id="btnResult" style="display:none;">
                  <a href="<?=site_url('customer/history')?>" class="btn btn-link btn-sm">View Result</a>
                </center>
              </div>
            </div>
            <div class="card" id="frmQuestion" style="display:none;">
              <div class="card-body">
                <h4 class="card-title"><i class="bi bi-clipboard-data"></i>&nbsp;PCOS Awareness Survey</h4>
                <hr/>
                <form method="POST" class="row g-3" id="frmSurvey">
                  <input type="hidden" name="customer" value="<?php echo session()->get('sess_id') ?>"/>
                  <input type="hidden" name="location" id="location"/>
                  <div class="col-12 form-group">
                    <h6><b>Respondent's Information</b></h6>
                    <div class="row g-3">
                      <div class="col-lg-10">
                        <label><b>Complete Name</b></label>
                        <input type="text" class="form-control" value="<?php echo session()->get('sess_fullname'); ?>"/>
                      </div>
                      <div class="col-lg-2">
                        <label><b>Age</b></label>
                        <input type="number" class="form-control" name="age" required/>
                      </div>
                    </div>
                  </div>
                  <h6><b><center>Questions/Survey</center></b></h6>
                  <?php foreach($survey as $rows):?>
                    <input type="hidden" name="survey" value="<?php echo $rows->surveyID ?>"/>
                    <?php
                      $db;$this->db = db_connect();
                      $builder = $this->db->table('tblquestion');
                      $builder->select('Question,questionID,Sequence');
                      $builder->WHERE('surveyID',$rows->surveyID)->WHERE('Sequence','Question 1');
                      $data = $builder->get();
                      if($row = $data->getRow())
                      {
                        ?>
                        <input type="hidden" name="question1" value="<?php echo $row->questionID ?>"/>
                        <h6><b><?php echo $row->Sequence ?>.&nbsp;<?php echo $row->Question ?></b></h6>
                        <?php
                        $builder = $this->db->table('tblchoice');
                        $builder->select('choiceID,Details');
                        $builder->WHERE('questionID',$row->questionID);
                        $data = $builder->get();
                        foreach($data->getResult() as $answer)
                        {
                          ?>
                          <div>
                          <input type="radio" class="form-check-input" name="answer1" id="<?php echo $answer->choiceID ?>" value="<?php echo $answer->choiceID ?>"/>&nbsp;<?php echo $answer->Details ?>
                          </div>
                          <?php
                        }
                         ?>
                        <?php
                      }
                    ?>
                    <?php
                      $builder = $this->db->table('tblquestion');
                      $builder->select('Question,questionID,Sequence');
                      $builder->WHERE('surveyID',$rows->surveyID)->WHERE('Sequence','Question 2');
                      $data = $builder->get();
                      if($row = $data->getRow())
                      {
                        ?>
                        <input type="hidden" name="question2" value="<?php echo $row->questionID ?>"/>
                        <h6><b><?php echo $row->Sequence ?>.&nbsp;<?php echo $row->Question ?></b></h6>
                        <?php
                        $builder = $this->db->table('tblchoice');
                        $builder->select('choiceID,Details');
                        $builder->WHERE('questionID',$row->questionID);
                        $data = $builder->get();
                        foreach($data->getResult() as $answer)
                        {
                          ?>
                          <div>
                          <input type="radio" class="form-check-input" name="answer2" id="<?php echo $answer->choiceID ?>" value="<?php echo $answer->choiceID ?>"/>&nbsp;<?php echo $answer->Details ?>
                          </div>
                          <?php
                        }
                         ?>
                        <?php
                      }
                    ?>
                    <?php
                      $builder = $this->db->table('tblquestion');
                      $builder->select('Question,questionID,Sequence');
                      $builder->WHERE('surveyID',$rows->surveyID)->WHERE('Sequence','Question 3');
                      $data = $builder->get();
                      if($row = $data->getRow())
                      {
                        ?>
                        <input type="hidden" name="question3" value="<?php echo $row->questionID ?>"/>
                        <h6><b><?php echo $row->Sequence ?>.&nbsp;<?php echo $row->Question ?></b></h6>
                        <?php
                        $builder = $this->db->table('tblchoice');
                        $builder->select('choiceID,Details');
                        $builder->WHERE('questionID',$row->questionID);
                        $data = $builder->get();
                        foreach($data->getResult() as $answer)
                        {
                          ?>
                          <div>
                          <input type="radio" class="form-check-input" name="answer3" id="<?php echo $answer->choiceID ?>" value="<?php echo $answer->choiceID ?>"/>&nbsp;<?php echo $answer->Details ?>
                          </div>
                          <?php
                        }
                         ?>
                        <?php
                      }
                    ?>
                    <?php
                      $builder = $this->db->table('tblquestion');
                      $builder->select('Question,questionID,Sequence');
                      $builder->WHERE('surveyID',$rows->surveyID)->WHERE('Sequence','Question 4');
                      $data = $builder->get();
                      if($row = $data->getRow())
                      {
                        ?>
                        <input type="hidden" name="question4" value="<?php echo $row->questionID ?>"/>
                        <h6><b><?php echo $row->Sequence ?>.&nbsp;<?php echo $row->Question ?></b></h6>
                        <?php
                        $builder = $this->db->table('tblchoice');
                        $builder->select('choiceID,Details');
                        $builder->WHERE('questionID',$row->questionID);
                        $data = $builder->get();
                        foreach($data->getResult() as $answer)
                        {
                          ?>
                          <div>
                          <input type="radio" class="form-check-input" name="answer4" id="<?php echo $answer->choiceID ?>" value="<?php echo $answer->choiceID ?>"/>&nbsp;<?php echo $answer->Details ?>
                          </div>
                          <?php
                        }
                         ?>
                        <?php
                      }
                      ?>
                      <?php
                      $builder = $this->db->table('tblquestion');
                      $builder->select('Question,questionID,Sequence');
                      $builder->WHERE('surveyID',$rows->surveyID)->WHERE('Sequence','Question 5');
                      $data = $builder->get();
                      if($row = $data->getRow())
                      {
                        ?>
                        <input type="hidden" name="question5" value="<?php echo $row->questionID ?>"/>
                        <h6><b><?php echo $row->Sequence ?>.&nbsp;<?php echo $row->Question ?></b></h6>
                        <?php
                        $builder = $this->db->table('tblchoice');
                        $builder->select('choiceID,Details');
                        $builder->WHERE('questionID',$row->questionID);
                        $data = $builder->get();
                        foreach($data->getResult() as $answer)
                        {
                          ?>
                          <div>
                          <input type="radio" class="form-check-input" name="answer5" id="<?php echo $answer->choiceID ?>" value="<?php echo $answer->choiceID ?>"/>&nbsp;<?php echo $answer->Details ?>
                          </div>
                          <?php
                        }
                         ?>
                        <?php
                      }
                    ?>
                    <?php
                      $builder = $this->db->table('tblquestion');
                      $builder->select('Question,questionID,Sequence');
                      $builder->WHERE('surveyID',$rows->surveyID)->WHERE('Sequence','Question 6');
                      $data = $builder->get();
                      if($row = $data->getRow())
                      {
                        ?>
                        <input type="hidden" name="question6" value="<?php echo $row->questionID ?>"/>
                        <h6><b><?php echo $row->Sequence ?>.&nbsp;<?php echo $row->Question ?></b></h6>
                        <?php
                        $builder = $this->db->table('tblchoice');
                        $builder->select('choiceID,Details');
                        $builder->WHERE('questionID',$row->questionID);
                        $data = $builder->get();
                        foreach($data->getResult() as $answer)
                        {
                          ?>
                          <div>
                          <input type="radio" class="form-check-input" name="answer6" id="<?php echo $answer->choiceID ?>" value="<?php echo $answer->choiceID ?>"/>&nbsp;<?php echo $answer->Details ?>
                          </div>
                          <?php
                        }
                         ?>
                        <?php
                      }
                    ?>
                    <?php
                      $builder = $this->db->table('tblquestion');
                      $builder->select('Question,questionID,Sequence');
                      $builder->WHERE('surveyID',$rows->surveyID)->WHERE('Sequence','Question 7');
                      $data = $builder->get();
                      if($row = $data->getRow())
                      {
                        ?>
                        <input type="hidden" name="question7" value="<?php echo $row->questionID ?>"/>
                        <h6><b><?php echo $row->Sequence ?>.&nbsp;<?php echo $row->Question ?></b></h6>
                        <?php
                        $builder = $this->db->table('tblchoice');
                        $builder->select('choiceID,Details');
                        $builder->WHERE('questionID',$row->questionID);
                        $data = $builder->get();
                        foreach($data->getResult() as $answer)
                        {
                          ?>
                          <div>
                          <input type="radio" class="form-check-input" name="answer7" id="<?php echo $answer->choiceID ?>" value="<?php echo $answer->choiceID ?>"/>&nbsp;<?php echo $answer->Details ?>
                          </div>
                          <?php
                        }
                         ?>
                        <?php
                      }
                    ?>
                    <?php
                      $builder = $this->db->table('tblquestion');
                      $builder->select('Question,questionID,Sequence');
                      $builder->WHERE('surveyID',$rows->surveyID)->WHERE('Sequence','Question 8');
                      $data = $builder->get();
                      if($row = $data->getRow())
                      {
                        ?>
                        <input type="hidden" name="question8" value="<?php echo $row->questionID ?>"/>
                        <h6><b><?php echo $row->Sequence ?>.&nbsp;<?php echo $row->Question ?></b></h6>
                        <?php
                        $builder = $this->db->table('tblchoice');
                        $builder->select('choiceID,Details');
                        $builder->WHERE('questionID',$row->questionID);
                        $data = $builder->get();
                        foreach($data->getResult() as $answer)
                        {
                          ?>
                          <div>
                          <input type="radio" class="form-check-input" name="answer8" id="<?php echo $answer->choiceID ?>" value="<?php echo $answer->choiceID ?>"/>&nbsp;<?php echo $answer->Details ?>
                          </div>
                          <?php
                        }
                         ?>
                        <?php
                      }
                    ?>
                    <?php
                      $builder = $this->db->table('tblquestion');
                      $builder->select('Question,questionID,Sequence');
                      $builder->WHERE('surveyID',$rows->surveyID)->WHERE('Sequence','Question 9');
                      $data = $builder->get();
                      if($row = $data->getRow())
                      {
                        ?>
                        <input type="hidden" name="question9" value="<?php echo $row->questionID ?>"/>
                        <h6><b><?php echo $row->Sequence ?>.&nbsp;<?php echo $row->Question ?></b></h6>
                        <?php
                        $builder = $this->db->table('tblchoice');
                        $builder->select('choiceID,Details');
                        $builder->WHERE('questionID',$row->questionID);
                        $data = $builder->get();
                        foreach($data->getResult() as $answer)
                        {
                          ?>
                          <div>
                          <input type="radio" class="form-check-input" name="answer9" id="<?php echo $answer->choiceID ?>" value="<?php echo $answer->choiceID ?>"/>&nbsp;<?php echo $answer->Details ?>
                          </div>
                          <?php
                        }
                         ?>
                        <?php
                      }
                    ?>
                    <?php
                      $builder = $this->db->table('tblquestion');
                      $builder->select('Question,questionID,Sequence');
                      $builder->WHERE('surveyID',$rows->surveyID)->WHERE('Sequence','Question 10');
                      $data = $builder->get();
                      if($row = $data->getRow())
                      {
                        ?>
                        <input type="hidden" name="question10" value="<?php echo $row->questionID ?>"/>
                        <h6><b><?php echo $row->Sequence ?>.&nbsp;<?php echo $row->Question ?></b></h6>
                        <?php
                        $builder = $this->db->table('tblchoice');
                        $builder->select('choiceID,Details');
                        $builder->WHERE('questionID',$row->questionID);
                        $data = $builder->get();
                        foreach($data->getResult() as $answer)
                        {
                          ?>
                          <div>
                          <input type="radio" class="form-check-input" name="answer10" id="<?php echo $answer->choiceID ?>" value="<?php echo $answer->choiceID ?>"/>&nbsp;<?php echo $answer->Details ?>
                          </div>
                          <?php
                        }
                         ?>
                        <?php
                      }
                    ?>
                  <?php endforeach; ?>
                <input type="submit" class="form-control btn btn-primary text-white" id="btnSave" value="Submit"/>
                </form>
              </div>
            </div>
            <div class="card" id="successMessage" style="display:none;">
              <br/>
              <center><span class="bi bi-check-circle text-success" style="font-size:100px;"></span></center>
              <h1 class="text-center text-success">Successfully submitted</h1>
              <center>
                <a href="<?=site_url('customer/history')?>" class="btn btn-primary">View Result</a>
              </center>
              <br/>
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
        $(document).ready(function()
        {
          let patientLatitude="";
          let patientLongitude="";
          if(navigator.geolocation){
            navigator.geolocation.watchPosition(function(position) {
                console.log("Tracking Patients");
                patientLatitude = position.coords.latitude;
                patientLongitude = position.coords.longitude;
                const url = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${patientLatitude}&longitude=${patientLongitude}&localityLanguage=en`;
                let location = '';
                let road, quarter, quarter2, locality, city, city2 = '';
                fetch(url)
                .then(res => res.json())
                .then(data => {
                  quarter2 = data.localityInfo.administrative[data.localityInfo.administrative.length - 1].name;
                  locality = data.locality;
                  city2 = data.city;
                  
                  $('#log').html($('#log').html() + '</br>' + 'url: ' + quarter2 + ' ' + locality + ' ' + city2);
                  
                  if(quarter == '' || city == '' || quarter == undefined || city == undefined){
                      location = 'near ' + quarter2 + ', ' + locality + ', ' + city2;
                  }
                  else if(quarter == quarter2){
                      location = 'near ' + road + ', ' + quarter + ', ' + city;
                  }
                  else{
                      location = 'near ' + road + ', ' + quarter + ', ' + city + ' and ' + quarter2 + ', ' + locality + ', ' + city2;
                  }
                  $('#location').attr("value",location);
                })
                .catch(() => {
                });   
              },
              function(error) {
                if (error.code == error.PERMISSION_DENIED);
              });
          }else{ 
              alert("Geolocation is not supported by this browser.");
          }
        });
        $('#btnStart').on('click',function(e)
        {
          e.preventDefault();
          document.getElementById('frmStart').style="display:none";
          document.getElementById('frmQuestion').style="display:block";
        });
        $('#btnSave').on('click',function(e)
        {
          e.preventDefault();
          var data = $('#frmSurvey').serialize();
          $.ajax({
            url:"<?=site_url('save-record')?>",method:"POST",
            data:data,success:function(response)
            {
              if(response==="success")
              {
                $('#frmSurvey')[0].reset();
                document.getElementById('frmQuestion').style="display:none";
                document.getElementById('successMessage').style="display:block";
              }
              else
              {
                alert(response);
                document.getElementById('frmStart').style="display:block";
                document.getElementById('frmQuestion').style="display:none";
                document.getElementById('btnResult').style="display:block";
              }
            }
          });
        });
      </script>
   </body>
</html>