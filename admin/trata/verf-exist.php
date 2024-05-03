<?php
include '../../php/include/config.inc.php';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$tabela = isset($_GET['tabela']) ? $_GET['tabela'] : '';
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

if ($tabela == 'encarregadoeducacao' || $tabela == 'turma' || $tabela == 'escola' || $tabela == 'colaborador') {
    
    if ($tabela == 'encarregadoeducacao') {
    
        $query = 'SELECT aluno.id_encarregadoeducacao FROM aluno INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao WHERE aluno.id_encarregadoeducacao = ' . $id . '';
    } elseif ($tabela == 'escola') {
        $query = 'SELECT aluno.id_escola FROM aluno INNER JOIN escola ON aluno.id_escola = escola.id_escola WHERE aluno.id_escola= ' . $id . '';
    } elseif ($tabela == 'turma') {
               $query = 'SELECT aluno.id_turma FROM aluno INNER JOIN turma ON aluno.id_turma = turma.id_turma WHERE aluno.id_turma= ' . $id . '';
    
    
    } elseif ($tabela == 'colaborador') {
               $query = 'SELECT aluno.id_orientador FROM aluno INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador WHERE aluno.id_orientador = ' . $id . '';
    }
  
    if (count(my_query($query)) >= 1) {
        echo 'tem aluno se remover o encarregado de educação o aluno vai para a lista de desaticados';
     
    } else {
        // Adicionando corretamente o botão com a função autoClick()
        echo '<a id="autoclickButton" type="button" style="color: white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id=' . $id . '&tabela=' . $tabela . '&acao=' . $acao . '&pagename=' . $_SERVER['PHP_SELF'] . '" onclick="SwalSuccess()"></a>';
    }
    // A saída do PHP está completa, então não é necessário mais código PHP depois disso

} else {
    // Adicionando corretamente o botão com a função autoClick()
    echo '<a id="autoclickButton" type="button" style="color: white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id=' . $id . '&tabela=' . $tabela . '&acao=' . $acao . '&pagename=' . $_SERVER['PHP_SELF'] . '" onclick="SwalSuccess()"></a>';
}
?>
<script>
    // A função autoClick() é definida aqui e não dentro do bloco PHP
    function autoClick() {
        // Obtém a referência do botão pelo ID
        var button = document.getElementById('autoclickButton');
        // Simula um clique no botão
        button.click();
    }
    // Chama a função autoClick() assim que o script for carregado
    autoClick();
</script>