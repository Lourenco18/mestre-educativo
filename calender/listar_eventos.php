<?php

include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';




$query = "SELECT *, MAX(A.id_escola) as id_escola, MAX(B.id_turma) as id_turma FROM evento INNER JOIN escola A ON evento.id_escola = A.unico INNER JOIN turma B ON evento.id_turma = B.unico WHERE evento.ativo = 1";

$arrEvents = my_query($query);

$escola = my_query('SELECT escola, id_escola from escola where id_escola = '.$arrEvents[0]['id_escola'].'');
$turma = my_query('SELECT turma, id_turma from turma where id_turma = '.$arrEvents[0]['id_turma'].'');
$escola = $escola[0]['escola'];
$turma = $turma[0]['turma'];

foreach($arrEvents as $k => $v){

    $eventos[] = [
        'id' => $v['id'],
        'title' => $v['title'],
        'start' => $v['start'],
        'end' => $v['end'],
        'color' => $v['color'],
        'extendedProps'=> array(
            'descricao'=>$v['descricao'],
            'turma'=>$turma,
            'escola'=>$escola,
        ),
    ];
 
}

echo json_encode($eventos);
