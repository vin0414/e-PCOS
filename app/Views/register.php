<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="assets/img/logo.png" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    <div class="img">
    <img class=".img-fluid" src="assets/img/logo.png" alt="logo" style="width:100%;">
    </div>
    <div class="background-overlay"></div>
      <div class="form">
        <?php if(!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('fail'); ?>
            </div>
        <?php endif; ?>
        <form class="register-form" method="POST" action="<?=base_url('create-account')?>">
            <h2><i class="fas fa-lock"></i> Register</h2>
            <input type="text" placeholder="Full Name *" name="fullname" required/>
            <input type="email" placeholder="Email *" name="email" required/>
            <input type="password" placeholder="Password *" name="password" style="color:#000;" required/>
            <input type="password" placeholder="Retype Password *" name="confirm_password"  style="color:#000;" required/>
            <button type="submit">Create Account</button>
            <p class="message">Already registered? <a href="/login" id="login-link">Sign In</a></p>
            <a href="/">Go to Home</a>
        </form>
      </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.register-form').show();
    });
</script>
</body>
</html>
