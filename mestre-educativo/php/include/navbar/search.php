<?php
// Inclui o arquivo de configuração
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';

// Recebe o parâmetro de pesquisa do POST
$query = $_POST['query'];

// Array para armazenar os resultados
$resultados = array();

// Itera sobre todas as tabelas, exceto 'log', 'pagamento' e 'aluno'
foreach ($all_tables as $tabela) {
    if ($tabela !== 'log' && $tabela !== 'pagamento' && $tabela !== 'permissao') {
        // Monta a consulta SQL para a tabela principal
        if($tabela == 'aluno'){
            $sql = 'SELECT * FROM aluno WHERE aluno LIKE "%'.$query.'" OR aluno LIKE "%'.$query.'%" OR aluno LIKE "'.$query.'%";';
        }else{
            $sql = 'SELECT * FROM '.$tabela.' WHERE '.$tabela.' LIKE "%'.$query.'" OR '.$tabela.' LIKE "%'.$query.'%" OR '.$tabela.' LIKE "'.$query.'%";';
        }
      

        // Executa a consulta para a tabela principal
        $res = my_query($sql);

        // Verifica se há resultados na tabela principal e os armazena
        if ($res !== false && !empty($res)) {
            $resultados[$tabela] = $res;

            // Verifica se há uma tabela de fotos associada (prefixo 'foto_' + nome da tabela principal)
            $tabela_foto = 'foto_'.$tabela;
            if (in_array($tabela_foto, $all_tables)) {
                // Monta a consulta SQL para a tabela de fotos
                $sql_foto = 'SELECT foto FROM '.$tabela_foto.' WHERE '.$tabela_foto.' LIKE "%'.$query.'" OR '.$tabela_foto.' LIKE "%'.$query.'%" OR '.$tabela_foto.' LIKE "'.$query.'%";';

                // Executa a consulta para a tabela de fotos
                $res_foto = my_query($sql_foto);

                // Armazena os resultados da tabela de fotos
                if ($res_foto !== false && !empty($res_foto)) {
                    $resultados[$tabela_foto] = $res_foto;
                }
            }
        }
    }
}

if(empty($resultados)) {
    echo "<h5>Não foram encontrados resultados.</h5>";
}else{
    foreach ($resultados as $tabela => $registros) {
        // Verifica se há registros encontrados para esta tabela
           $arrtitulos = ('SELECT display from operacao where operacao = "'.$tabela.'"');
           $arrtitulos = my_query($arrtitulos);
         
        if (count($arrtitulos) > 0){
            $titulo = $arrtitulos[0]['display'];
           }else{
            $titulo = $tabela;
           }
            echo "<h5>$titulo</h5>";
            echo "<ul>";
            foreach ($registros as $registro) {
                // Constrói o link com base nas condições específicas de cada tabela
                if ($tabela == 'operacao') {
                    if ($registro['tipo_form'] == 'adicionar') {
                        $link = "http://localhost/mestre-educativo/pagina-formulario.php?id=".$registro['id_'.$tabela]."&tipo=".$registro['particao']."&especificacao=adicionar";
                    } else {
                        $link = "http://localhost/mestre-educativo/subcategorias.php?display=".$registro['display']."&pagina=".$registro[$tabela]."&id=".$registro['id_'.$tabela]."&especificacao=&tipo=".$registro['particao'];
                    }
                } else {
                    $link = "http://localhost/mestre-educativo/pagina-formulario.php?id=".$registro['id_'.$tabela]."&tipo=".$tabela."&especificacao=editar";
                }
    
                // Verifica se há uma foto associada
                if (isset($registro['foto_'.$tabela])) {
                    if($registro['foto_'.$tabela] == '') {
                        $arricons = my_query('SELECT operacao, foto_operacao FROM operacao WHERE ativo = 1 AND removed = 0 and operacao = "'.$tabela.' "');
                        $icon = $arricons[0]['foto_operacao'];
                        $src = $arrConfig['url_imjs_upload'].'/icons/'.$icon;
                    }else{
                        if($tabela == 'operacao'){
                            $src = $arrConfig['url_imjs_upload'].'/icons/'.$registro['foto_'.$tabela];

                        }else{
                            $src = $arrConfig['url_fotos_upload'].'/'.$tabela.'/'.$registro['foto_'.$tabela];
                        }
                       

                    }
                    // Exibe a imagem com link
                    echo '<a href="'.$link.'">';
                    if($tabela == 'operacao'){
                        echo '<img style="width: 40px; height: 40px;" src="'.$arrConfig['url_imjs_upload'].'/icons/'.$registro['foto_'.$tabela].'" alt="Foto">';
                    }else{
                        echo '<img style="width: 40px; height: 40px;" src="'.$src.'" alt="Foto">';
                    }
                    
                    echo '</a> - ';
    
                    // Exibe o texto que está na frente da imagem com link
                    if ($tabela == 'operacao') {
                        echo '<a href="'.$link.'">'.htmlspecialchars($registro['display']).'</a><br>';
                    } else {
                        echo '<a href="'.$link.'">'.htmlspecialchars($registro[$tabela]).'</a><br>';
                    }

                } else {
                    // Exibe apenas o texto se não houver foto
                    echo '<a href="'.$link.'">'.htmlspecialchars($registro[$tabela]).'</a><br>';
                }
            }
            echo "</ul>";
        }
}



