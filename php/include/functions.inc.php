<?php

// Função para imprimir um array formatado
function pr($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}


// Função para limpar nomes (substitui espaços por underscores e remove caracteres especiais)
function clean_name($string) {
    $string = str_replace(' ', '_', $string); // Remover espaços
    return preg_replace('/[^A-Za-z0-9\_.]/', '', $string); // Remover caracteres especiais
} 

// Função para verificar a validade da senha (comprimento dentro de um intervalo específico)
function verfpass($pass, $minCaracteres, $maxCaracteres) {
    $comprimentopass = strlen($pass);
    if (empty($pass)) {
        return false;
    } elseif ($comprimentopass < $minCaracteres || $comprimentopass > $maxCaracteres ) {
        return false;
    } else {
        return true;
    }
}

// Função para verificar a validade do email (formato válido)
function verfemail($email) {
    $email = trim($email);
    $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $email) ? true : false;
}

// Função para verificar a validade do email em relação ao banco de dados
function verfemail_general($email, $location, $pass, $message_error_pass, $message_error_email){
    if(verfemail($email)) {
        $query = "SELECT * FROM colaborador A INNER JOIN cargo B ON A.id_cargo = B.id_cargo WHERE A.ativo = 1 AND A.email_institucional = '$email'";
        $arrResultados = my_query($query);
        if(count($arrResultados) == 0){  
            $message_error_email = "Não existe nenhuma conta com este email";
            header('Location: '.$location.'?message_error_email='.$message_error_email . '&message_error_pass='.$message_error_pass. '&email=' . $email . '&pass=' . $pass);  
            exit();
        };
    } else {
        $message_error_email = "O email não é válido";
        header('Location: '.$location.'?message_error_email='.$message_error_email . '&message_error_pass='.$message_error_pass. '&email=' . $email . '&pass=' . $pass);  
        exit();
    }
}

// Função para registrar logs de eventos
function logs()
{
    $arrUrl = explode('/', $_SERVER['REQUEST_URI']);    
    $file = $arrUrl[count($arrUrl)-1];
    switch($file){
        case 'trata_login.php':
            $tipolog = 'login';
            break;
        case 'logout.php':
            $tipolog = 'logout';
            break;
        default:
            $tipolog = '';
    }
    $data= date('Y-m-d H:i:s');
    $url = $_SERVER['REQUEST_URI'];
    $iduser =isset($_SESSION['userID']) ? $_SESSION['userID'] :0;

    $ip = $_SERVER['REMOTE_ADDR'];
    $session = session_id();

    $query = "INSERT INTO log (datahora, url, tipo_log, idUser, ip, session) VALUES ('$data', '$url', '$tipolog', '$iduser', '$ip', '$session')";
    $result = my_query($query);
}

// Função para exibir um formulário de evento
function event_view($prefixo, $acao, $tituloBotao) {
    echo '
    <div id="edit_event" style ="display: none;">
      
        <form id="form'.$prefixo.'evento" method="POST" action="'.$acao.'">
            <div class="modal-body">
                <div class="mb-3 col-md-10">
                    <label class="form-label" for="'.$prefixo.'_title">Título</label>
                    <div class="input-group input-group-merge">
                        <input type="text" value = "'.$prefixo.'" id="'.$prefixo.'_title" name="'.$prefixo.'_title" class="form-control"/>
                    </div>
                </div>

                <div class="mb-3 col-md-15">
                    <label class="form-label" for="'.$prefixo.'_descricao">Descrição</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="'.$prefixo.'_descricao" name="'.$prefixo.'_descricao" class="form-control"/>
                    </div>
                </div>

                <div class="mb-3 col-md-3">
                    <label for="'.$prefixo.'_escola" class="form-label">Escola</label> 
                    <select id="'.$prefixo.'_escola" class="select2 form-select">
                        <option value="Feminino">Feminino</option>
                    </select>
                </div>

                <div class="mb-3 col-md-3">
                    <label for="'.$prefixo.'_turma" class="form-label">Turma</label> 
                    <select id="'.$prefixo.'_turma" class="select2 form-select">
                        <option value="Feminino">Feminino</option>
                    </select>
                </div>

                <div class="mb-3 col-md-10">
                    <label class="form-label" for="'.$prefixo.'_start">Data de início</label>
                    <div class="input-group input-group-merge">
                        <input type="datetime-local" id="'.$prefixo.'_start" name="'.$prefixo.'_start" class="form-control"/>
                    </div>
                </div>

                <div class="mb-3 col-md-10">
                    <label class="form-label" for="'.$prefixo.'_end">Data de Fim</label>
                    <div class="input-group input-group-merge">
                        <input type="datetime-local" id="'.$prefixo.'_end" name="'.$prefixo.'_end" class="form-control"/>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">'.$tituloBotao.'</button>
        </form>
    </div>';
}

// Função para gerar upload de arquivos
function gerar_upload($src, $buttonMsg, $type ){
    if($type == 'image'){
        $accept = 'image/png, image/jpeg, image/*,.svg';
        $permitido = 'JPG e PNG e SVG';
    }elseif($type == 'pdf'){
        $accept = 'application/pdf';
        $permitido = 'PDF';
    }
   echo'
    <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                  src="'.$src.'
                  class="d-block rounded"
                  height="100"
                  width="100"
                  id="uploadedAvatar"
                />
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    
                    <span class="d-none d-sm-block">'.$buttonMsg.'</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input
                      type="file"
                      id="upload"
                      class="account-file-input"
                      hidden
                      accept="'.$accept.'"
                      name = "'.$type.'"
                    />
                  </label>
                  <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Resetar</span>
                  </button>

                  <p class="text-muted mb-0">Permitido '.$permitido.'. </p>
                </div>
              </div>
            </div>

    ';
}

function mostrarFoto($verf_foto, $arrResultados,$k, $tabela){
    include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
    if ($verf_foto) {
        $foto = $arrResultados[$k]['foto_' . $tabela];
        include $arrConfig['dir_admin'] . '/fotos.inc.php';
        echo ' <td><img class="icons"  src="' . $src . ' height="100" width="100"></td>';
      }else{
        $foto= '';
      }
}

function unicooperacao($tabela){
    for ($x = 1; $x <= count(my_query('SELECT '.$tabela.' from '.$tabela.'')); $x++) {
        my_query('UPDATE '.$tabela.' SET unico = '.$x.' WHERE id_'.$tabela. '= '.$x.'');
    }
  
};



