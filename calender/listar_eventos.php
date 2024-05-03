<?php

include '../php/include/config.inc.php';




$query = "SELECT * FROM evento INNER JOIN escola A ON evento.id_escola = A.id_escola INNER JOIN turma B ON evento.id_turma = B.id_turma WHERE evento.ativo = 1";
$arrEvents = my_query($query);
var_dump($arrEvents);


foreach($arrEvents as $k => $v){

    $eventos[] = [
        'id' => $v['id'],
        'title' => $v['title'],
        'start' => $v['start'],
        'end' => $v['end'],
        'color' => $v['color'],
        'extendedProps'=> array(
            'descricao'=>$v['descricao'],
            'turma'=>$v['turma'],
            'escola'=>$v['escola'],
        ),
    ];
 
}

echo json_encode($eventos);
