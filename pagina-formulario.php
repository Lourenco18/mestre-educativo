<?php
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
include $arrConfig['dir_include'].'/auth.inc.php';
include $arrConfig['dir_admin'].'/head.inc.php';
?>

  <body>
   
    <div class="layout-wrapper layout-content-navbar">
   
        <!-- Menu -->
        <?php
        include "php/include/menu.php";
        ?>
        <!-- Menu -->

        <div class="layout-page">

          <!-- Navbar -->
        <?php
            include $arrConfig['dir_navbar'].'/navbar.php';
       ?>
          <!-- / Navbar -->

          <br>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
              <?php
              include "php/include/forms.inc.php";
      
             ?>
          
            <!-- / Content -->
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>

    </div>


   <?php
include $arrConfig['dir_admin'].'/end.inc.php';
?>


   


