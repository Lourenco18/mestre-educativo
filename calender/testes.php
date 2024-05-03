<?php
include '../php/include/config.inc.php';

include $arrConfig['dir_admin'].'/head.inc.php';
?>
<body>
<div class="layout-wrapper layout-content-navbar">
   
   <!-- Menu -->
   <?php
   include "../php/include/menu.php";
   ?>
   <!-- Menu -->

   <div class="layout-page">

     <!-- Navbar -->
     <?php
       include $arrConfig['dir_navbar'].'/navbar.php';
     ?>
     <!-- / Navbar -->

     <br>

 

   <div class="layout-overlay layout-menu-toggle"></div>
   <div class = 'py-xl-3'id='calendar'></div>
  
   
<?php
include $arrConfig['dir_admin'].'/sweetalert.inc.php';
include $arrConfig['dir_admin'].'/modal.inc.php';
?>calender/testes.php
</div>

<?php
include $arrConfig['dir_admin'].'/end.inc.php';
?>