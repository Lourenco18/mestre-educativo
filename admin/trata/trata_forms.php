<?php

include $_SERVER['DOCUMENT_ROOT'] . '/mestre-educativo/php/include/config.inc.php';
include '../forms_campos.php';
foreach ($campos as $campo) {
    $id_campo = $campo['id'];
}

$pagename = $_GET['pagename'] ?? '';
$id = $_GET['id'] ?? '';
$tabela = $_GET['tabela'] ?? '';
$acao = $_GET['acao'] ?? '';
$id_unico = my_query("SELECT MAX(unico) FROM $tabela");
$id_unico = $id_unico[0]['MAX(unico)'] + 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_FILES['image'])){

        $image = $_FILES['image'] ?? '';
        if ($image['name'] != ''){
       
            $extensao = pathinfo($image['name'], PATHINFO_EXTENSION);
        
        
        
        $nome_arquivo = uniqid();
        $pasta =$arrConfig['dir_fotos_upload'].'/'.$tabela.'/';
    
        
            move_uploaded_file($image['tmp_name'], $pasta.$nome_arquivo.'.'.$extensao);
    
    }
}else{
    $nome_arquivo = my_query("SELECT foto_$tabela FROM $tabela WHERE id_$tabela = $id");
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
        if (isset($_POST[$columnName])) {
            if($image['name'] != ''){
             
                if(strpos($columnName , 'foto') !== false) {

                    $dados[$column] =  $nome_arquivo.'.'.$extensao; 

                }else{
                    $dados[$column] = $_POST[$columnName];
                }
            }else{
                $dados[$column] = $_POST[$columnName];
            }
           

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

    // atribuir as notas o valor zero, de todos os periodos e de todas as disciplinas
    if ($tabela == "aluno") {

        $id_ciclo = $dados['id_ciclo'];
        $arrDisciplinas = my_query("SELECT id_disciplina from disciplina INNER JOIN ciclo on ciclo.id_ciclo = disciplina.id_ciclo WHERE disciplina.id_ciclo = $id_ciclo and disciplina.ativo = 1");
        var_dump($arrDisciplinas);
        $arrPeriodos = array(1, 2, 3);
        foreach ($arrDisciplinas as $k => $v) {
            for ($i = 0; $i < count($arrPeriodos); $i++) {
                $avaliacaoUnico = my_query("SELECT MAX(unico) FROM avaliacao");
                $avaliacaoUnico = $avaliacaoUnico[0]['MAX(unico)'] + 1;
                $sql = "INSERT INTO avaliacao (id_aluno, id_disciplina, periodo, id_anoletivo, unico, ativo) VALUES ($id_unico,{$v['id_disciplina']}, {$arrPeriodos[$i]}, {$arrConfig['anoLetivo']}, $avaliacaoUnico, 1)";
                echo $sql;
            }
        }

    } elseif ($tabela == "operacao") {
        $id_novaOperacao = my_query("SELECT MAX(unico) FROM operacao");
        $id_novaOperacao = $id_novaOperacao[0]['MAX(unico)'] + 1;
        $nomeOperacao = $dados['operacao'];
        $arrCargos = array('Administrador' => 2, 'Super administrador' => 1);
        foreach ($arrCargos as $k => $v) {
            my_query("INSERT INTO permissao (id_operacao, permissao, id_cargo) VALUES ($id_novaOperacao, '$nomeOperacao-$k', $v)");

        }

    }

} elseif ($acao == 'editar') {
    if ($tabela !== "avaliacao") {
        $tabela = rtrim($tabela, "s");
        $sql_form = "INSERT INTO $tabela ($campos) VALUES (" . implode(", ", array_map(function ($value) {
            return "'$value'";
        }, $dados)) . ")";
    } else {
        $arrayAvaliacao = array(); //array onde vão ser armazenadas as avaliações com as suas respetivas definições
    
        foreach ($_POST as $key => $value) { // ler os dados do formulário enviado com todas as avaliações
            // Verifica se o nome do campo segue o padrão esperado
            if (preg_match('/^disciplina_(\d+)_periodo_(\d+)aluno_(\d+)$/', $key, $matches)) {// verifica o padrão do id de cada selectedBox
                // Extrai os valores de disciplina, periodo e id_aluno
                $disciplina = $matches[1];
                $periodo = $matches[2];
                $id_aluno = $matches[3];
                // Armazena o valor da select box na array
                $arrayAvaliacao[$id_aluno][$disciplina][$periodo] = $value;
            }
        }
        // query para realizar a alteração das avaliações
        foreach ($arrayAvaliacao as $id_aluno => $disciplinas) {
            foreach ($disciplinas as $disciplina => $periodos) {
                foreach ($periodos as $periodo => $selectValue) {
                    my_query("UPDATE $tabela set avaliacao =  $selectValue where id_disciplina = $disciplina AND id_aluno = $id_aluno and periodo =  $periodo");
                   
                }
            }
        }
        
    }



} elseif ($acao == 'apagar') {
    $sql_form = "UPDATE $tabela SET removed = 1, ativo = 0 WHERE unico = $id";

} elseif ($acao == 'desativar') {

    $sql_form = "UPDATE $tabela SET ativo = 0 WHERE unico = $id";


} elseif ($acao == 'ativar') {
    if ($tabela == 'nota') {
        $sql_form = "UPDATE $tabela SET id_status = 1 WHERE unico = $id";
    } else {
        $sql_form = "UPDATE $tabela SET ativo = 1 WHERE unico = $id";
    }
}

;

if(isset($sql_form)){
    my_query($sql_form);
}

header("Location: ../../index.php");



