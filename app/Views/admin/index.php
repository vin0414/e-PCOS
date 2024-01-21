<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <link href="../assets/img/logo.png" rel="icon">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!--=============== REMIXICONS ===============-->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="../assets/css/styles.css">

      <title>Administator Dashboard</title>
   </head>
   <body>
      <!--=============== HEADER ===============-->
      <header class="header">
         <nav class="nav container">
            <div class="nav__data">
               <a href="/" class="nav__logo">
                  <img src="../assets/img/logo.png" alt="logo">PCOS Awareness
               </a>
               
               <div class="nav__toggle" id="nav-toggle">
                  <i class="ri-menu-line nav__line"></i>
                  <i class="ri-close-line nav__close"></i>
               </div>
            </div>

      <!--=============== NAV MENU ===============-->
            <div class="nav__menu" id="nav-menu">
               <ul class="nav__list">
                  <li><a href="<?=site_url('admin/dashboard')?>" class="nav__link">Dashboard</a></li>
      <!--=============== DROPDOWN  ===============-->
                  <li><a href="admin/manage" class="nav__link"> Manage</a></li>
                  <li><a href="admin/report" class="nav__link"> Report</a></li>
                  <li><a href="admin/user-account" class="nav__link"> User Account</a></li>
                  <li class="dropdown__item">
                     <div class="nav__link"> Profile <i class="ri-arrow-down-s-line dropdown__arrow"></i></div>
                     <ul class="dropdown__menu">
                        <li>
                           <a href="<?=site_url('admin/profile')?>" class="dropdown__link">
                            Account Setting
                           </a>                          
                        </li>
                        <li>
                           <a href="<?=site_url('/logout')?>" class="dropdown__link" onclick="return confirm('Do you want to sign-out?');" >
                            Logout
                           </a>
                        </li>
                     </ul>
                  </li>
            </div>
         </nav>
      </header>
<!--=============== HOME SECTION  ===============-->
<section class="home" id="home">
    <div class="content">
        <div class="row g-3">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Total </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


      <!--=============== MAIN JS ===============-->
      <script src="../assets/js/main.js"></script>
   </body>
</html>