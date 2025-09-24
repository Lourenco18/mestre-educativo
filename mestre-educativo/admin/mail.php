<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
require $arrConfig['dir_site'].'/vendor/autoload.php';


function sendMail($username, $email, $id){
    include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
    
        $mail = new PHPMailer(true);
        
        $mail->SMTPDebug = 0;                                       
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->SMTPAuth   = true;                             
        $mail->Username   = 'mestreeducative@gmail.com';                 
        $mail->Password   = 'dxbg dtfk vdma fndl';                        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
     
        $mail->setFrom('mestreeducative@gmail.com', 'Mestre Educative');           
        $mail->addAddress($email, $username);
          
        $mail->CharSet =  'UTF-8';
        $mail->AddEmbeddedImage(''.$arrConfig['dir_imjs_upload'].'/logos/logo.png', 'logo');
    
        $mail->isHTML(true);                                  
        $mail->Subject = 'Recuperação de Palavra-Passe';
        $mail->Body    = '
        <div>
            <img src="cid:logo" alt="Logo" width="57" height="57" ><br>
            Olá <b>'.$username.',</b><br><br>
            Recebeste um email de verificação para recuperar a tua palavra-passe.<br>
            Clica no Link para Alterar a palavra-passe: <br><b><a>http://localhost/mestre-educativo/admin/login/update-password.php?id_colaborador='.$id.'</a></b>
            <style>
        </div>
        ';
        $mail->AltBody = 'Clica no Link para Verificar: http://localhost/mestre-educativo/admin/login/update-password.php?id_colaborador='.$id.'';
        $mail->send();
        $msg = 'Email enviado com sucesso';
        header('Location: '.$arrConfig['url_login'].'/login.php?msg='.$msg.'&location=admin/login/login.php');
} ;

function sendmailMensalidade($username, $email, $tipo, $servico, $data_fim, $data, $valor){
    include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
    if($tipo == 'mensalidade'){
        $title = 'Pagamento de Mensalidade';
        $corpo = 'O pagamento do(a) <strong>'.$servico.'</strong> com o valor de <strong>'.$valor.'€ </strong>já pode ser efetuado nas instalações do centro de estudos até <strong>'.$data_fim.'</strong>.<br><br><br>Obrigado,<br>Mestre Educative';
    }elseif($tipo == 'atividade'){
        $title = 'Inscrição numa atividade';
        $corpo = 'O seu educando foi inscrito na atividade "'.$servico.'", sendo realizada em '.$data.' e tendo um valor acrescentado de <strong>'.$valor.'€</strong> que pode ser pago até <strong>'.$data_fim.'</strong> nas instalações do centro de estudos.<br><br><br>Obrigado,<br>Mestre Educative';
    }
    $mail = new PHPMailer(true);
    
    $mail->SMTPDebug = 0;                                       
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'mestreeducative@gmail.com';                 
    $mail->Password   = 'dxbg dtfk vdma fndl';                        
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
 
    $mail->setFrom('mestreeducative@gmail.com', 'Mestre Educative');           
    $mail->addAddress($email, $username);
      
    $mail->CharSet =  'UTF-8';
    $mail->AddEmbeddedImage(''.$arrConfig['dir_imjs_upload'].'/logos/logo.png', 'logo');

    $mail->isHTML(true);                                  
    $mail->Subject = ''.$title.'';
    $mail->Body    = '
    <div>
        <img src="cid:logo" alt="Logo" width="57" height="57" ><br>
        Olá <b>'.$username.',</b><br><br>
       '.$corpo.'
        <style>
    </div>
    ';
    $mail->AltBody = '';
    $mail->send();
    $msg = 'Email enviado com sucesso';
    

};

function sendmailpago($username, $email, $tipo, $servico, $data, $data_fim, $valor_a_pagar, $valor_pago, $valor_total, $forma_pagamento ){
    include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
    if($valor_pago == $valor_total){
        $title = 'Pagamento total da mensalidade';
        $corpo = 'O pagamento do(a) ' . $servico . ' (<strong>' . $valor_total . '€</strong>) foi pago na totalidade.<br>Detalhes do pagamento:<br>Serviço: ' . $servico . '<br>Valor: <strong>' . $valor_pago . '€</strong><br>Data:' . $data . '<br>Método de pagamento:'.$forma_pagamento.'<br><br><br>Obrigado,<br>Mestre Educative';

    }else{
        $title = 'Pagamento parcial da mensalidade';
        $corpo = 'O pagamento do serviço ' . $servico . ' (<strong>' . $valor_total . '€</strong>) foi pago parcialmente a <strong>' . $data . '</strong>, ficando pendente um pagamento de <strong>' . $valor_a_pagar . '€</strong> que pode ser efetuado até ' . $data_fim . '</strong> nas instalações do centro de estudos.<br>Detalhes do pagamento:<br>Serviço: ' . $servico . '<br>Valor: ' . $valor_pago . '€<br>Data:' . $data . '<br><br><br>Obrigado,<br>Mestre Educative';

    }
   
    $mail = new PHPMailer(true);
    
    $mail->SMTPDebug = 0;                                       
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'mestreeducative@gmail.com';                 
    $mail->Password   = 'dxbg dtfk vdma fndl';                        
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
 
    $mail->setFrom('mestreeducative@gmail.com', 'Mestre Educative');           
    $mail->addAddress($email, $username);
      
    $mail->CharSet =  'UTF-8';
    $mail->AddEmbeddedImage(''.$arrConfig['dir_imjs_upload'].'/logos/logo.png', 'logo');

    $mail->isHTML(true);                                  
    $mail->Subject = ''.$title.'';
    $mail->Body    = '
    <div>
        <img src="cid:logo" alt="Logo" width="57" height="57" ><br>
        Olá <b>'.$username.',</b><br><br>
       '.$corpo.'
        <style>
    </div>
    ';
    $mail->AltBody = '';
    $mail->send();
    $msg = 'Email enviado com sucesso';
    

};

function sendMail1($username, $email, $titulo, $corpo){
    include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
    
        $mail = new PHPMailer(true);
        
        $mail->SMTPDebug = 0;                                       
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->SMTPAuth   = true;                             
        $mail->Username   = 'mestreeducative@gmail.com';                 
        $mail->Password   = 'dxbg dtfk vdma fndl';                        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
     
        $mail->setFrom('mestreeducative@gmail.com', 'Mestre Educative');           
        $mail->addAddress($email, $username);
          
        $mail->CharSet =  'UTF-8';
        $mail->AddEmbeddedImage(''.$arrConfig['dir_imjs_upload'].'/logos/logo.png', 'logo');
    
        $mail->isHTML(true);                                  
        $mail->Subject = ''.$titulo.'';
        $mail->Body    = '
        <div>
            <img src="cid:logo" alt="Logo" width="57" height="57" ><br>
            Olá <b>'.$username.',</b><br><br>
              '.$corpo.'<br><br><br>Obrigado,<br>Mestre Educative.
            
            <style>
        </div>
        ';
        $mail->AltBody = '';
        $mail->send();
        $msg = 'Email enviado com sucesso';
       
} ;




 