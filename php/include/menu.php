<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <div class="app-brand demo">
    <a href="index.php" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="imjs/logos/logo.png" style="height: 50px;" alt="">

      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Mestre <br>Educative </span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>




  <ul class="menu-inner py-1">
    <?php

    ?>
    <li class="menu-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
      <a href="index.php" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Página Inicial</div>
      </a>
    </li>
    <?php
    if (isset($_GET['pagina'])) {
      $pagina = $_GET['pagina'];
    } else {
      $pagina = "";
    }
    ;



    $arrparticoes = my_query('SELECT * FROM operacao WHERE ativo = 1 and  pai = 1 and visivel = 1 and nivel <>' . $nivel . ' ORDER BY ordem ASC');

    foreach ($arrparticoes as $k => $v) {

      echo '<li class="menu-header small text-uppercase" >
    <a href="' . $arrConfig['url_site'] . '/' . $v['link'] . '?pagina=' . $v['operacao'] . '&display=' . $v['display'] . '" >' . $v['display'] . '</a>
  </li>';
      $arroperacoes = my_query('SELECT * FROM operacao WHERE ativo = 1 AND particao = "' . $v['operacao'] . '"');
      foreach ($arroperacoes as $s => $w) {
        echo '<li class="menu-item ' . ($pagina == $w['operacao'] ? 'active' : '') . '">

    <a href="' . $arrConfig['url_site'] . '/' . $w['link'] . '?display=' . $w['display'] . '&pagina=' . $w['operacao'] . '&especificacao=' . $w['tipo_form'] . '&tipo=' . $w['particao'] . '" class="menu-link">
          <img class="menu-icon" src="' . $arrConfig['url_icons'] . '/' . $w['foto_operacao'] . '" >
        <div>' . $w['display'] . '</div>
    </a>
 </li> ';
      }
      ;

    }
    ;
    ?>
  </ul>

</aside>