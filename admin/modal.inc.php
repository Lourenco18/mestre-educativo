<?php
$current_page = $_SERVER['REQUEST_URI'];

$page_name = basename($current_page);


echo '
 <div class="modal modal-mid fade" id="modalTopEvent" tabindex="-1">
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
echo '
     </div>
     </div>
     </form>
   </div>
 </div>
 </div>';



echo '
  <div class="modal modal-mid fade" id="modalTopRemove" tabindex="-1">
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
  <a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/verf-exist.php?id= ' . $id . '&tabela=' . $tabela . '&acao=apagar&pagename=' . $_SERVER['PHP_SELF'] . '" onclick="SwalSuccess()">Sim, quero remover</a>

  </div>
  </form>
</div>
</div>
</div>  ';




echo '
<div class="modal modal-mid fade" id="modalTopDesative" tabindex="-1">
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
<a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/verf-exist.php?id= ' . $id . '&tabela=' . $tabela . '&acao=desativar&pagename=' . $_SERVER['PHP_SELF'] . '" onclick="SwalSuccess()">Sim, quero desativar</a>

</div>
</form>
</div>
</div>
</div>  ';

echo '
<div class="modal modal-mid fade" id="modalTopAtive" tabindex="-1">
<div class="modal-dialog">
  <form class="modal-content">
    <div class="modal-header">
<h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer ativar este ';
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
<a type="button" style = "color = white;" class="btn btn-primary" href="' . $arrConfig['url_trata'] . '/verf-exist.php?id= ' . $id . '&tabela=' . $tabela . '&acao=ativar&pagename=' . $_SERVER['PHP_SELF'] . '" onclick="SwalSuccess()">Sim, quero ativar</a>

</div>
</form>
</div>
</div>
</div>  
';
$arrNotas = my_query('SELECT * FROM nota inner join statu on statu.id_statu = nota.id_status inner join colaborador on colaborador.id_colaborador = nota.id_colaborador inner join cargo on cargo.id_cargo = colaborador.id_cargo WHERE nota.ativo = 1 order by nota.id_status desc');
echo'
<div class="modal modal-mid fade" id="modalnotes" tabindex="-1">
<div class="modal-dialog">
  <form class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="modalTopTitle">Notas</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" style="max-height: 800px; overflow-y: auto;">';
     foreach ($arrNotas as $k => $v){ ?>
        <div class="card">
            <div class="card-body">
            <div class="card-bar" style = "position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px; /* Altura da barra */
    background-color: <?php echo $v['cor_statu'];?>"></div> 
                <h2 class="card-title"><?php echo $v['titulo']; ?></h2>
                <h4 class="card-text"><?php echo $v['nota']; ?></h4>
                <h7 class="card-text">Nota feita por: <?php echo $v['colaborador']; ?> - <?php echo $v['cargo']; ?></h7><br>
                <h7 class="card-text">Data da nota: <?php echo $v['data']; ?></h7>
                <div class="card-buttons" style = "margin-top: 4px;">
                <?php if($v['id_statu'] == 2){ ?>
               <button class="btn btn-primary" type="button" style="background-color: green; border-color: green;"  title="Visto"><i class="bx bx-check"></i></button>
                <?php } ?> 
                <button class="btn btn-danger" type = "button"  style="background-color: orange; border-color: orange;"><i class="bx bx-trash"></i></button>
            </div>
            </div>
        </div><br>
    <?php }; ?>
</div>

    <div class="modal-footer">
      <?php 
      $arrStatus= my_query("SELECT * from statu WHERE ativo = 1");
      foreach($arrStatus as $k => $v){ ?>
        <button class="btn btn-primary" style="background-color: <?php echo $v['cor_statu']; ?>; border-color: <?php echo $v['cor_statu']; ?>;" title="Visto" disabled>
        <i class=""></i><?php echo $v['statu']; ?>
    </button>
    <?php
      }
      ?>
      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
      <a type="button" class="btn btn-primary" href="#">Deixar nota</a>
    </div>
  </form>
</div>
</div>




<?php

include 'sweetalert.inc.php';
?>
</div>
</form>
</div>
</div>
</div>