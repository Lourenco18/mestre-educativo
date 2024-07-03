<?php

?>
<div class="card mb-3 px-md-4 ps-0" style="background-color: white">
    <div id="pagamentosView" class="divisao" style="display: none;">
        <div class="row row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3"
            style="padding: 20px;">
            <?php
            $servico_information = my_query('SELECT * from servicoaluno inner join servico on servico.id_servico = servicoaluno.id_servico where servicoaluno.id_aluno = ' . $id_unico_aluno . '');
            $soma_valor_pago = 0;
            $soma_valor = 0;
            $soma_valor_a_pagar = 0;
            echo ' <h3 >Pagamentos</h3>';
            echo '  <table class="table">
                                <thead>
                                <tr>
                                    <th>Serviço</th>
                                    <th>Dta</th>
                                    <th>Dta fim do pagamento</th>
                                    <th>Valor total</th>
                                    <th>Valor pago</th>
                                    <th>Valor a pagar</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">';
            foreach ($servico_information as $t => $k) {
                echo '<tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $k['servico'] . '</strong></td>
                                    <td>' . $k['data'] . '</td>
                                    <td>' . $k['data_fim'] . '</td>
                                    <td>' . $k['valor'] . ' €</td>
                                    <td style= "color: green">' . $k['valor_pago'] . ' €</td>
                                    <td style= "color: red">' . $k['valor_a_pagar'] . ' €</td>';

                echo ' </tr>';
                $soma_valor_pago = $soma_valor_pago + $k['valor_pago'];
                $soma_valor = $soma_valor + $k['valor_pago'];
                $soma_valor_a_pagar = $soma_valor_a_pagar + $k['valor_a_pagar'];

            }
            echo '<tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Total</strong></td>
                                    <td>-----</td>
                                    <td>-----</td>
                                    <td>' . $soma_valor_pago . ' €</td> 
                                    <td style= "color: green">' . $soma_valor_pago . ' €</td>
                                    <td style= "color: red">' . $soma_valor_a_pagar . ' €</td>';

            echo ' </tr>';

            echo '</tbody>
                            </table>';
            echo '<br>';
            ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalpagamentos">
                Editar pagamentos
            </button><br><br>
        </div>
    </div>
</div>

<div class="modal fade" id="modalpagamentos" tabindex="-1" aria-labelledby="modalTopTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content"
            action="<?php echo $arrConfig['url_trata'] ?>/trata-servico.php?pagename=<?php echo $page_name; ?>&id=<?php echo $id_unico_aluno; ?>&tabela=pagamento&acao=editar"
            method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTopTitle">Editar Pagamentos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
           
                foreach ($servico_information as $t => $k) {
                    if($k['valor_a_pagar'] != 0){
                        echo '<h5>' . $k['servico'] . '- ' . $k['valor'] . '€</h5>';
                        echo '<button type="button" class="btn btn-secondary" onclick="document.getElementById(\'form-' . $k['id_servico'] . '\').style.display=\'block\'">Editar valor pago</button><br>';
                        echo '<br><div id="form-' . $k['id_servico'] . '" style="display:none; margin-top: 10px;">';
                        echo '  <div class="mb-3">
                                    <label for="valor_pago_' . $k['id_servico'] . '" class="form-label">Valor Pago</label>
                                    <input type="number" max = "' . $k['valor'] . '"class="form-control" id="valor_pago_' . $k['id_servico'] . '" name="valor_pago[' . $k['id_servico'] . ']" value="' . $k['valor_pago'] . '">';?>
                                    <label for="metodo_pagamento_<?php echo $k['id_servico']; ?>" class="form-label">Método de Pagamento para</label>
                                    <select class="form-select" id="metodo_pagamento_<?php echo $k['id_servico']; ?>" name="metodo_pagamento[<?php echo $k['id_servico']; ?>]">
                                        <option value="Cartão de Crédito">Cartão de Crédito</option>
                                        <option value="Transferência Bancária">Transferência Bancária</option>
                                        <option value="Dinheiro">Dinheiro</option>
                                        
                                     </select>
                        <?php echo ' </div>';
                        echo '</div>';
                    }
                    
                }
                echo ' <input
                type="hidden"
                id="pagename"
                class="form-control"
                name="pagename"
                value="' . $page_name . '"
            />';

                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary me-2">Guardar</button>
            </div>
        </form>
    </div>
</div>