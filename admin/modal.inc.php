<?php
$current_page = $_SERVER['REQUEST_URI'];
include 'forms_campos.php';
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
  <div class="modal modal-mid fade" id="modalForm" tabindex="-1">
  <div class="modal-dialog">';?>
  <form class="modal-content" action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $pagename;
   echo "&id=$id_modal&tabela=$tabela_modal&acao=editar" ?>" method="POST" enctype="multipart/form-data">
<?php 
      echo '<div class="modal-header">
  <h5 class="modal-title" id="modalTopTitle">Editar ' . $tabela_modal . '</h5>';

echo '
  <button
    type="button"
    class="btn-close"
    data-bs-dismiss="modal"
    aria-label="Close"
  ></button>
</div>';
echo '
<div class="modal-body" style="max-height: 800px; overflow-y: auto;">';
 
  $tipo = $tabela_modal;
  $divisao1 = "";
  echo $id_modal;
  if ($especificacao == "editar") {
    
    $consulta = $consultasForms[$tipo];
 echo $consulta;
    $arrResultados = my_query($consulta);
  }


  foreach ($campos as $campos) {
    $label = $campos['label'] ?? null;
    $id_campo = $campos['id'] ?? null;
    $name = $campos['name'] ?? null;
    $type = $campos['type'] ?? null;
    $size = $campos['size'] ?? null;
    $divisao = $campos['divisao'] ?? null;
    $object = $campos['object'] ?? null;
    $max = $campos['max'] ?? null;
    $min = $campos['min'] ?? null;
    $config = $campos['config'] ?? null;
    $placeholder = $campos['placeholder'] ?? null;
    $ajax = $campos['ajax'] ?? null;



    if ($object == $tipo) {


      echo '<div class="' . $size . '">
                <label for="' . $id_campo . '" class="form-label">' . $label . '</label>';

      if ($type == "combobox") {
        $table = ucfirst($id_campo); // nome da tabela das combobox
        if (isset($id_received)) {
          $sql_combobox = "SELECT * FROM $table WHERE ativo = 1 ";
        } else {
          $sql_combobox = "SELECT * FROM $table WHERE ativo = 1";
        }

        $arrtable = my_query($sql_combobox);

        $onChange = '';
        if ($ajax != null) {
          $divName = $ajax['div'];
          $fileName = $ajax['file'];

          $onChange = 'onchange="ajax(this.value)"';
        }

        echo '<select ' . $onChange . ' required name="' . $name . '" id="' . $id_campo . '" class="select2 form-select">';


        if ($especificacao == 'editar') {
         
          $id_Selected = $arrResultados[0]['id_' . $id_campo];
      
        } else {
          $id_Selected = '';
          echo '<option value="">Selecione uma opção</option>';
        }
        
        foreach ($arrtable as $k => $v) {
          
          $selected = "";
          if ($id_Selected == $v['id_' . $id_campo]) {
            $selected = 'selected="selected" ';
          }
          echo '<option ' . $selected . ' value="' . $v['id_' . $id_campo] . '">' . $v[$id_campo] . '</option>';
        }
        echo '</select>';


      } else {
        echo '<input placeholder = "' . $placeholder . '" ' . $config . 'required type="' . $type . '" ';
        if ($max != '' || $min != '') {
          echo "max='" . $max;
          echo "' min='$min'";
        }
        ;
        echo 'class="form-control" id="' . $id_campo . '" name="' . $name . '"';
        if ($especificacao == 'editar') {
         
          foreach ($arrResultados as $t => $k) {
            echo 'value="' . $k[$name] . '"';
          }
        }
        ;
        echo '/>';
      }
      echo '</div>';
    }
  }
  ;
  echo'
  <div class="modal-footer">



  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
 

  <button type="submit" class="btn btn-primary me-2">Guardar Alterações</button>
</div>
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
echo '
<div class="modal modal-mid fade" id="modalnotes" tabindex="-1">
<div class="modal-dialog">'; ?>

<form class="modal-content" action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $pagename;
   echo "&id=$id&tabela=nota&acao=adicionar" ?>" method="POST" enctype="multipart/form-data">
  <?php
  echo '
    <div class="modal-header">
      <h5 class="modal-title" id="modalTopTitle">Notas</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
<div id = "listView">
    <div class="modal-body" id="listView" style="max-height: 800px; overflow-y: auto;">';
  if (count($arrNotas) == 0) {
    echo '<h2>Não existem notas</h2>';
  } else {
    foreach ($arrNotas as $k => $v) {
      $id = $v['id_nota']; ?>

      <div class="card">
        <div class="card-body">
          <div class="card-bar" style="position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 4px; /* Altura da barra */
  background-color: <?php echo $v['cor_statu']; ?>"></div>
          <h2 class="card-title"><?php echo $v['titulo']; ?></h2>
          <h4 class="card-text"><?php echo $v['nota']; ?></h4>
          <h7 class="card-text">Nota feita por: <?php echo $v['colaborador']; ?> - <?php echo $v['cargo']; ?></h7><br>
          <h7 class="card-text">Data da nota: <?php echo $v['data']; ?></h7>
          <div class="card-buttons" style="margin-top: 4px;">
            <?php if ($v['id_statu'] == 2) { ?>
              <button class="btn btn-primary" type="button" style="background-color: green; border-color: green;"
                title="Visto"
                onclick="window.location.href = '<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?acao=ativar&tabela=nota&id=<?php echo $id ?>';">
                <i class="bx bx-check"></i>
              </button>

            <?php } ?>
            <button class="btn btn-primary" type="button" style="background-color: orange; border-color: orange;"
              title="Visto"
              onclick="window.location.href = '<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?acao=apagar&tabela=nota&id=<?php echo $id ?>';">
              <i class="bx bx-trash"></i>
            </button>

          </div>
        </div>
      </div><br>
    <?php }
    ;
  }
  ?>





  </div>

  <div class="modal-footer">
    <?php
    $arrStatus = my_query("SELECT * from statu WHERE ativo = 1");
    foreach ($arrStatus as $k => $v) { ?>
      <button class="btn btn-primary"
        style="background-color: <?php echo $v['cor_statu']; ?>; border-color: <?php echo $v['cor_statu']; ?>;"
        title="Visto" disabled>
        <i class=""></i><?php echo $v['statu']; ?>
      </button>
      <?php
    }
    ?>
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="button" id="active-formView" class="btn btn-primary">Deixar nota</button>
  </div>
  </div>




  <!--- form view -->
  <?php

  echo '<div id = "formView" style = "display: none">
<div class="modal-body" style="max-height: 800px; overflow-y: auto;">';
  $especificacao = "nota";
  $tipo = "nota";
  $divisao1 = "";
  foreach ($campos as $campos) {
    $label = $campos['label'] ?? null;
    $id_campo = $campos['id'] ?? null;
    $name = $campos['name'] ?? null;
    $type = $campos['type'] ?? null;
    $size = $campos['size'] ?? null;
    $divisao = $campos['divisao'] ?? null;
    $object = $campos['object'] ?? null;
    $max = $campos['max'] ?? null;
    $min = $campos['min'] ?? null;
    $config = $campos['config'] ?? null;
    $placeholder = $campos['placeholder'] ?? null;
    $ajax = $campos['ajax'] ?? null;



    if ($object == $tipo) {


      echo '<div class="' . $size . '">
                <label for="' . $id_campo . '" class="form-label">' . $label . '</label>';

      if ($type == "combobox") {
        $table = ucfirst($id_campo); // nome da tabela das combobox
        if (isset($id_received)) {
          $sql_combobox = "SELECT * FROM $table WHERE ativo = 1 ";
        } else {
          $sql_combobox = "SELECT * FROM $table WHERE ativo = 1";
        }

        $arrtable = my_query($sql_combobox);

        $onChange = '';
        if ($ajax != null) {
          $divName = $ajax['div'];
          $fileName = $ajax['file'];

          $onChange = 'onchange="ajax(this.value)"';
        }

        echo '<select ' . $onChange . ' required name="' . $name . '" id="' . $id_campo . '" class="select2 form-select">';


        if ($especificacao == 'editar') {
          $id_Selected = $arrResultados[0]['id_' . $id_campo];


        } else {
          $id_Selected = '';
          echo '<option value="">Selecione uma opção</option>';
        }

        foreach ($arrtable as $k => $v) {
          $selected = "";
          if ($id_Selected == $v['id_' . $id_campo]) {
            $selected = 'selected="selected" ';
          }
          echo '<option ' . $selected . ' value="' . $v['id_' . $id_campo] . '">' . $v[$id_campo] . '</option>';
        }
        echo '</select>';


      } else {
        echo '<input placeholder = "' . $placeholder . '" ' . $config . 'required type="' . $type . '" ';
        if ($max != '' || $min != '') {
          echo "max='" . $max;
          echo "' min='$min'";
        }
        ;
        echo 'class="form-control" id="' . $id_campo . '" name="' . $name . '"';
        if ($especificacao == 'editar') {
          foreach ($arrResultados as $t => $k) {
            echo 'value="' . $k[$name] . '"';
          }
        }
        ;
        echo '/>';
      }
      echo '</div>';
    }
  }
  ;



  ?>

  </div>
  <div class="modal-footer">



    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="button" id="active-listView" class="btn btn-primary">Voltar</button>

    <button type="submit" class="btn btn-primary me-2">Adicionar nota</button>
  </div>
  </div>


</form>
</div>
</div>





</div>

</div>
</div>
</div>
<script>

  document.getElementById('active-formView').addEventListener('click', function () {
    var listView = document.getElementById('listView');
    var formView = document.getElementById('formView');



    listView.style.display = 'none';
    formView.style.display = 'block';


  });

  document.getElementById('active-listView').addEventListener('click', function () {
    var listView = document.getElementById('listView');
    var formView = document.getElementById('formView');



    listView.style.display = 'block';
    formView.style.display = 'none';


  });
</script>