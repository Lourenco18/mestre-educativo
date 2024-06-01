<div class="modal modal-mid fade" id="modalForm" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $page_name; ?>&id=<?php echo $id_modal; ?>&tabela=<?php echo $tabela_modal; ?>&acao=editar" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle">Editar <?php echo $tabela_modal; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="max-height: 800px; overflow-y: auto;">
        <?php
        $tipo = $tabela_modal;
        if ($especificacao == "editar") {
          $consulta = $consultasForms[$tipo];
          $arrResultados = my_query($consulta);
        }

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
              echo '<input placeholder="' . $placeholder . '" ' . $config . ' required type="' . $type . '" max="' . $max . '" min="' . $min . '" class="form-control" id="' . $id_campo . '" name="' . $name . '" value="' . $value . '"/>';
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