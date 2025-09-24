<?php

// No arquivo editar.php

// Verifica se o parâmetro 'id' está presente na URL
if (isset($_GET['id'])) {
    // Obtém o valor do parâmetro 'id' da URL
    $id = $_GET['id'];

    // Agora você pode usar $id conforme necessário no restante do código
    echo "ID do Aluno: " . $id;
} else {
    // Se o parâmetro 'id' não estiver presente, faz alguma ação de fallback ou redirecionamento
    echo "ID do Aluno não fornecido";
}
?>
