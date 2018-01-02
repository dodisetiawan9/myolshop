
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Olshopku</title>
      <!-- Materialize Css -->
      <link rel="stylesheet" href="<?= base_url(); ?>assets/css/materialize.min.css">
      <!-- Font-Awesome -->
      <link rel="stylesheet" href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
      <!-- customCss -->
      <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">
   </head>
   <body>
      <header>
         <nav class="light-blue darken-2">
            <div class="nav-wrapper container">
               <ul id="nav-mobile" class="right hide-on-med-and-down">
                  <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>

                  <?php if($this->session->userdata('user_login')) { ?>
                     <li><a href="#" class="dropdown-button" data-activates="drop1"><i class="fa fa-user"></i> <?= $this->session->userdata('name'); ?><i class="fa fa-caret-down right"></i></a></li>
                        
                        <ul class="dropdown-content" id="drop1">
                           <li><a href="<?= base_url(); ?>home/profile"><i class="fa fa-user"></i> Profile</a></li>
                           <li><a href="<?= base_url(); ?>home/password"><i class="fa fa-key"></i> Ubah Password</a></li>
                           <li><a href="<?= base_url(); ?>home/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>

                  <?php } else{ ?>
                  <li><a href="<?= base_url(); ?>home/login"><i class="fa fa-sign-in"></i> login</a></li>
                  <li><a href="<?= base_url(); ?>home/register"><i class="fa fa-edit"></i> Daftar</a></li>

                  <?php } ?>
              <li><a href="<?= base_url(); ?>cart"><i class="fa fa-shopping-cart"></i> 
              <?php 
                  if($this->cart->total() > 0){
                     echo 'Rp. '.number_format($this->cart->total(),0,',','.');
                  } 
                  else{
                     echo 'cart';
                  }
              ?>
                  </a>
              </li>
               </ul>
               <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Side Nav -->
            <ul id="slide-out" class="side-nav">
               <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
              <?php if($this->session->userdata('user_login')) { ?>
                     <li><a href="#" class="dropdown-button" data-activates="drop2"><i class="fa fa-user"></i> <?= $this->session->userdata('name'); ?><i class="fa fa-caret-down right"></i></a></li>
                        
                        <ul class="dropdown-content" id="drop2">
                           <li><a href=""><i class="fa fa-user"></i> Profile</a></li>
                           <li><a href=""><i class="fa fa-key"></i> Ubah Password</a></li>
                           <li><a href=""><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>

                  <?php } else{ ?>
                  <li><a href="<?= base_url(); ?>home/login"><i class="fa fa-sign-in"></i> login</a></li>
                  <li><a href="<?= base_url(); ?>home/register"><i class="fa fa-edit"></i> Daftar</a></li>

                  <?php } ?>
               <li><a href="#"><i class="fa fa-shopping-cart"></i> 
                  
                  <?php 
                     if($this->cart->total() > 0){
                        echo 'Rp. '.number_format($this->cart->total(),0,',','.');
                     } 
                     else{
                        echo 'cart';
                     }
                  ?>
                  
               </a></li>
            </ul>
         </nav>
      </header>

      <main>
         <div class="toko">
            <h2><a href="#"><i class="fa fa-shopping-cart"></i> OlShopKu</a></h2>
            <p>Teman Belanja Anda yang Terpercaya</p>
         </div>
         <div class="cont">
            <!-- start item -->
            <div class="item">

               <?php echo $content; ?>
            <!-- end item -->
            </div>

            <footer class="page-footer light-blue darken-3">
               <div class="container">
                  <div class="row">
                     <div class="col l6 s12">
                        <h5 class="white-text">Alamat Toko</h5>
                        <p class="grey-text text-lighten-4">Jl. Nanas No. 24 Ds. Mlandangan, Pace - Nganjuk<br /><i class="fa fa-phone-square"></i> 085X-XXXX-X355</p>
                     </div>
                     <div class="col l5 offset-l1 s12">
                        <h5 class="white-text">Kami di</h5>
                        <div class="link">
                           <a class="grey-text text-lighten-3" href="#!"><i class="fa fa-facebook"></i> Facebook</a>&nbsp;&nbsp;
                           <a class="grey-text text-lighten-3" href="#!"><i class="fa fa-twitter"></i> Twitter</a>&nbsp;&nbsp;
                           <a class="grey-text text-lighten-3" href="#!"><i class="fa fa-google-plus"></i> Google+</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="footer-copyright">
                  <div class="container">
                     Copyright © 2017 OlShopKu. All Rights Reserved.
                     <span class="grey-text text-lighten-4 right">Develope By <a class="blue-text text-lighten-4" href="#!">Achmad Jazuli</a></span>
                  </div>
               </div>
            </footer>
         </div>
      </main>

      <a href="" class="btn-floating btn-large waves-effect waves-light red back-top"><i class="fa fa-angle-double-up"></i></a>

      <!-- Jquery -->
      <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
      <!-- materialize -->
      <script type="text/javascript" src="<?= base_url(); ?>assets/js/materialize.min.js"></script>
      <!-- custom -->
      <script type="text/javascript">
         $(".button-collapse").sideNav();
         $(".modal").modal();

         $(document).ready(function() {

            $(window).scroll(function(){
               if ($(this).scrollTop() > 100) {
                  $('.back-top').fadeIn();
               } else {
                  $('.back-top').fadeOut();
               }
            });
            $('.back-top').click(function(){
               $("html, body").animate({ scrollTop: 0 }, 600);
               return false;
            });
         });
      </script>
   </body>
</html>

