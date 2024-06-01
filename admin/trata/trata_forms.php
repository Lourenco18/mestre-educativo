<?php
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
include '../forms_campos.php';
foreach ($campos as $campo) {
    $id_campo = $campo['id'];
}

$pagename = $_GET['pagename'] ?? '';
$id = $_GET['id'] ?? '';
$tabela = $_GET['tabela'] ?? '';
$acao = $_GET['acao'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //imagem
    $image = $_FILES['image'] ?? '';
   
    $pdf = $_FILES['pdf'] ?? '';
    //carcateristicas da imagem
     if ($image != ''){
        $extensao = pathinfo($image['name'], PATHINFO_EXTENSION);
     }
    
    if($image != ''){
    $nome_arquivo = uniqid();
    $pasta =$arrConfig['dir_fotos_upload'].'/'.$tabela.'/';

      
        move_uploaded_file($image['tmp_name'], $pasta.$nome_arquivo.'.'.$extensao);
    
    }
  
    //resto de dados
    $dados = [];
    $columns = [];
     // Verificar se a variavel 'object' é igual ao nome da tabela desejada
    foreach ($GLOBALS['campos'] as $campo) {
       
        if (isset($campo['object']) && $campo['object'] === $tabela) {
            // Verificar se a chave 'name' está definida e não está vazia
            if (isset($campo['name']) && !empty($campo['name'])) {
                // Adicionar o valor da chave 'name' ao array $columns
                $columnName = $campo['name'];

                // Verificar se o tipo é igual a 'combobox'
                if ($campo['type'] === 'combobox' || isset($campo['defenido'])) {
                    // Adicionar 'id_' ao nome da variável
                    $columnName = 'id_' . $campo['name'];
                } 
                // Adicionar o nome da coluna ao array $columns
                $columns[] = $columnName;
            }
        }
    }



    foreach ($columns as $column) {
        $columnName = str_replace('id_', '', $column);
        // Verificar se o campo existe no POST antes de atribuir seu valor
        if (isset($_POST[$columnName])) {
     
            // Verificar se o campo é uma foto
            if($image != ''){
             
                if(strpos($columnName , 'foto') !== false) {
                    $dados[$column] =  $nome_arquivo.'.'.$extensao;
                }
            }else{
               
                    
                 
                
            }
            $dados[$column] = $_POST[$columnName];
        } else {
          
            // Se o campo não existe no POST, atribuir uma string vazia
            $dados[$column] = '';
        }

    }


    // Now $dados contains the appropriate data for the selected table


    $campos = ''; // Inicializa a variável que vai armazenar os campos
    $count = 0;
    foreach ($dados as $coluna => $valor) {
        if ($count > 0) {
            $campos .= ", "; // Adiciona vírgula se não for o primeiro valor
        }
        $campos .= $coluna; // Adiciona o nome da coluna
        $count++;
    }



}
;

if ($acao == 'adicionar') {

    $tabela = rtrim($tabela, "s");
    $sql_form = "INSERT INTO $tabela ($campos) VALUES (" . implode(", ", array_map(function ($value) {
        return "'$value'";
    }, $dados)) . ")";



} elseif ($acao == 'editar') {
    $sql_form = "UPDATE $tabela SET ";
    foreach ($dados as $coluna => $valor) {
        $sql_form .= "$coluna = '$valor', ";
    }
    $sql_form = rtrim($sql_form, ", ") . " WHERE id_$tabela = $id";

} elseif ($acao == 'apagar') {
    $sql_form = "UPDATE $tabela SET removed = 1, ativo = 0 WHERE id_$tabela = $id";

}elseif($acao == 'desativar'){
   
        $sql_form = "UPDATE $tabela SET ativo = 0 WHERE id_$tabela = $id";
    
    
}elseif($acao == 'ativar'){
    if ($tabela == 'nota') {
        $sql_form = "UPDATE $tabela SET id_status = 1 WHERE id_nota = $id";
    } else{
        $sql_form = "UPDATE $tabela SET ativo = 1 WHERE id_$tabela = $id";
    }
    }
   
;



my_query($sql_form);
header("Location: ../../index.php");



