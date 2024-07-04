<?php
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';

$pagename = $_POST['pagename'];
$id_unico_aluno14 = $_POST['id_aluno'];

$pagename = preg_replace("'----'","&", $pagename);
$url = $arrConfig['url_site'] .'/'. $pagename;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imageUpload'])) {
    $images = $_FILES['imageUpload'];

    foreach ($images['tmp_name'] as $key => $tmp_name) {
        $image = array(
            'name' => $images['name'][$key],
            'type' => $images['type'][$key],
            'tmp_name' => $tmp_name,
            'error' => $images['error'][$key],
            'size' => $images['size'][$key]
        );

        $extensao = pathinfo($image['name'], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid();
        $pasta = $arrConfig['dir_fotos_upload'].'/galeria/';

        move_uploaded_file($image['tmp_name'], $pasta.$nome_arquivo.'.'.$extensao);
        $data = date('d/m/Y');
        my_query('INSERT INTO foto (id_unico, ativo, removed, foto, data) VALUES ('.$id_unico_aluno14.', 1, 0,"'.$nome_arquivo.'.'.$extensao.'","'.$data.'"  )');

    }
}

header('location: '.$url.'');