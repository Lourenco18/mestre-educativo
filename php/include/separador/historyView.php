<?
$id_unico = my_query("SELECT unico from $tabela where id_$tabela = $id");
$id_unico = $id_unico[0]["unico"];

$query= "SELECT 
        aluno.*, 
        aluno.data AS data_aluno,
        colaborador.colaborador AS nome_orientador_anterior,
        encarregadoeducacao.encarregadoeducacao AS nome_encarregado_anterior,
        relacao.relacao AS nome_relacao_anterior,
        genero.genero AS nome_genero_anterior,
        localidade.localidade AS nome_localidade_anterior,
        escola.escola AS nome_escola_anterior,
        nacionalidade.nacionalidade AS nome_nacionalidade_anterior,
        turma.turma AS nome_turma_anterior,
        distrito.distrito AS nome_distrito_anterior,
        cidade.cidade AS nome_cidade_anterior,
        ciclo.ciclo AS nome_ciclo_anterior,
        anoletivo.anoletivo AS nome_anoletivo_anterior
    FROM aluno 
    INNER JOIN colaborador ON aluno.id_orientador = colaborador.unico
    INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.unico
    INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.unico
    INNER JOIN genero ON genero.unico = aluno.id_genero
    INNER JOIN localidade ON localidade.unico = aluno.id_localidade
    INNER JOIN escola ON escola.unico = aluno.id_escola
    INNER JOIN nacionalidade ON nacionalidade.unico = aluno.id_nacionalidade
    INNER JOIN turma ON turma.unico = aluno.id_turma
    INNER JOIN distrito ON distrito.unico = aluno.id_distrito
    INNER JOIN cidade ON cidade.unico = aluno.id_cidade
    INNER JOIN ciclo ON ciclo.unico = aluno.id_ciclo
    INNER JOIN anoletivo ON anoletivo.unico = aluno.id_anoletivo
    WHERE aluno.unico = $id_unico
    AND colaborador.data = (
        SELECT MAX(data) 
        FROM colaborador 
        WHERE colaborador.unico = aluno.id_orientador
    )
    AND encarregadoeducacao.data = (
        SELECT MAX(data) 
        FROM encarregadoeducacao 
        WHERE encarregadoeducacao.unico = aluno.id_encarregadoeducacao
    )
    AND relacao.data = (
        SELECT MAX(data) 
        FROM relacao 
        WHERE relacao.unico = encarregadoeducacao.id_relacao
    )
    AND genero.data = (
        SELECT MAX(data) 
        FROM genero 
        WHERE genero.unico = aluno.id_genero
    )
    AND localidade.data = (
        SELECT MAX(data) 
        FROM localidade 
        WHERE localidade.unico = aluno.id_localidade
    )
    AND escola.data = (
        SELECT MAX(data) 
        FROM escola 
        WHERE escola.unico = aluno.id_escola
    )
    AND nacionalidade.data = (
        SELECT MAX(data) 
        FROM nacionalidade 
        WHERE nacionalidade.unico = aluno.id_nacionalidade
    )
    AND turma.data = (
        SELECT MAX(data) 
        FROM turma 
        WHERE turma.unico = aluno.id_turma
    )
    AND distrito.data = (
        SELECT MAX(data) 
        FROM distrito 
        WHERE distrito.unico = aluno.id_distrito
    )
    AND cidade.data = (
        SELECT MAX(data) 
        FROM cidade 
        WHERE cidade.unico = aluno.id_cidade
    )
    AND ciclo.data = (
        SELECT MAX(data) 
        FROM ciclo 
        WHERE ciclo.unico = aluno.id_ciclo
    )
    AND anoletivo.data = (
        SELECT MAX(data) 
        FROM anoletivo 
        WHERE anoletivo.unico = aluno.id_anoletivo
    )
    
    ORDER BY aluno.data DESC";
  
$arrhistorico = my_query($query);
// Verifica se a variável $arrhistorico está definida e não vazia antes de usá-la
if (isset($arrhistorico) && !empty($arrhistorico)) {
    foreach ($arrhistorico as $k => $v) {
        // Resto do código de iteração e comparação aqui...
    }
} else {
    echo "Não foram encontrados registros para exibir.";
}
?>
<div class="card mb-3 px-md-4 ps-0" style="background-color: white">
    <div id="historyView" class="divisao" style="display: none;">
        <div class="row row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3"
            style="padding: 20px;">

            <?php
            // Iterar sobre os resultados
            foreach ($arrhistorico as $k => $v) {
                // Verificar se não é o primeiro registro (x-1 existe)
                if ($k > 0) {
                    // Comparar valores e exibir diferenças
                    foreach ($v as $campo => $valor) {
                        // Ignorar campos específicos que não deseja comparar
                        if ($campo == 'data_aluno' || $campo == 'nome_aluno') {
                            continue;
                        }

                        // Obter nome do campo
                        $nome_campo = ucwords(str_replace('_', ' ', $campo));

                        // Comparar valores entre x e x-1
                        if ($v[$campo] != $arrhistorico[$k - 1][$campo]) {
                            echo '<div class="col">';
                            echo '<a>';
                            echo '<div class="card h-70 ps-0 py-xl-3" style="background-color: white; transition: all 0.3s ease;"';
                            echo 'onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff\'; this.style.zIndex=\'1\';"';
                            echo 'onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\'">';
                            echo '<div class="card-body" style="text-align: center;height: 231.599258px;  margin-left: 0px">';
                            echo '<h5 class="card-title">' . $v[$tabela] . '</h5>';
                            echo '<h5 class="card-title">Data da Alteração: ' . $v['data_aluno'] . '</h5>';
                            echo '<h5 class="card-title">Campo Alterado: ' . $nome_campo . '</h5>';
                            echo '<h5 class="card-title">Valor Anterior: ' . $arrhistorico[$k - 1][$campo] . '</h5>';
                            echo '<h5 class="card-title">Valor Atual: ' . $v[$campo] . '</h5>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                    }
                }
            }
            ?>

        </div>
    </div>
</div>
