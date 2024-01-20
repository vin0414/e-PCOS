<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="assets/img/logo.png" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script> 
    <script src= "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"> </script>
</head>
<body>
  <div class="login-page">
    <div class="background-overlay"></div>
      <div class="form">
        <?php if(!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('fail'); ?>
            </div>
        <?php endif; ?>
        <form class="login-form" method="post" action="<?=site_url('check')?>">
            <center>
                <img class=".img-fluid" src="assets/img/logo.png" alt="logo" width="100">
            </center>
            <br/>
            <input type="email" placeholder="Email" required />
            <input type="password" placeholder="Password" required/>
            <button type="submit" name="send2">login</button>
            <p class="message"><br/>Forgot Password? <a href="/forgot-password">Click here</a></p>
       </form>
      </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
