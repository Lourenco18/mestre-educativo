<h4 class="fw-bold py-3 mb-4"><a href="index.php" class="text-muted fw-light" >Home / 


<?php
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
$tipo = $_GET['tipo'];
$especificacao = $_GET['especificacao'];
$arroperacao = my_query("SELECT * FROM operacao WHERE operacao = '$tipo'");
$idd = $arroperacao[0]['id_operacao'];
$display = $arroperacao[0]['display'];
echo'</a> <a href="http://localhost/mestre-educativo/subcategorias.php?pagina='.$tipo.'&id='.$idd.'&display='.$display.'" class="text-muted fw-light" >'.$display.' / </a>'; if($especificacao == 'editar'){}else{echo 'Adicionar';}; echo'</h4>';