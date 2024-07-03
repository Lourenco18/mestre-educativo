<?php

echo '
 <div class="modal modal-mid fade" id="modalTopADDservice' . $v['id_' . $tabela] . '" tabindex="-1">
 <div class="modal-dialog">
   <form class="modal-content" action="' . $arrConfig['url_trata'] . '/trata-servico.php?id= ' . $id_unico . '&tabela=servico&acao=adicionar&pagename=' . preg_replace("'&'","----", basename($current_page)). '" method="POST" enctype="multipart/form-data">
     <div class="modal-header">
 <h5 class="modal-title" id="modalTopTitle">Adicionar serviço</h5>
 <div class="modal-body" style="max-height: 800px; overflow-y: auto;">';

$servicos = my_query($consultas['servico']);''?>

<?php foreach ($servicos as $servico): ?>
    <input type="checkbox" id="servico_<?php echo $servico['id_servico']; ?>" name="servico_ids[]" value="<?php echo $servico['id_servico']; ?>">
    <label for="servico_<?php echo $servico['id_servico']; ?>">
        <?php echo $servico['servico']; ?> - <?php echo $servico['valor']; ?>
    </label><br>
<?php endforeach; 

echo '</div>
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
 <button type="submit" class="btn btn-primary me-2">Adicionar</button>

 </div>
 </form>
 </div>
 </div>
 ';