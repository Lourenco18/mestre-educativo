<?php
$id = $_GET['id'] ?? '';
$tabela = $_GET['tabela'] ?? '';
$acao = $_GET['acao'] ?? '';
$data = $_GET['data'] ?? '';

$pagename = isset($_GET['pagename']) ? $_GET['pagename'] : '';



$pagename = preg_replace("'----'","&", $pagename);
$url = $arrConfig['url_site'] .'/'. $pagename;

if($acao == 'marcar'){
    $sql = "INSERT INTO $tabela (presenca, id_aluno, data) VALUES (1, $id, '$data')";
    my_query("INSERT INTO $tabela (presenca, id_aluno, data) VALUES (1, $id, '$data')") ;

   
}


header('Location: '.$url.'');