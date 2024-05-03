
<?php
include "/Applications/XAMPP/xamppfiles/htdocs/mestre-educativo/php/include/config.inc.php";
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
<?php
  $current_page = $_SERVER['REQUEST_URI'];

  // Extrai o nome do arquivo da URI
  $page_name = basename($current_page);

  if (isset($particao)) {
    
  }
  echo '<title>'.$page_name.'</title>'
?>
    
  
    
 
    

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php echo $arrConfig['url_vendor'] ?>/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo $arrConfig['url_vendor'] ?>/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo $arrConfig['url_vendor'] ?>/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo $arrConfig['url_site'] ?>/assets/css/demo.css" />
    
   

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo $arrConfig['url_vendor'] ?>//libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="<?php echo $arrConfig['url_vendor'] ?>/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?php echo $arrConfig['url_vendor'] ?>/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo $arrConfig['url_site'] ?>/assets/js/config.js"></script>


    <!-- JQuery -->
   <!-- <script src="jquery-3.3.1.min.js"></script> -->
   
   <!-- Sweet Alert -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <link rel="stylesheet" href='../files/bower_components/sweetalert/css/sweetalert2.min.css' media="screen" /> -->
   <!-- Favicon -->
   <link rel="icon" type="image/x-icon" href="<?php echo $arrConfig['url_site'] ?>/assets/img/favicon/favicon.ico" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
/>

<!-- Icons. Uncomment required icon fonts -->
<link rel="stylesheet" href="<?php echo $arrConfig['url_vendor'] ?>/fonts/boxicons.css" />

<!-- Core CSS -->
<link rel="stylesheet" href="<?php echo $arrConfig['url_vendor'] ?>/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="<?php echo $arrConfig['url_vendor'] ?>/css/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="<?php echo $arrConfig['url_site'] ?>/assets/css/demo.css" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="<?php echo $arrConfig['url_vendor'] ?>/libs/perfect-scrollbar/perfect-scrollbar.css" />

<!-- Page CSS -->
<!-- Page -->
<link rel="stylesheet" href="<?php echo $arrConfig['url_vendor'] ?>/css/pages/page-auth.css" />




<!--calender -->
<link rel="stylesheet" href="<?php echo $arrConfig['url_site'] ?>/calender/calender.css">

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  
</head>
