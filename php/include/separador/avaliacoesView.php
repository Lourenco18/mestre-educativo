<?php
include $_SERVER['DOCUMENT_ROOT'] . '/mestre-educativo/php/include/config.inc.php';
include $arrConfig['dir_admin'].'/head.inc.php';



$arrCiclo = my_query("WITH CicloMaisRecente AS (
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
        where a.id_aluno = $id_aluno
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

$id_ciclo = $arrCiclo[0]['id_ciclo'];
$arrDisciplinas = my_query("SELECT * from disciplina INNER JOIN ciclo on ciclo.id_ciclo = disciplina.id_ciclo WHERE disciplina.id_ciclo = $id_ciclo");
$arravaliacao = my_query("SELECT * from avaliacao where id_aluno = $id_unico_aluno");

?>

<style>
table {
  
    border-collapse: collapse;
    width: 50%; /* Adjust this value to make the table smaller */
    max-width: 100%;
    margin: auto; /* Center the table */
    table-layout: auto; /* Adjust column width based on content */
}

th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: center;
    white-space: nowrap; /* Ensure no line breaks within cells */
}

thead th {
    background-color: #f2f2f2;
}
</style>

<?php
echo '
<div id="avaliacoesView" class="divisao" style="display: none;">
   <div class="card mb-3 px-md-4 ps-0" style="background-color: white">
<table style= "margin-top: 20px; margin-bottom: 20px;">
    <thead>
        <tr>
            <th>Periodos/semestres</th>';
            foreach ($arrDisciplinas as $k => $v) {
                $arrOrdemDisp[] = $v['id_disciplina'];
                echo' <th>'.$v['disciplina'].'</th>';
            }
    echo'</tr>
    </thead>
    <tbody>
        <tr>
            <td>1º</td>';
            
            for ($i = 0; $i < count($arrDisciplinas); $i++) {
                $avaliacao = my_query("SELECT * from avaliacao where id_disciplina = {$arrDisciplinas[$i]['id_disciplina']} and id_aluno = $id_unico_aluno and periodo = 1");
                echo'<th>'.$avaliacao[0]['avaliacao'].'</th>';
            }
          
        echo'</tr>
        <tr>
            <td>2º</td>';
           for ($i = 0; $i < count($arrDisciplinas); $i++) {
                $avaliacao = my_query("SELECT * from avaliacao where id_disciplina = {$arrDisciplinas[$i]['id_disciplina']} and id_aluno = $id_unico_aluno and periodo = 2");
                echo'<th>'.$avaliacao[0]['avaliacao'].'</th>';
            }
        echo'</tr>
        <tr>
            <td>3º</td>';
            for ($i = 0; $i < count($arrDisciplinas); $i++) {
                $avaliacao = my_query("SELECT * from avaliacao where id_disciplina = {$arrDisciplinas[$i]['id_disciplina']} and id_aluno = $id_unico_aluno and periodo = 3");
                echo'<th>'.$avaliacao[0]['avaliacao'].'</th>';
            }
        echo'</tr>
    </tbody>
</table>
</div>
</div>

';
?>