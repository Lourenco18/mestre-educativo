<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php

// Verifica se o ID foi recebido via POST
if (isset($_POST['anoletivoId'])) {
    $selectedId = $_POST['anoletivoId'];

    // Aqui você pode usar $selectedId para realizar qualquer operação necessária
    // por exemplo, consultas ou atualizações no banco de dados com base no ID selecionado.

    // Exemplo de saída de depuração
    echo "ID selecionado: " . $selectedId;
} else {
    // Caso o valor não seja recebido corretamente
    echo "Erro: Nenhum ID recebido.";
    exit; // Encerre o script se não houver ID recebido
}

