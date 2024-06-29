<?php
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
include $arrConfig['dir_include'].'/auth.inc.php';
$id_turma =isset($_POST['id_turma']) ? $_POST['id_turma'] : '';


$pagename = isset($_POST['pagename']) ? $_POST['pagename'] : '';

$url = $arrConfig['url_site'] .'/'. $pagename;



if (isset($_FILES['imageUpload'])) {
    $image = $_FILES['imageUpload'] ?? '';
    if ($image['name'] != '') {
        
        $extensao = pathinfo($image['name'], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid();
        $pasta = $arrConfig['dir_fotos_upload'] . '/horario/';
        move_uploaded_file($image['tmp_name'], $pasta . $nome_arquivo . '.' . $extensao);
    }
   if(isset($nome_arquivo) ){
    $sql = 'UPDATE turma SET horario = "'.$nome_arquivo.'.'.$extensao.'" WHERE id_turma = '.$id_turma.'';
   my_query($sql);
   } else {
    
   }
}
header("Location: $url");

