<?php

// permissões
global $niveis;
$niveis= [
    'supra_admin' => 3,
    'Admin' => 2,
    'Professor' => 1,
    'Motorista' => 1,
];
if(isset($_SESSION['userCargo'])){
    if (isset($niveis[$_SESSION['userCargo']])) {
        // Obtém o nível correspondente ao cargo do usuário
        global $nivel;
        $nivel = $niveis[$_SESSION['userCargo']];
       
    }else{
        $nivel = 0;
    }
}
