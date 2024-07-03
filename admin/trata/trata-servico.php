<?php
include $arrConfig['dir_include'] . '/auth.inc.php';


include '../mail.php';
include $_SERVER['DOCUMENT_ROOT'] . '/mestre-educativo/php/include/config.inc.php';
$acao = $_GET['acao'] ?? '';
$id_unico_aluno = $_GET['id'] ?? '';
    //dados do encarregado de educação
$arrencarregado = my_query("SELECT id_encarregadoeducacao from aluno where unico = $id_unico_aluno ");
$id_encarregado = $arrencarregado[0]["id_encarregadoeducacao"];
$informationEE = my_query("SELECT encarregadoeducacao as nome_ee, email_encarregadoeducacao as email from encarregadoeducacao where unico = $id_encarregado");
$email = $informationEE[0]["email"];
$username = $informationEE[0]["nome_ee"];

if ($acao == "adicionar") {


   

    $tabela = $_GET['tabela'] ?? '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pagename = isset($_POST['pagename']) ? $_POST['pagename'] : '';

        $url = $arrConfig['url_site'] . '/' . $pagename;
        if (isset($_POST['servico_ids']) && is_array($_POST['servico_ids'])) {
            $servico_ids = $_POST['servico_ids'];
            for ($i = 0; $i < count($servico_ids); $i++) {
                //dados do serviço
                $id_servico = $servico_ids[$i];
                $servico_dados = 'SELECT *  from servico where id_servico = ' . $id_servico . '';
                $result = my_query($servico_dados);
                $data = $result[0]['data'];

                $valor_a_pagar = $result[0]['valor'];
                $data_fim = $result[0]['data_fim'];
                $nome_servico = $result[0]['servico'];
                $tipo = $result[0]['tipo'];
             
                //inserir na base de dados servico-aluno
                my_query('INSERT INTO servicoaluno (id_aluno, id_servico, pagamento, valor_pago, valor_a_pagar, data, data_fim) Values (' . $id_unico_aluno . ',' . $id_servico . ', 0, 0, ' . $valor_a_pagar . ', "' . $data . '", "' . $data_fim . '")');
                //enviar email 
                sendmailMensalidade($username, $email, $tipo, $nome_servico, $data_fim, $data, $valor_a_pagar);
            }

        } else {
            echo "Nenhum serviço foi selecionado.";
        }
    }


} else {
    
    // Verifica se a solicitação foi feita via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $pagename = isset($_POST['pagename']) ? $_POST['pagename'] : '';

        $url = $arrConfig['url_site'] . '/' . $pagename;
        $metodos_pagamento = isset($_POST['metodo_pagamento']) ? $_POST['metodo_pagamento'] : [];
    
       
        $valores_pagamentos = $_POST['valor_pago'];
    
        
        foreach ($metodos_pagamento as $id_servico => $metodo_pagamento) {
            
            $valor_pago = $valores_pagamentos[$id_servico];
    
           
            $servico_aluno = my_query("SELECT id_servicoaluno, valor_pago from servicoaluno WHERE id_servico = $id_servico  and id_aluno = $id_unico_aluno");
            $id_servico_aluno = $servico_aluno[0]["id_servicoaluno"];
            $valor_pago_anterior = $servico_aluno[0]["valor_pago"];
            $servico_dados = my_query("SELECT * from servico where id_servico = $id_servico");
            $valor_total = $servico_dados[0]["valor"];
            $valor_a_pagar = $valor_total - $valor_pago;
            $data_fim = $servico_dados[0]['data_fim'];
            $nome_servico = $servico_dados[0]['servico'];
            $tipo = $servico_dados[0]['tipo'];
            date_default_timezone_set('Europe/Lisbon');
            $data = date('d-m-Y H:i ');
         
           
            
       
            
            
      if($valor_pago != $valor_pago_anterior){
        sendmailpago($username, $email, $tipo, $nome_servico, $data, $data_fim, $valor_a_pagar, $valor_pago, $valor_total, $metodo_pagamento);
         my_query('UPDATE servicoaluno set valor_pago = ' . $valor_pago . ', valor_a_pagar = ' . $valor_a_pagar . ' where id_servico = ' . $id_servico . ' and id_aluno = ' . $id_unico_aluno . '');
         my_query ('INSERT INTO pagamento (id_servicoaluno, metodo, data, valor) VALUES ('.$id_servico_aluno.', "'.$metodo_pagamento.'", "'.$data.'", '.$valor_pago.' ) ');
        
      }
       
            
    
             
           
        }
    } else {
        
    }

    header('Location: ' . $url . '');
}
   
  



