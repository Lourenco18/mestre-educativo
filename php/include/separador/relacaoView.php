
<div id="relacaoView" class="divisao" style="display: none;">
  <div class="row row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3"
    style="padding: 20px;">
    <div class="col">
      <a href="#" data-bs-toggle="modal" data-bs-target="#modalFormADD">
        <?php
        $especificacao = 'adicionar';
        $tipo = 'relacao';
        $tabela_modal = 'pessoa';
        ?>
        <div class="card h-70 ps-0 py-xl-3" style="background-color: white; transition: all 0.3s ease;"
          onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff\'; this.style.zIndex=\'1\';"
          onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\'">
          <div class="card-body" style="text-align: center;height: 231.599258px;  margin-left: 0px">
            <h5 class="card-title">Adicionar Relação</h5>
            <img class="icons" src="'.$arrConfig['url_imjs_upload'].'/icons/'.$v['foto_operacao'].'" alt=""
              height="100">
          </div>
        </div>
      </a>
    </div>
    <div class="modal modal-mid fade" id="modalFormADD" tabindex="-1">
      <div class="modal-dialog">
        <form class="modal-content"
          action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $page_name; ?>&id=<?php echo $id_modal; ?>&tabela=<?php echo $tabela_modal; ?>&acao=adicionar"
          method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTopTitle">Adicionar <?php echo $tipo; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="max-height: 800px; overflow-y: auto;">
            <?php
            $id_unico_pessoa = my_query("SELECT MAX(unico) FROM pessoa");
            $id_unico_pessoa = $id_unico_pessoa[0]['MAX(unico)'] + 1;
            include $arrConfig['dir_admin'] . '/forms_campos.php'; //vai buscar a array dos campos do formulário
            


            $tipo = $tabela_modal;
            foreach ($campos as $campo) {
              if ($campo['object'] == $tipo) {
                $label = $campo['label'] ?? '';
                $id_campo = $campo['id'] ?? '';
                $name = $campo['name'] ?? '';
                $type = $campo['type'] ?? '';
                $size = $campo['size'] ?? '';
                $max = $campo['max'] ?? '';
                $min = $campo['min'] ?? '';
                $config = $campo['config'] ?? '';
                $placeholder = $campo['placeholder'] ?? '';
                $ajax = $campo['ajax'] ?? null;

                echo '<div class="' . $size . '">';
                echo '<label for="' . $id_campo . '" class="form-label">' . $label . '</label>';

                if ($type == "combobox") {
                  $table = ucfirst($id_campo);
                  $sql_combobox = "SELECT * FROM $table WHERE ativo = 1";
                  $arrtable = my_query($sql_combobox);

                  $onChange = $ajax ? 'onchange="ajax(this.value)"' : '';
                  echo '<select ' . $onChange . ' required name="' . $name . '" id="' . $id_campo . '" class="select2 form-select">';

                  if ($especificacao == 'editar') {
                    $id_Selected = $arrResultados[0]['id_' . $id_campo];
                  } else {
                    echo '<option value="">Selecione uma opção</option>';
                    $id_Selected = '';
                  }

                  foreach ($arrtable as $v) {
                    $selected = ($id_Selected == $v['id_' . $id_campo]) ? 'selected="selected"' : '';
                    echo '<option ' . $selected . ' value="' . $v['id_' . $id_campo] . '">' . $v[$id_campo] . '</option>';
                  }

                  echo '</select>';
                } else {
                  $value = $especificacao == 'editar' ? $arrResultados[0][$name] : '';
                  echo '<input placeholder="' . $placeholder . '" ' . $config . ' required type="' . $type . '" max="' . $max . '" min="' . $min . '" class="form-control" id="' . $id_campo . '" name="' . $name . '" value="' . $value . '" oninput ="trata(this)"/>';
                }
                echo '</div>';
              }
            }
            ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary me-2">Adicionar <?php $tipo ?></button>
          </div>
        </form>
      </div>
    </div>
    <?php
    // Definir a consulta SQL
    $consulta = $consultas[$tipo];
    //echo $query;
    $arrRelacao = my_query($consulta);
   

    if (count($arrRelacao) == 0) {
      echo 'Não existem relações';
    } else {
      ?>
      <?php foreach ($arrRelacao as $v) {


        $tabela_modal = 'pessoa';
        $especificacao = 'editar';
        $id_modal = $v['id_pessoa'];
        $id_unico_pessoa = $v['unico_pessoa'];
      
        
        include $arrConfig['dir_admin'] . '/forms_campos.php';
    
        ?>
     <div class="col">
        <div class="card h-70 ps-0 py-xl-3" style="background-color: white; transition: all 0.3s ease;"
          onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff'; this.style.zIndex='1';"
          onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
          <div class="card-body" style="text-align: center; height: 231.599258px; margin-left: 0px">
            <h5 class="card-title"><?php echo $v['pessoa']; ?></h5>
            <h7 class="card-title">Telefone: <?php echo $v['telefone_pessoa']; ?></h7><br>
            <h7 class="card-title">Relação: <?php echo $v['relacao']; ?></h7>
          </div>
          <?php if ($_SESSION['userCargo'] == 'admin' || $_SESSION['userCargo'] == 'supra_admin') { ?>
            <button style="margin: 3px;" type="button" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#modalForm<?php echo $id_modal; ?>"><i class="bx bx-pencil"></i> Editar</button>
            <?php if ($tabela != 'colaborador' || $v['cargo'] != 'supra_admin') { ?>
              <button style="margin: 3px;" type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#modalTopRemove<?php echo $id_unico_pessoa; ?>"><i class="bx bx-trash"></i> Remover</button>
            <?php } ?>
          <?php } ?>
        </div>
        
        
        
        <!-- Modal for removal -->
        <?php
        echo '
         <div class="modal modal-mid fade" id="modalTopRemove' . $id_unico_pessoa . '" tabindex="-1">
         <div class="modal-dialog">
           <form class="modal-content">
             <div class="modal-header">
         <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer remover esta ';
echo $tabela_modal;
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
         <a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/verf-exist.php?id= ' . $id_unico_pessoa . '&tabela=' . $tabela_modal . '&acao=apagar&pagename=' . $_SERVER['PHP_SELF'] . '" onclick="SwalSuccess()">Sim, quero remover</a>
       
         </div>
         </form>
       </div>
       </div>
       </div>  ';
        //modal form
        ?>
        
        <div class="modal modal-mid fade" id="modalForm<?php echo $id_modal; ?>" tabindex="-1">
          <div class="modal-dialog">
            <form class="modal-content"
              action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $page_name; ?>&id=<?php echo $id_modal; ?>&tabela=<?php echo $tabela_modal; ?>&acao=editar"
              method="POST" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTopTitle">Editar <?php echo $tabela_modal; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="max-height: 800px; overflow-y: auto;">
                <?php

                include $arrConfig['dir_admin'] . '/forms_campos.php'; //vai buscar a array dos campos do formulário
                $tipo = $tabela_modal;

                $arrResultados = my_query('SELECT * FROM ' . $tabela_modal . ' WHERE unico = ' . $id_unico_pessoa . ' ORDER BY data DESC LIMIT 1');



                foreach ($campos as $campo) {
                  if ($campo['object'] == $tipo) {
                    $label = $campo['label'] ?? '';
                    $id_campo = $campo['id'] ?? '';
                    $name = $campo['name'] ?? '';
                    $type = $campo['type'] ?? '';
                    $size = $campo['size'] ?? '';
                    $max = $campo['max'] ?? '';
                    $min = $campo['min'] ?? '';
                    $config = $campo['config'] ?? '';
                    $placeholder = $campo['placeholder'] ?? '';
                    $ajax = $campo['ajax'] ?? null;

                    echo '<div class="' . $size . '">';
                    echo '<label for="' . $id_campo . '" class="form-label">' . $label . '</label>';

                    if ($type == "combobox") {
                      $table = ucfirst($id_campo);
                      $sql_combobox = "SELECT * FROM $table WHERE ativo = 1";
                      $arrtable = my_query($sql_combobox);

                      $onChange = $ajax ? 'onchange="ajax(this.value, \'' . $name . '\')"' : '';
                      echo '<select ' . $onChange . ' required name="' . $name . '" id="' . $id_campo . '" class="select2 form-select" onchange="handleChange(this)">';

                      if ($especificacao == 'editar') {
                        $id_Selected = $arrResultados[0]['id_' . $id_campo];
                      } else {
                        echo '<option value="">Selecione uma opção</option>';
                        $id_Selected = '';
                      }

                      foreach ($arrtable as $v) {
                        $selected = ($id_Selected == $v['id_' . $id_campo]) ? 'selected="selected"' : '';
                        echo '<option ' . $selected . ' value="' . $v['id_' . $id_campo] . '">' . $v[$id_campo] . '</option>';
                      }

                      echo '</select>';
                    } else {
                      $value = $especificacao == 'editar' ? $arrResultados[0][$name] : '';
                      echo '<input placeholder="' . $placeholder . '" ' . $config . ' required type="' . $type . '" max="' . $max . '" min="' . $min . '" class="form-control" id="' . $id_campo . '" name="' . $name . '" value="' . $value . '" oninput="trata(this)"/>';
                    }
                    echo '</div>';
                  }
                }
                ?>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary me-2">Guardar Alterações</button>
              </div>
            </form>
          </div>
        </div>
       
     
      <?php } ?>
     
    </div>
  </div>
  <?php
    }
    ?>
</div>