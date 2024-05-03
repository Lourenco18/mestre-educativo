<?php
include 'php/include/config.inc.php';
include $arrConfig['dir_include'].'/auth.inc.php';

include $arrConfig['dir_admin'].'/head.inc.php';
if(isset($_GET['display'])){
  $display = $_GET['display'];
}else{
  $pagina = "";
};
?>
<style>
    #content-wrapper, #toggleViewBtn {
       width: 40px; 
        height: 40px; 
        background-color: rgb(97, 99, 235); 
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: white; 
        font-size: 24px; 
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        
        right: 20px; 
    }
   
 
</style>
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

          <!-- cards-->
          <div class="content-wrapper">

          <div class="row  row-cols-sm-2  row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3 "   >
              
              <?php
              include "php/include/card.inc.php";
              ?>

            <div class="content-backdrop fade"></div>
            
          </div>
          <div><hr class = "mb-4"style="border-color: #566a7f; display: block;  margin-left: 0; margin-right: 0; border-width: 1px;"></div>
        
          <div class="content-wrapper">
          
          <?php
              include "php/include/titulo_listas.inc.php";
              ?>
              
              <button id="toggleViewBtn"><i class='bx bx-menu'></i></button>
              <div id="cardView" >
             
            <div class="row row-cols-sm-2 row-cols-2 row-cols-xl-6 row-cols-lg-5 row-cols-md-4 g-4 mb-2 ps-lg-4 pe-lg-3 "   >
              <?php
              include "php/include/listas.inc.php";
              ?>

            <div class="content-backdrop fade"></div>
            </div>
          </div>


        <div class="layout-overlay layout-menu-toggle"></div>

    </div>


    <?php
include $arrConfig['dir_admin'].'/end.inc.php';
?>

<script>document.getElementById('toggleViewBtn').addEventListener('click', function() {
    var cardView = document.getElementById('cardView');
    var tableView = document.getElementById('tableView');

    if (cardView.style.display === 'none') {
        cardView.style.display = 'block';
        tableView.style.display = 'none';
    } else {
        cardView.style.display = 'none';
        tableView.style.display = 'block';
    }
});</script>


