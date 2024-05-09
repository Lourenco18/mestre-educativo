
<?php
include 'php/include/config.inc.php';
include $arrConfig['dir_include'].'/auth.inc.php';

include $arrConfig['dir_admin'].'/head.inc.php';
?>

  <body>
   
    <div class="layout-wrapper layout-content-navbar">
   
        <!-- Menu -->
        <?php
        include $arrConfig['dir_include']."/menu.php";
        ?>
        <!-- Menu -->

        <div class="layout-page">

           <!-- Navbar -->
     <?php
       include $arrConfig['dir_navbar'].'/navbar.php';
     ?>
     <!-- / Navbar -->

          <br>

          <!-- cards-->
        <div class="content-wrapper">
          <div class="row  row-cols-sm-2  row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3 "   >
              <?php
              include  $arrConfig['dir_include']."/card.inc.php";
              ?>
              
            <div class="content-backdrop fade"></div>
          </div>
          
          <!-- cards-->

        </div>
        

        <div class="layout-overlay layout-menu-toggle"></div>
        <button style="position: fixed; left: 94%; bottom: 10%; font-size: 32px; padding: 10px 20px; z-index: 9999; border-radius: 5px;" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalnotes">
    <i class="bx bx-clipboard"></i>
</button>
    </div>


   <?php
include $arrConfig['dir_admin'].'/end.inc.php';
?>



