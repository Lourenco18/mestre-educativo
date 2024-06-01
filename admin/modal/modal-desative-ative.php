<div class="modal modal-mid fade" id="modalTopDesative<?php echo $id; ?>" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="<?php echo $arrConfig['url_trata']; ?>/verf-exist.php">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer desativar este <?php echo $tabela; ?>?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-warning" style="background-color: orange; border-color: orange; color: white;">Sim, quero desativar</button>
      </div>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="tabela" value="<?php echo $tabela; ?>">
      <input type="hidden" name="acao" value="desativar">
      <input type="hidden" name="pagename" value="<?php echo $_SERVER['PHP_SELF']; ?>">
    </form>
  </div>
</div>

<div class="modal modal-mid fade" id="modalTopAtive<?php echo $id; ?>" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="<?php echo $arrConfig['url_trata']; ?>/verf-exist.php">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer ativar este <?php echo $tabela; ?>?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Sim, quero ativar</button>
      </div>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="tabela" value="<?php echo $tabela; ?>">
      <input type="hidden" name="acao" value="ativar">
      <input type="hidden" name="pagename" value="<?php echo $_SERVER['PHP_SELF']; ?>">
    </form>
  </div>
</div>
