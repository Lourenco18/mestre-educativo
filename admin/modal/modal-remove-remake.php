<?php

$pagename = preg_replace("'&'","----", basename($current_page));

echo '
    <div class="modal modal-mid fade" id="modalTopRemove'.$v['id_' .$tabela].'" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content">
        <div class="modal-header">
    <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer remover este ';
    echo $tabela;
    
    echo '?</h5>
    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="modal"
      aria-label="Close"
    ></button>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
      Cancelar
    </button>
    <a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id= ' . $id_unico . '&tabela=' . $tabela . '&acao=apagar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" onclick="SwalSuccess()">Sim, quero remover</a>
  
    </div>
    </form>
  </div>
  </div>
 ';
 echo '
    <div class="modal modal-mid fade" id="modalTopNullRemove'.$v['id_' .$tabela].'" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content">
        <div class="modal-header">
    <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer remover este ';
    echo $tabela;
  
    echo '?</h5>
    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="modal"
      aria-label="Close"
    ></button>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
      Cancelar
    </button>
    <a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/verf-exist.php?id= ' . $id_unico . '&tabela=' . $tabela . '&acao=apagar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" onclick="SwalSuccess()">Sim, quero remover</a>
  
    </div>
    </form>
  </div>
  </div>
 ';


 
 echo '
    <div class="modal modal-mid fade" id="modalTopRemove'.$v['id_servicoaluno'].'" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content">
        <div class="modal-header">
    <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer remover este serviço ao aluno';


    echo '?</h5>
    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="modal"
      aria-label="Close"
    ></button>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
      Cancelar
    </button>
    <a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id= ' . $v['id_servicoaluno'] . '&tabela=servicoaluno&acao=apagar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" onclick="SwalSuccess()">Sim, quero remover</a>
  
    </div>
    </form>
  </div>
  </div>
 ';