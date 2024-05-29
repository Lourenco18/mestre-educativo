<style>
  @charset "UTF-8";
:root {
  --dt-row-selected: 13, 110, 253;
  --dt-row-selected-text: 255, 255, 255;
  --dt-row-selected-link: 9, 10, 11;
  --dt-row-stripe: 0, 0, 0;
  --dt-row-hover: 0, 0, 0;
  --dt-column-ordering: 0, 0, 0;
  --dt-html-background: white;
}
:root.dark {
  --dt-html-background: rgb(33, 37, 41);
}

table.dataTable td.dt-control {
  text-align: center;
  cursor: pointer;
}
table.dataTable td.dt-control:before {
  display: inline-block;
  box-sizing: border-box;
  content: "";
  border-top: 5px solid transparent;
  border-left: 10px solid rgba(0, 0, 0, 0.5);
  border-bottom: 5px solid transparent;
  border-right: 0px solid transparent;
}
table.dataTable tr.dt-hasChild td.dt-control:before {
  border-top: 10px solid rgba(0, 0, 0, 0.5);
  border-left: 5px solid transparent;
  border-bottom: 0px solid transparent;
  border-right: 5px solid transparent;
}

html.dark table.dataTable td.dt-control:before,
:root[data-bs-theme=dark] table.dataTable td.dt-control:before {
  border-left-color: rgba(255, 255, 255, 0.5);
}
html.dark table.dataTable tr.dt-hasChild td.dt-control:before,
:root[data-bs-theme=dark] table.dataTable tr.dt-hasChild td.dt-control:before {
  border-top-color: rgba(255, 255, 255, 0.5);
  border-left-color: transparent;
}

div.dt-scroll-body thead tr,
div.dt-scroll-body tfoot tr {
  height: 0;
}
div.dt-scroll-body thead tr th, div.dt-scroll-body thead tr td,
div.dt-scroll-body tfoot tr th,
div.dt-scroll-body tfoot tr td {
  height: 0 !important;
  padding-top: 0px !important;
  padding-bottom: 0px !important;
  border-top-width: 0px !important;
  border-bottom-width: 0px !important;
}
div.dt-scroll-body thead tr th div.dt-scroll-sizing, div.dt-scroll-body thead tr td div.dt-scroll-sizing,
div.dt-scroll-body tfoot tr th div.dt-scroll-sizing,
div.dt-scroll-body tfoot tr td div.dt-scroll-sizing {
  height: 0 !important;
  overflow: hidden !important;
}

table.dataTable thead > tr > th:active,
table.dataTable thead > tr > td:active {
  outline: none;
}
table.dataTable thead > tr > th.dt-orderable-asc span.dt-column-order:before, table.dataTable thead > tr > th.dt-ordering-asc span.dt-column-order:before,
table.dataTable thead > tr > td.dt-orderable-asc span.dt-column-order:before,
table.dataTable thead > tr > td.dt-ordering-asc span.dt-column-order:before {
  position: absolute;
  display: block;
  bottom: 50%;
  content: "▲";
  content: "▲"/"";
}
table.dataTable thead > tr > th.dt-orderable-desc span.dt-column-order:after, table.dataTable thead > tr > th.dt-ordering-desc span.dt-column-order:after,
table.dataTable thead > tr > td.dt-orderable-desc span.dt-column-order:after,
table.dataTable thead > tr > td.dt-ordering-desc span.dt-column-order:after {
  position: absolute;
  display: block;
  top: 50%;
  content: "▼";
  content: "▼"/"";
}
table.dataTable thead > tr > th.dt-orderable-asc, table.dataTable thead > tr > th.dt-orderable-desc, table.dataTable thead > tr > th.dt-ordering-asc, table.dataTable thead > tr > th.dt-ordering-desc,
table.dataTable thead > tr > td.dt-orderable-asc,
table.dataTable thead > tr > td.dt-orderable-desc,
table.dataTable thead > tr > td.dt-ordering-asc,
table.dataTable thead > tr > td.dt-ordering-desc {
  position: relative;
  padding-right: 30px;
}
table.dataTable thead > tr > th.dt-orderable-asc span.dt-column-order, table.dataTable thead > tr > th.dt-orderable-desc span.dt-column-order, table.dataTable thead > tr > th.dt-ordering-asc span.dt-column-order, table.dataTable thead > tr > th.dt-ordering-desc span.dt-column-order,
table.dataTable thead > tr > td.dt-orderable-asc span.dt-column-order,
table.dataTable thead > tr > td.dt-orderable-desc span.dt-column-order,
table.dataTable thead > tr > td.dt-ordering-asc span.dt-column-order,
table.dataTable thead > tr > td.dt-ordering-desc span.dt-column-order {
  position: absolute;
  right: 12px;
  top: 0;
  bottom: 0;
  width: 12px;
}
table.dataTable thead > tr > th.dt-orderable-asc span.dt-column-order:before, table.dataTable thead > tr > th.dt-orderable-asc span.dt-column-order:after, table.dataTable thead > tr > th.dt-orderable-desc span.dt-column-order:before, table.dataTable thead > tr > th.dt-orderable-desc span.dt-column-order:after, table.dataTable thead > tr > th.dt-ordering-asc span.dt-column-order:before, table.dataTable thead > tr > th.dt-ordering-asc span.dt-column-order:after, table.dataTable thead > tr > th.dt-ordering-desc span.dt-column-order:before, table.dataTable thead > tr > th.dt-ordering-desc span.dt-column-order:after,
table.dataTable thead > tr > td.dt-orderable-asc span.dt-column-order:before,
table.dataTable thead > tr > td.dt-orderable-asc span.dt-column-order:after,
table.dataTable thead > tr > td.dt-orderable-desc span.dt-column-order:before,
table.dataTable thead > tr > td.dt-orderable-desc span.dt-column-order:after,
table.dataTable thead > tr > td.dt-ordering-asc span.dt-column-order:before,
table.dataTable thead > tr > td.dt-ordering-asc span.dt-column-order:after,
table.dataTable thead > tr > td.dt-ordering-desc span.dt-column-order:before,
table.dataTable thead > tr > td.dt-ordering-desc span.dt-column-order:after {
  left: 0;
  opacity: 0.125;
  line-height: 9px;
  font-size: 0.8em;
}
table.dataTable thead > tr > th.dt-orderable-asc, table.dataTable thead > tr > th.dt-orderable-desc,
table.dataTable thead > tr > td.dt-orderable-asc,
table.dataTable thead > tr > td.dt-orderable-desc {
  cursor: pointer;
}
table.dataTable thead > tr > th.dt-orderable-asc:hover, table.dataTable thead > tr > th.dt-orderable-desc:hover,
table.dataTable thead > tr > td.dt-orderable-asc:hover,
table.dataTable thead > tr > td.dt-orderable-desc:hover {
  outline: 2px solid rgba(0, 0, 0, 0.05);
  outline-offset: -2px;
}
table.dataTable thead > tr > th.dt-ordering-asc span.dt-column-order:before, table.dataTable thead > tr > th.dt-ordering-desc span.dt-column-order:after,
table.dataTable thead > tr > td.dt-ordering-asc span.dt-column-order:before,
table.dataTable thead > tr > td.dt-ordering-desc span.dt-column-order:after {
  opacity: 0.6;
}
table.dataTable thead > tr > th.sorting_desc_disabled span.dt-column-order:after, table.dataTable thead > tr > th.sorting_asc_disabled span.dt-column-order:before,
table.dataTable thead > tr > td.sorting_desc_disabled span.dt-column-order:after,
table.dataTable thead > tr > td.sorting_asc_disabled span.dt-column-order:before {
  display: none;
}
table.dataTable thead > tr > th:active,
table.dataTable thead > tr > td:active {
  outline: none;
}

div.dt-scroll-body > table.dataTable > thead > tr > th,
div.dt-scroll-body > table.dataTable > thead > tr > td {
  overflow: hidden;
}

:root.dark table.dataTable thead > tr > th.dt-orderable-asc:hover, :root.dark table.dataTable thead > tr > th.dt-orderable-desc:hover,
:root.dark table.dataTable thead > tr > td.dt-orderable-asc:hover,
:root.dark table.dataTable thead > tr > td.dt-orderable-desc:hover,
:root[data-bs-theme=dark] table.dataTable thead > tr > th.dt-orderable-asc:hover,
:root[data-bs-theme=dark] table.dataTable thead > tr > th.dt-orderable-desc:hover,
:root[data-bs-theme=dark] table.dataTable thead > tr > td.dt-orderable-asc:hover,
:root[data-bs-theme=dark] table.dataTable thead > tr > td.dt-orderable-desc:hover {
  outline: 2px solid rgba(255, 255, 255, 0.05);
}

div.dt-processing {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 200px;
  margin-left: -100px;
  margin-top: -22px;
  text-align: left;
  padding: 2px;
  z-index: 10;
}
div.dt-processing > div:last-child {
  position: relative;
  width: 80px;
  height: 15px;
  margin: 1em auto;
}
div.dt-processing > div:last-child > div {
  position: absolute;
  top: 0;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: rgb(13, 110, 253);
  background: rgb(var(--dt-row-selected));
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
div.dt-processing > div:last-child > div:nth-child(1) {
  left: 8px;
  animation: datatables-loader-1 0.6s infinite;
}
div.dt-processing > div:last-child > div:nth-child(2) {
  left: 8px;
  animation: datatables-loader-2 0.6s infinite;
}
div.dt-processing > div:last-child > div:nth-child(3) {
  left: 32px;
  animation: datatables-loader-2 0.6s infinite;
}
div.dt-processing > div:last-child > div:nth-child(4) {
  left: 56px;
  animation: datatables-loader-3 0.6s infinite;
}

@keyframes datatables-loader-1 {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes datatables-loader-3 {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes datatables-loader-2 {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(24px, 0);
  }
}
table.dataTable.nowrap th, table.dataTable.nowrap td {
  white-space: nowrap;
}
table.dataTable th,
table.dataTable td {
  box-sizing: border-box;
}
table.dataTable th.dt-left,
table.dataTable td.dt-left {
  text-align: left;
}
table.dataTable th.dt-center,
table.dataTable td.dt-center {
  text-align: left;
}
table.dataTable th.dt-right,
table.dataTable td.dt-right {
  text-align: right;
}
table.dataTable th.dt-justify,
table.dataTable td.dt-justify {
  text-align: justify;
}
table.dataTable th.dt-nowrap,
table.dataTable td.dt-nowrap {
  white-space: nowrap;
}
table.dataTable th.dt-empty,
table.dataTable td.dt-empty {
  text-align: left;
  vertical-align: top;
}
table.dataTable th.dt-type-numeric, table.dataTable th.dt-type-date,
table.dataTable td.dt-type-numeric,
table.dataTable td.dt-type-date {
  text-align: left;
}
table.dataTable thead th,
table.dataTable thead td,
table.dataTable tfoot th,
table.dataTable tfoot td {
  text-align: left;
}
table.dataTable thead th.dt-head-left,
table.dataTable thead td.dt-head-left,
table.dataTable tfoot th.dt-head-left,
table.dataTable tfoot td.dt-head-left {
  text-align: left;
}
table.dataTable thead th.dt-head-center,
table.dataTable thead td.dt-head-center,
table.dataTable tfoot th.dt-head-center,
table.dataTable tfoot td.dt-head-center {
  text-align: center;
}
table.dataTable thead th.dt-head-right,
table.dataTable thead td.dt-head-right,
table.dataTable tfoot th.dt-head-right,
table.dataTable tfoot td.dt-head-right {
  text-align: left;
}
table.dataTable thead th.dt-head-justify,
table.dataTable thead td.dt-head-justify,
table.dataTable tfoot th.dt-head-justify,
table.dataTable tfoot td.dt-head-justify {
  text-align: justify;
}
table.dataTable thead th.dt-head-nowrap,
table.dataTable thead td.dt-head-nowrap,
table.dataTable tfoot th.dt-head-nowrap,
table.dataTable tfoot td.dt-head-nowrap {
  white-space: nowrap;
}
table.dataTable tbody th.dt-body-left,
table.dataTable tbody td.dt-body-left {
  text-align: left;
}
table.dataTable tbody th.dt-body-center,
table.dataTable tbody td.dt-body-center {
  text-align: left;
}
table.dataTable tbody th.dt-body-right,
table.dataTable tbody td.dt-body-right {
  text-align: left;
}
table.dataTable tbody th.dt-body-justify,
table.dataTable tbody td.dt-body-justify {
  text-align: justify;
}
table.dataTable tbody th.dt-body-nowrap,
table.dataTable tbody td.dt-body-nowrap {
  white-space: nowrap;
}

/*! Bootstrap 5 integration for DataTables
 *
 * ©2020 SpryMedia Ltd, all rights reserved.
 * License: MIT datatables.net/license/mit
 */
table.table.dataTable {
  clear: both;
  margin-bottom: 0;
  max-width: none;
  border-spacing: 0;
}
table.table.dataTable.table-striped > tbody > tr:nth-of-type(2n+1) > * {
  box-shadow: none;
}
table.table.dataTable > :not(caption) > * > * {
  background-color: transparent;
}
table.table.dataTable > tbody > tr {
  background-color: transparent;
}
table.table.dataTable > tbody > tr.selected > * {
  box-shadow: inset 0 0 0 9999px rgb(13, 110, 253);
  box-shadow: inset 0 0 0 9999px rgb(var(--dt-row-selected));
  color: rgb(255, 255, 255);
  color: rgb(var(--dt-row-selected-text));
}
table.table.dataTable > tbody > tr.selected a {
  color: rgb(9, 10, 11);
  color: rgb(var(--dt-row-selected-link));
}
table.table.dataTable.table-striped > tbody > tr:nth-of-type(2n+1) > * {
  box-shadow: inset 0 0 0 9999px rgba(var(--dt-row-stripe), 0.05);
}
table.table.dataTable.table-striped > tbody > tr:nth-of-type(2n+1).selected > * {
  box-shadow: inset 0 0 0 9999px rgba(13, 110, 253, 0.95);
  box-shadow: inset 0 0 0 9999px rgba(var(--dt-row-selected), 0.95);
}
table.table.dataTable.table-hover > tbody > tr:hover > * {
  box-shadow: inset 0 0 0 9999px rgba(var(--dt-row-hover), 0.075);
}
table.table.dataTable.table-hover > tbody > tr.selected:hover > * {
  box-shadow: inset 0 0 0 9999px rgba(13, 110, 253, 0.975);
  box-shadow: inset 0 0 0 9999px rgba(var(--dt-row-selected), 0.975);
}

div.dt-container div.dt-length label {
  font-weight: normal;
  text-align: left;
  white-space: nowrap;
}
div.dt-container div.dt-length select {
  width: auto;
  display: inline-block;
  margin-right: 0.5em;
}
div.dt-container div.dt-search {
  text-align: left;
}
div.dt-container div.dt-search label {
  font-weight: normal;
  white-space: nowrap;
  text-align: left;
}
div.dt-container div.dt-search input {
  margin-left: 0.5em;
  display: inline-block;
  width: auto;
}
div.dt-container div.dt-info {
  padding-top: 0.85em;
}
div.dt-container div.dt-paging {
  margin: 0;
}
div.dt-container div.dt-paging ul.pagination {
  margin: 2px 0;
  flex-wrap: wrap;
}
div.dt-container div.dt-row {
  position: relative;
}

div.dt-scroll-head table.dataTable {
  margin-bottom: 0 !important;
}

div.dt-scroll-body {
  border-bottom-color: var(--bs-border-color);
  border-bottom-width: var(--bs-border-width);
  border-bottom-style: solid;
}
div.dt-scroll-body > table {
  border-top: none;
  margin-top: 0 !important;
  margin-bottom: 0 !important;
}
div.dt-scroll-body > table > tbody > tr:first-child {
  border-top-width: 0;
}
div.dt-scroll-body > table > thead > tr {
  border-width: 0 !important;
}
div.dt-scroll-body > table > tbody > tr:last-child > * {
  border-bottom: none;
}

div.dt-scroll-foot > .dt-scroll-footInner {
  box-sizing: content-box;
}
div.dt-scroll-foot > .dt-scroll-footInner > table {
  margin-top: 0 !important;
  border-top: none;
}
div.dt-scroll-foot > .dt-scroll-footInner > table > tfoot > tr:first-child {
  border-top-width: 0 !important;
}

@media screen and (max-width: 767px) {
  div.dt-container div.dt-length,
  div.dt-container div.dt-search,
  div.dt-container div.dt-info,
  div.dt-container div.dt-paging {
    text-align: center;
  }
  div.dt-container .row {
    --bs-gutter-y: 0.5rem;
  }
  div.dt-container div.dt-paging ul.pagination {
    justify-content: left !important;
  }
}
table.dataTable.table-sm > thead > tr th.dt-orderable-asc, table.dataTable.table-sm > thead > tr th.dt-orderable-desc, table.dataTable.table-sm > thead > tr th.dt-ordering-asc, table.dataTable.table-sm > thead > tr th.dt-ordering-desc,
table.dataTable.table-sm > thead > tr td.dt-orderable-asc,
table.dataTable.table-sm > thead > tr td.dt-orderable-desc,
table.dataTable.table-sm > thead > tr td.dt-ordering-asc,
table.dataTable.table-sm > thead > tr td.dt-ordering-desc {
  padding-right: 20px;
}
table.dataTable.table-sm > thead > tr th.dt-orderable-asc span.dt-column-order, table.dataTable.table-sm > thead > tr th.dt-orderable-desc span.dt-column-order, table.dataTable.table-sm > thead > tr th.dt-ordering-asc span.dt-column-order, table.dataTable.table-sm > thead > tr th.dt-ordering-desc span.dt-column-order,
table.dataTable.table-sm > thead > tr td.dt-orderable-asc span.dt-column-order,
table.dataTable.table-sm > thead > tr td.dt-orderable-desc span.dt-column-order,
table.dataTable.table-sm > thead > tr td.dt-ordering-asc span.dt-column-order,
table.dataTable.table-sm > thead > tr td.dt-ordering-desc span.dt-column-order {
  right: 5px;
}

div.dt-scroll-head table.table-bordered {
  border-bottom-width: 0;
}

div.table-responsive > div.dt-container > div.row {
  margin: 0;
}
div.table-responsive > div.dt-container > div.row > div[class^=col-]:first-child {
  padding-left: 0;
}
div.table-responsive > div.dt-container > div.row > div[class^=col-]:last-child {
  padding-right: 0;
}

:root[data-bs-theme=dark] {
  --dt-row-hover: 255, 255, 255;
  --dt-row-stripe: 255, 255, 255;
  --dt-column-ordering: 255, 255, 255;
}
</style>
<?php

// Convertendo o nome da página para minúsculas
$pagina = strtolower($pagina);

// Incluindo informações de cada categoria
include $arrConfig['dir_admin'] . '/information/consultas.inc.php';
include $arrConfig['dir_admin'] . '/information/detail-information.inc.php';


// Verificar se a página está presente no array de consultas
if (array_key_exists($pagina, $consultas)) {
  // Definir a consulta SQL
  $consulta = $consultas[$pagina];
  $tipo = $pagina;

  // Definir a categoria removendo o último "s" da palavra
  $tabela = rtrim($pagina, "s");

  // Executar a consulta SQL
  $arrResultados = my_query($consulta);

  if ($tabela == 'alunoinative' || $tabela == 'myaluno' || $tabela == 'alunoremoved') {
    $tabela = 'aluno';
 
  } elseif ($tabela == 'professor' || $tabela == 'admin' || $tabela == 'supra_admin') {
    $tabela = 'colaborador';
  }
  // Mostrar os resultados

  foreach ($arrResultados as $k => $v) {

    if (count($arrResultados) == 0) {
      echo 'Não existem registos';


    } else {

      echo '<div id="cardView">';
      // Se a página for "Encarregados de Educação"
      if ($pagina == "encarregadoeducacao") {
        // Obter os educandos deste encarregado
        $arrEducandos = my_query('SELECT id_aluno, aluno FROM aluno WHERE id_encarregadoeducacao = ' . $v['id_encarregadoeducacao']);
        foreach ($arrEducandos as $s => $t) {
          // Inicializar um array para armazenar os id's de cada educando
          $arrOrientadores[$t['id_aluno']] = array();

          // Obter o orientador de cada educando
          $result = my_query('SELECT * FROM aluno INNER JOIN colaborador ON colaborador.id_colaborador = aluno.id_orientador WHERE id_aluno = ' . $t['id_aluno']);

          // Adicionar o orientador ao array de orientadores dos educandos
          foreach ($result as $orientador) {
            $arrOrientadores[$t['id_aluno']][] = $orientador;
          }
        }
      }
    
      // Exibir os resultados
      echo '
      <div class="col">';
    
        $id = $v['id_' . $tabela];  
       
      echo '<a href="" class="card-link">';
      echo '<div class="card h-70 ps-0 py-xl-3" style=" background-color: white; transition: all 0.3s ease;" onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff\'; this.style.zIndex=\'1\';" onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">';
      echo '<div class="card-body" style="text-align: center; margin-left: 0px">';
      echo '<h5 class="card-title">' . $v[$tabela] . '</h5><br>';


      // Verificações específicas para cada categoria
      if (isset($information[$tabela])) {
        $info = $information[$tabela];
        foreach ($info as $titulo => $valor) {
          echo '<h6 class="card-title">' . $titulo . ': ';
          if ($valor == 'aluno') {
            $totalAlunos = count($arrEducandos);
            $count = 0;
            foreach ($arrEducandos as $s => $t) {
              $count++;
              echo $t[$valor];
              if ($count == $totalAlunos - 1) {
                echo ' e ';
              } elseif ($count < $totalAlunos) {
                echo ', ';
              }
            }
          } else {
            echo $v[$valor];
          }
          echo '</h6>';
        }
      }
      // se tem foto ou não 
      $verf_foto = false;
      if (isset($arrResultados[$k]['foto_' . $tabela])) {
        $verf_foto = true;
      }
      // Exibir a foto, se existir

      if ($verf_foto) {
        $foto = $arrResultados[$k]['foto_' . $tabela];
        include $arrConfig['dir_admin'] . '/fotos.inc.php';
        echo '<img style = "display: center;" class="icons"  src="' . $src . ' height="100" width="100">';
      } else {
        $foto = '';
      }





      // Botões de ação
      echo '<div class="d-grid gap-1 mt-3">';
      if ( $_SESSION['userCargo'] == 'admin' || $_SESSION['userCargo'] == 'supra_admin') {
       
        if($pagina !== 'alunoremoved' && $pagina !== 'alunoinative' ){
          echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=' . $tipo . '&especificacao=editar" class="btn btn-primary"><i class="bx bx-pencil"></i> Editar</a>';
        }else{
        
        }
        if ($tabela == 'colaborador' && $v['cargo'] == 'supra_admin' ) {
         
        } else {
          echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopRemove'.$v['id_'.$tabela].'"><i class="bx bx-trash"></i> Remover</button>';
        }
       
     
        if ($pagina == 'alunoinative') {
          echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;"data-bs-toggle="modal" data-bs-target="#modalTopAtive'.$v['id_'.$tabela].'"><i class="bx bx-block"></i> Ativar</button>';
        } elseif($pagina == 'aluno') {
          echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;"data-bs-toggle="modal" data-bs-target="#modalTopDesative'.$v['id_'.$tabela].'"><i class="bx bx-block"></i> Desativar</button>';
          if ($pagina == 'operacao' || $tabela == 'turma') {

          } else {
            echo '<button class="btn btn-primary" type="button" style="background-color: #0083FF; border-color: #0083FF"><i class="bx bx-file-blank"></i> Adicionar Serviço</button>';
          }
          if ($tabela == 'aluno' || $tabela == 'colaborador' || $tabela == 'encarregadoeducacao' || $tabela == 'escola') {
            echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=email&especificacao=sendemail" class="btn " style="color: #ffff;background-color: #3D8F42; border-color: #3D8F42;">  <i class="bx bx-envelope"></i> Envair E-mail</a>';
          }
        }
     
      }
      echo '</div>';


  
      echo '</div>';
      echo '</div>';
  

      echo '</a>';
      echo '</div>';

    }
   include $arrConfig['dir_admin'] . '/modal/modal-remove-remake.php';
   include $arrConfig['dir_admin'] . '/modal/modal-desative-ative.php';

  }



} else {
  // Se a página não for encontrada no array de consultas
  echo "Página não encontrada!";
}
echo '</div>';






// Tabela alternativa
echo '
<div id="tableView" style="display: none; text-align: center; padding-left: 0px;">
<table id="table"  class="table table-striped " style="  
border-collapse: collapse; width: 100%; table-layout: fixed; width: 100%;
border-collapse: collapse; ">
<thead>
  <tr>';
if ($verf_foto) {
  echo '<th class="fp_box">Foto</th>';
}

// Verificações específicas para cada categoria
if (isset($information[$tabela])) {
  $info = $information[$tabela];
  foreach ($info as $titulo => $valor) {
    echo '<th>' . $titulo . '</th>';
  }
}

echo '<th>Ações</th>
  </tr>
</thead>
<tbody>';


foreach ($arrResultados as $k => $v) {
  $id = $v['id_' . $tabela];
  echo ' <tr>
   ';
  // Exibir a foto, se existir

  if ($verf_foto) {
    $foto = $arrResultados[$k]['foto_' . $tabela];
    include $arrConfig['dir_admin'] . '/fotos.inc.php';
    echo ' <td><img class="icons"  src="' . $src . ' height="100" width="100"></td>';
  }
  ;


  if (isset($information[$tabela])) {
    $info = $information[$tabela];
    $count = 0;
    foreach ($info as $titulo => $valor) {

      if ($valor == 'aluno') {
        echo '<td style= "white-space: nowrap;">';
        $totalAlunos = count($arrEducandos);
        foreach ($arrEducandos as $s => $t) {
          $count++;

          echo $t[$valor];
          if ($count == $totalAlunos - 1) {
            echo ' e ';
          } elseif ($count < $totalAlunos) {
            echo ', ';
          }
        }
        echo '</td>';
      } else {
        echo '<td style= "white-space: nowrap;">' . $v[$valor] . '</td>';
      }
    }
  }


  echo '
    <td>
   ';
  echo '<div class="d-grid gap-1 mt-3">';
  if ($_SESSION['userCargo'] == 'admin' || $_SESSION['userCargo'] == 'supra_admin') {
    echo '<div class="btn-group">';
    echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=' . $tipo . '&especificacao=editar" class="btn btn-primary" title="Editar"><i class="bx bx-pencil"></i></a>';
    if ($tabela == 'colaborador' && $v['cargo'] == 'supra_admin') {
    } else {
      echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopremove'.$v['id_'.$tabela].'" title="Remover"><i class="bx bx-trash"></i></button>';
    }

    if ($display == 'Alunos Inativos') {
      echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;" data-bs-toggle="modal" data-bs-target="#modalTopAtive'.$v['id_'.$tabela].'" title="Ativar"><i class="bx bx-block"></i></button>';
    } else {
      echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;" data-bs-toggle="modal" data-bs-target="#modalTopDesative'.$v['id_'.$tabela].'" title="Desativar"><i class="bx bx-block"></i></button>';

      if ($pagina != 'operacao' && $tabela != 'turma') {
        echo '<button class="btn btn-primary" type="button" style="background-color: #0083FF; border-color: #0083FF" title="Adicionar Serviço"><i class="bx bx-file-blank"></i></button>';
      }

      if ($tabela == 'aluno' || $tabela == 'colaborador' || $tabela == 'encarregadoeducacao' || $tabela == 'escola') {
        echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=email&especificacao=sendemail" class="btn" style="background-color: #3D8F42; border-color: #3D8F42;" title="Enviar E-mail"><i class="bx bx-envelope"></i></a>';
      }
    }
    echo '</div>';
  }

  echo '</td>
  </tr>';
  include $arrConfig['dir_admin'] . '/modal/modal-remove-remake.php';
  include $arrConfig['dir_admin'] . '/modal/modal-desative-ative.php';
}


echo '</tbody>
</table>
</div>';



?>

<!-- Incluir CSS e JavaScript necessários para a tabela -->


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script>
  // Inicializar a tabela DataTable
  




    var table = $('#table').DataTable( {
    columnDefs: [
        { targets: [0],  width: '10%'},
        //{ targets: '_all', visible: false }
    ]
} );
</script>

