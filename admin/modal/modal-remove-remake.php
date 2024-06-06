<?php
echo '
    <div class="modal modal-mid fade" id="modalTopRemove'.$id.'" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content">
        <div class="modal-header">
    <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer apagar este ';
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
    <a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/verf-exist.php?id= ' . $id_unico . '&tabela=' . $tabela . '&acao=apagar&pagename=' . $_SERVER['PHP_SELF'] . '" onclick="SwalSuccess()">Sim, quero remover</a>
  
    </div>
    </form>
  </div>
  </div>
 ';