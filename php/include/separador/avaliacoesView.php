<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/mestre-educativo/php/include/config.inc.php';
include $arrConfig['dir_admin'] . '/head.inc.php';
$legendasPorCiclo = [
    1 => [

        2 => 'Insuficiente',
        3 => 'Suficiente',
        4 => 'Bom',
        5 => 'Muito Bom'
    ],

];
// Query para obter o ciclo mais recente do aluno
$arrCicloMaisRecente = my_query("WITH CicloMaisRecente AS (
    SELECT 
        c.id_ciclo,
        c.unico,
        c.data,
        a.id_aluno,
        a.id_ciclo AS aluno_id_ciclo,
        ROW_NUMBER() OVER (PARTITION BY c.unico ORDER BY c.data DESC) AS rn
    FROM 
        ciclo c
    INNER JOIN 
        aluno a ON a.id_ciclo = c.id_ciclo
    WHERE 
        a.id_aluno = $id_aluno
)
SELECT 
    id_ciclo,
    unico,
    data,
    id_aluno,
    aluno_id_ciclo
FROM 
    CicloMaisRecente
WHERE 
    rn = 1;");

$Def_id_ciclo = $arrCicloMaisRecente[0]['id_ciclo'];

// Query para obter todos os anos letivos associados ao aluno
$arrAnoCiclo = my_query("
    SELECT 
        a.id_anoletivo,
        al.anoletivo,
        a.id_ciclo,
        a.data
    FROM 
        aluno a
    INNER JOIN 
        anoletivo al ON a.id_anoletivo = al.unico
    WHERE 
        a.unico = $id_unico_aluno
    ORDER BY 
        a.id_anoletivo, a.data DESC
");

// Processar os resultados para mapear cada ano letivo ao ciclo mais recente
$anoCicloMap = [];
foreach ($arrAnoCiclo as $entry) {
    $anoletivoId = $entry['id_anoletivo'];
    $anoletivo = $entry['anoletivo'];
    if (!isset($anoCicloMap[$anoletivoId])) {
        $anoCicloMap[$anoletivoId] = [
            'anoletivo' => $anoletivo,
            'id_ciclo' => $entry['id_ciclo']
        ];
    }
}

// Query para obter as avaliações do aluno
$arravaliacao = my_query("SELECT * FROM avaliacao WHERE id_aluno = $id_unico_aluno");
?>

<style>
    .disciplina-group {
        padding: 10px;
        margin-bottom: 10px;
    }

    .periodo-item {
        margin-bottom: 5px;
    }
    .anoletivo-container {
        margin-bottom: 20px;
    }

    .anoletivo-header {
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .anoletivo-header h3 {
        margin: 0;
        flex: 1;
    }

    .arrow-icon {
        width: 20px;
        height: 20px;
        transition: transform 0.3s ease;
    }

    .collapsed .arrow-icon {
        transform: rotate(-90deg);
    }

    table {
        border-collapse: collapse;
        width: 50%;
        max-width: 100%;
        margin: auto;
        table-layout: auto;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
        white-space: nowrap;
    }

    thead th {
        background-color: #f2f2f2;
    }
</style>

<div id="avaliacoesView" style="display: none;" class="divisao">
    <div class="card mb-3 px-md-4 ps-0" style="background-color: white;">
        <div class="container mt-5">
            <?php
            foreach ($anoCicloMap as $anoletivoId => $anoCiclo) {
                // Definir o ano letivo padrão para carregar inicialmente
                $id_ano_letivo = $anoletivoId;
                if (isset($anoCicloMap[$id_ano_letivo])) {
                    $cicloDoAnoLetivo = $anoCicloMap[$id_ano_letivo]['id_ciclo'];
                }

                // Query para obter as disciplinas do ciclo mais recente
                $arrDisciplinas = my_query("
                    SELECT d.*
                    FROM (
                        SELECT disciplina.*, 
                            ROW_NUMBER() OVER (PARTITION BY disciplina.unico ORDER BY disciplina.data DESC) AS row_num
                        FROM disciplina
                        INNER JOIN ciclo ON ciclo.id_ciclo = disciplina.id_ciclo
                        WHERE disciplina.id_ciclo = $cicloDoAnoLetivo
                    ) AS d
                    WHERE d.row_num = 1
                ");

                echo '<div class="anoletivo-container">';
                echo '<div class="anoletivo-header" data-toggle="collapse" data-target="#anoletivo_' . $anoletivoId . '">';
                echo '<h3>Ano Letivo: ' . $anoCiclo['anoletivo'] . '</h3><br><br>';
                echo '<img class="arrow-icon" src="https://cdn-icons-png.flaticon.com/512/54/54772.png">';
                echo '</div>'; // fecha anoletivo-header
                echo '<div id="anoletivo_' . $anoletivoId . '" class="collapse">';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Periodos/semestres</th>';
                foreach ($arrDisciplinas as $disciplina) {
                    echo '<th>' . $disciplina['disciplina'] . '</th>';
                }
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                for ($periodo = 1; $periodo <= 3; $periodo++) {
                    echo '<tr>';
                    echo '<td>' . $periodo . 'º</td>';
                    foreach ($arrDisciplinas as $disciplina) {
                        $avaliacao = my_query("SELECT * FROM avaliacao WHERE id_disciplina = {$disciplina['unico']} AND id_aluno = $id_unico_aluno AND periodo = $periodo");
                        $nota = $avaliacao[0]['avaliacao'];
                        // Verificar ciclo atual para determinar a legenda
                        if (isset($legendasPorCiclo[$cicloDoAnoLetivo][$nota])) {
                            echo '<td>' . $legendasPorCiclo[$cicloDoAnoLetivo][$nota] . '</td>';
                        } else {
                            echo '<td>' . $nota . '</td>'; // Caso não haja legenda definida
                        }
                    }
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>'; // fecha collapse
                echo '</div>'; // fecha anoletivo-container
            }
            ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalavaliacao">
                Editar avaliações
            </button><br><br>
        </div>
    </div>
</div>



<!-- Modal para Editar Avaliações -->
<div class="modal fade" id="modalavaliacao" tabindex="-1" aria-labelledby="modalTopTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content" action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $page_name; ?>&id=<?php echo $id_unico_aluno; ?>&tabela=avaliacao&acao=editar" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTopTitle">Editar Avaliações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <?php foreach ($anoCicloMap as $anoletivoId => $anoCiclo) {
        $id_ano_letivo = $anoletivoId;
        if (isset($anoCicloMap[$id_ano_letivo])) {
            $cicloDoAnoLetivo = $anoCicloMap[$id_ano_letivo]['id_ciclo'];
        }
    ?>
     <div class="anoletivo-container mb-4 p-3" style="border: 2px solid #000000; 
    border-radius: 10px;">


            <h6 style="cursor: pointer;" class="toggle-disciplinas" data-toggle-target="anoletivo-<?php echo $anoletivoId; ?>">
                Ano Letivo: <?php echo $anoCiclo['anoletivo']; ?>
                <i class="bi bi-chevron-down"></i> <!-- Ícone da seta -->
            </h6>
            <div id="anoletivo-<?php echo $anoletivoId; ?>" class="disciplinas-container" style="display: none;  ">
                <?php
                $arrDisciplinas = my_query("
                    SELECT d.*
                    FROM (
                        SELECT disciplina.*, 
                            ROW_NUMBER() OVER (PARTITION BY disciplina.unico ORDER BY disciplina.data DESC) AS row_num
                        FROM disciplina
                        INNER JOIN ciclo ON ciclo.id_ciclo = disciplina.id_ciclo
                        WHERE disciplina.id_ciclo = $cicloDoAnoLetivo
                    ) AS d
                    WHERE d.row_num = 1
                ");
                foreach ($arrDisciplinas as $disciplina) {
                    ?>
                    <div class="disciplina-group mb-3" style = "border: 2px solid <?php echo $disciplina['cor'];?>; 
    border-radius: 10px;">
                        <h6 style="cursor: pointer;" class="toggle-periodos" data-toggle-target="disciplina-<?php echo $disciplina['unico']; ?>">
                            <?php echo $disciplina['disciplina']; ?>
                            <i class="bi bi-chevron-down"></i> <!-- Ícone da seta -->
                        </h6>
                        <div id="disciplina-<?php echo $disciplina['unico']; ?>" class="periodos-container" style="display: none;">
                            <?php for ($periodo = 1; $periodo <= 3; $periodo++) { ?>
                                <div class="periodo-item">
                                    <label for="disciplina_<?php echo $disciplina['unico']; ?>_periodo_<?php echo $periodo; ?>" class="form-label">
                                        <?php echo "Período {$periodo}"; ?>
                                    </label>
                                    <select class="form-select" id="disciplina_<?php echo $disciplina['unico']; ?>_periodo_<?php echo $periodo; ?>" name="disciplina_<?php echo $disciplina['unico']; ?>_periodo_<?php echo $periodo; ?>" required>
                                        <option value="">Selecione a avaliação</option>
                                        <?php
                                        if (isset($legendasPorCiclo[$cicloDoAnoLetivo])) {
                                            foreach ($legendasPorCiclo[$cicloDoAnoLetivo] as $nota => $legenda) {
                                                $selected = ($nota == $nota_atual) ? 'selected' : '';
                                                echo '<option value="' . $nota . '" ' . $selected . '>' . $legenda . '</option>';
                                            }
                                        } else {
                                            for ($nota = 0; $nota <= 10; $nota++) {
                                                $selected = ($nota == $nota_atual) ? 'selected' : '';
                                                echo '<option value="' . $nota . '" ' . $selected . '>' . $nota . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary me-2">Guardar</button>
            </div>
        </form>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        // Toggle arrow icon and collapse on header click
        $('.anoletivo-header').click(function () {
            $(this).find('.arrow-icon').toggleClass('collapsed');
            $($(this).data('target')).collapse('toggle');
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const toggleDisciplinas = document.querySelectorAll('.toggle-disciplinas');
        const togglePeriodos = document.querySelectorAll('.toggle-periodos');

        toggleDisciplinas.forEach(btn => {
            btn.addEventListener('click', function () {
                const targetId = this.getAttribute('data-toggle-target');
                const target = document.getElementById(targetId);
                if (target.style.display === 'none') {
                    target.style.display = 'block';
                } else {
                    target.style.display = 'none';
                }
            });
        });

        togglePeriodos.forEach(btn => {
            btn.addEventListener('click', function () {
                const targetId = this.getAttribute('data-toggle-target');
                const target = document.getElementById(targetId);
                if (target.style.display === 'none') {
                    target.style.display = 'block';
                } else {
                    target.style.display = 'none';
                }
            });
        });
    });
</script>
