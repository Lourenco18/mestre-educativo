<?php

 echo '
 <div class="modal modal-mid fade" id="modalTopDesative' . $v['id_' . $tabela] . '" tabindex="-1">
 <div class="modal-dialog">
   <form class="modal-content">
     <div class="modal-header">
 <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer desativar este ';
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
 <a type="button" style = "color = white;  background-color: orange;" class="btn btn-primary" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id= ' . $id_unico . '&tabela=' . $tabela . '&acao=desativar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" onclick="SwalSuccess()">Sim, quero desativar</a>

 </div>
 </form>
 </div>
 </div>
 ';
 echo '
 <div class="modal modal-mid fade" id="modalTopAtive' . $v['id_' . $tabela] . '" tabindex="-1">
 <div class="modal-dialog">
   <form class="modal-content">
     <div class="modal-header">
 <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer desativar este ';
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
 <a type="button" style = "color = white;" class="btn btn-primary" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id= ' . $id_unico . '&tabela=' . $tabela . '&acao=ativar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" onclick="SwalSuccess()">Sim, quero desativar</a>
 </div>
 </form>
 </div>
 </div>
 ';