<?php
$current_page = $_SERVER['REQUEST_URI'];
include 'forms_campos.php';
$page_name = basename($current_page);
?>

<div class="modal modal-mid fade" id="modalTopEvent" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle">Informações do evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="visualizar">
          <dl class="row">
            <dt class="col-sm-3">Título:</dt>
            <dd class="col-sm-9" id="vtitle"></dd>

            <dt class="col-sm-3">Descrição:</dt>
            <dd class="col-sm-9" id="vdescricao"></dd>

            <dt class="col-sm-3">Escola:</dt>
            <dd class="col-sm-9" id="vescola"></dd>

            <dt class="col-sm-3">Turma:</dt>
            <dd class="col-sm-9" id="vturma"></dd>

            <dt class="col-sm-3">Início:</dt>
            <dd class="col-sm-9" id="vstart"></dd>

            <dt class="col-sm-3">Fim:</dt>
            <dd class="col-sm-9" id="vend"></dd>
          </dl>
          <button type="button" id="btnEdit" class="btn btn-primary">Editar</button>
        </div>
        <?php event_view("edit", "processar_edit.php", "Editar"); ?>
        <?php event_view("add", "processar_add.php", "Adicionar"); ?>
      </div>
    </form>
  </div>
</div>



<div class="modal modal-mid fade" id="modalTopAtive" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer ativar este <?php echo $tabela; ?>?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a type="button" class="btn btn-primary" href="<?php echo $arrConfig['url_trata']; ?>/verf-exist.php?id=<?php echo $id; ?>&tabela=<?php echo $tabela; ?>&acao=ativar&pagename=<?php echo $_SERVER['PHP_SELF']; ?>" onclick="SwalSuccess()">Sim, quero ativar</a>
      </div>
    </form>
  </div>
</div>

<?php
$arrNotas = my_query('SELECT * FROM nota INNER JOIN statu ON statu.id_statu = nota.id_status INNER JOIN colaborador ON colaborador.id_colaborador = nota.id_colaborador INNER JOIN cargo ON cargo.id_cargo = colaborador.id_cargo WHERE nota.ativo = 1 ORDER BY nota.id_status DESC');
?>

<div class="modal modal-mid fade" id="modalnotes" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="<?php echo $arrConfig['url_trata']; ?>/trata_forms.php?pagename=<?php echo $page_name; ?>&id=<?php echo $id_unico; ?>&tabela=nota&acao=adicionar" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle">Notas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="listView">
        <div class="modal-body" style="max-height: 800px; overflow-y: auto;">
          <?php if (count($arrNotas) == 0): ?>
            <h2>Não existem notas</h2>
          <?php else: ?>
            <?php foreach ($arrNotas as $v): $id= $v['id_nota'];$id_unico = my_query("SELECT id_nota, unico from nota where id_nota = $id"); $id_unico = $id_unico[0]['unico'];?>

              <div class="card">
                <div class="card-body">
                  <div class="card-bar" style="position: absolute; top: 0; left: 0; width: 100%; height: 4px; background-color: <?php echo $v['cor_statu']; ?>"></div>
                  <h2 class="card-title"><?php echo $v['titulo']; ?></h2>
                  <h4 class="card-text"><?php echo $v['nota']; ?></h4>
                  <h7 class="card-text">Nota feita por: <?php echo $v['colaborador']; ?> - <?php echo $v['cargo']; ?></h7><br>
                  <h7 class="card-text">Data da nota: <?php echo $v['data']; ?></h7>
                  <div class="card-buttons" style="margin-top: 4px;">
                    <?php if ($v['id_statu'] == 2): ?>
                      <button class="btn btn-primary" type="button" style="background-color: green; border-color: green;" title="Visto" onclick="window.location.href = '<?php echo $arrConfig['url_trata']; ?>/trata_forms.php?acao=ativar&tabela=nota&id=<?php echo $id_unico; ?>';">
                        <i class="bx bx-check"></i>
                      </button>
                    <?php endif; ?>
                    <button class="btn btn-primary" type="button" style="background-color: orange; border-color: orange;" title="Remover" onclick="window.location.href = '<?php echo $arrConfig['url_trata']; ?>/trata_forms.php?acao=apagar&tabela=nota&id=<?php echo $id_unico; ?>';">
                      <i class="bx bx-trash"></i>
                    </button>
                  </div>
                </div>
              </div><br>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <div class="modal-footer">
          <?php
          $arrStatus = my_query("SELECT * from statu WHERE ativo = 1");
          foreach ($arrStatus as $v) {
            echo '<button class="btn btn-primary" style="background-color: ' . $v['cor_statu'] . '; border-color: ' . $v['cor_statu'] . ';" title="Visto" disabled>' . $v['statu'] . '</button>';
          }
          ?>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" id="active-formView" class="btn btn-primary">Deixar nota</button>
        </div>
      </div>
      <div id="formView" style="display: none">
        <div class="modal-body" style="max-height: 800px; overflow-y: auto;">
          <?php
          $especificacao = "nota";
          $tipo = "nota";
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

                echo '<option value="">Selecione uma opção</option>';

                foreach ($arrtable as $v) {
                  echo '<option value="' . $v['id_' . $id_campo] . '">' . $v[$id_campo] . '</option>';
                }

                echo '</select>';
              } else {
                echo '<input placeholder="' . $placeholder . '" ' . $config . ' required type="' . $type . '" max="' . $max . '" min="' . $min . '" class="form-control" id="' . $id_campo . '" name="' . $name . '"/>';
              }
              echo '</div>';
            }
          }
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

<script>
document.getElementById("active-formView").addEventListener("click", function () {
  document.getElementById("listView").style.display = "none";
  document.getElementById("formView").style.display = "block";
});
document.getElementById("active-listView").addEventListener("click", function () {
  document.getElementById("listView").style.display = "block";
  document.getElementById("formView").style.display = "none";
});
</script>
