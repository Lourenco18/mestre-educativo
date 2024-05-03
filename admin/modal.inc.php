




 <?php
 $current_page = $_SERVER['REQUEST_URI'];

 $page_name = basename($current_page);


 echo'
 <div class="modal modal-top fade" id="modalTopEvent" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle">Informações do evento</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
     <div class="modal-body">


      <div id="visualizar">
          <dl class="row">
            <dt class="col-sm-3">Título:</dt>
            <dd class="col-sm-9" id = "vtitle"></dd>

            <dt class="col-sm-3">Descrição:</dt>
            <dd class="col-sm-9" id = "vdescricao"></dd>

            <dt class="col-sm-3">Escola:</dt>
            <dd class="col-sm-9" id = "vescola"></dd>

            <dt class="col-sm-3">Turma:</dt>
            <dd class="col-sm-9" id = "vturma"></dd>

            <dt class="col-sm-3">Início:</dt>
            <dd class="col-sm-9" id = "vstart"></dd>


            <dt class="col-sm-3">Fim:</dt>
            <dd class="col-sm-9" id = "vend"></dd>     
          </dl>  

          </button>
        <button type="button" id = "btnEdit" class="btn btn-primary">Editar</button>   
        </div>';
      

      event_view("edit", "processar_edit.php", "Editar");
      event_view("add", "processar_add.php", "Adicionar");
    echo'
     </div>
     </div>
     </form>
   </div>
 </div>
 </div>';
 


  echo '
  <div class="modal modal-top fade" id="modalTopRemove" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
  <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer apagar este ';  echo $tabela;echo '?</h5>
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
  <a type="button" style = "color = white;" class="btn btn-danger" href="'.$arrConfig['url_trata'].'/verf-exist.php?id= '.$id.'&tabela='.$tabela.'&acao=apagar&pagename='. $_SERVER['PHP_SELF'].'" onclick="SwalSuccess()">Sim, quero remover</a>

  </div>
  </form>
</div>
</div>
</div>  ';




echo '
<div class="modal modal-top fade" id="modalTopDesative" tabindex="-1">
<div class="modal-dialog">
  <form class="modal-content">
    <div class="modal-header">
<h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer desativar este ';  echo $tabela;echo '?</h5>
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
<a type="button" style = "color = white;" class="btn btn-danger" href="'.$arrConfig['url_trata'].'/verf-exist.php?id= '.$id.'&tabela='.$tabela.'&acao=desativar&pagename='. $_SERVER['PHP_SELF'].'" onclick="SwalSuccess()">Sim, quero desativar</a>

</div>
</form>
</div>
</div>
</div>  ';

echo '
<div class="modal modal-top fade" id="modalTopAtive" tabindex="-1">
<div class="modal-dialog">
  <form class="modal-content">
    <div class="modal-header">
<h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer ativar este ';  echo $tabela;echo '?</h5>
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
<a type="button" style = "color = white;" class="btn btn-primary" href="'.$arrConfig['url_trata'].'/verf-exist.php?id= '.$id.'&tabela='.$tabela.'&acao=ativar&pagename='. $_SERVER['PHP_SELF'].'" onclick="SwalSuccess()">Sim, quero ativar</a>

</div>
</form>
</div>
</div>
</div>  ';
 
 
 ?>

<?php

include 'sweetalert.inc.php';
?>
      </div>
    </form>
  </div>
</div>
</div>



