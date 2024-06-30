<!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?php echo $arrConfig['url_vendor'] ?>/libs/jquery/jquery.js"></script>
    <script src="<?php echo $arrConfig['url_vendor'] ?>/libs/popper/popper.js"></script>
    <script src="<?php echo $arrConfig['url_vendor'] ?>/js/bootstrap.js"></script>
    <script src="<?php echo $arrConfig['url_vendor'] ?>/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?php echo $arrConfig['url_vendor'] ?>/js/menu.js"></script>
    <script src="<?php echo $arrConfig['url_js'] ?>/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo $arrConfig['url_vendor'] ?>/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?php echo $arrConfig['url_site'] ?>/assets/js/main.js"></script>

    <script src="<?php echo $arrConfig['url_site'] ?>/calender/index.global.min.js"></script>
   
  </body>

<!-- Functions js -->
<script src="<?php echo $arrConfig['url_js'] ?>/functions.js"></script>

  <?php
include $arrConfig['dir_admin'].'/modal.inc.php';
?>
</html>

