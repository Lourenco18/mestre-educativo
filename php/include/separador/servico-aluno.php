<?php include $_SERVER['DOCUMENT_ROOT'] . '/mestre-educativo/php/include/config.inc.php';
include $arrConfig['dir_admin'] . '/head.inc.php'; 
include $arrConfig['dir_admin'] . '/end.inc.php'; ?>
<div class="card mb-3 px-md-4 ps-0" style="background-color: white">
    <div id="pagamentosView" class="divisao" style="display: block;">
        <div class="row row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3"
            style="padding: 20px;">
            <?php
        
       
        $servico_information = my_query("
            WITH AlunoRecente AS (
                SELECT 
                    aluno.unico,
                    aluno.foto_aluno,
                    aluno.id_aluno,
                    aluno.id_ano,
                    aluno.aluno,
                    aluno.id_turma,
                    aluno.id_escola,
                    aluno.id_orientador,
                    aluno.id_encarregadoeducacao,
                    aluno.id_ciclo,
                    aluno.data_nascimento_aluno,
                    aluno.data,
                    aluno.ativo,
                    ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
                FROM 
                    aluno
                WHERE
                    aluno.ativo = 1
            ),
            ServicoAlunoRecente AS (
                SELECT 
                    sa.*,
                    ROW_NUMBER() OVER (PARTITION BY sa.id_aluno ORDER BY sa.data DESC) AS rn
                FROM 
                    servicoaluno sa
                WHERE 
                    sa.id_servico = $id and sa.ativo = 1
            )
            SELECT 
                sa.*,
                ar.*,
                s.*
            FROM 
                ServicoAlunoRecente sa
            INNER JOIN 
                AlunoRecente ar ON ar.unico = sa.id_aluno AND ar.rn = 1
            INNER JOIN 
                servico s ON s.id_servico = sa.id_servico
            WHERE 
                sa.rn = 1
        ");
        
    
            $soma_valor_pago = 0;
            $soma_valor = 0;
            $soma_valor_a_pagar = 0;
            echo ' <h3 >Pagamentos do serviço</h3>';
            echo '  <table class="table">
                                <thead>
                                <tr>
                                    <th>Aluno</th>
                                    <th>Valor pago</th>
                                    <th>Valor a pagar</th>
                                    <th>Operações</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">';
            foreach ($servico_information as $t => $v) {
                
                echo '<tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $v['aluno'] . '</strong></td>
                    
                                
                                    <td style= "color: green">' . $v['valor_pago'] . ' €</td>
                                    <td style= "color: red">' . $v['valor_a_pagar'] . ' €</td>
                                    <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopRemove' . $v['id_servicoaluno'] . '"><i class="bx bx-trash"></i> Remover</button></td>';
                                    

                echo ' </tr>';
                $soma_valor_pago = $soma_valor_pago + $v['valor_pago'];
                $soma_valor = $soma_valor + $v['valor_pago'];
                $soma_valor_a_pagar = $soma_valor_a_pagar + $v['valor_a_pagar'];
            
           
               

            }
            echo '<tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Total</strong></td>
                                   
                                    
                                    <td style= "color: green">' . $soma_valor_pago . ' €</td>
                                    <td style= "color: red">' . $soma_valor_a_pagar . ' €</td>
                                    <td>-------</td>';

            echo ' </tr>';

            echo '</tbody>
                            </table>';
            echo '<br>';
           

            ?>
        </div>
    </div>
</div>
<?php
foreach ($servico_information as $t => $v) {
    include $arrConfig['dir_admin'] . '/modal/modal-remove-remake.php';
}
?>