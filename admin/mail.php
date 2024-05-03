<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require '../vendor/autoload.php';


function sendMail($username, $email, $id){
    include '../php/include/config.inc.php';
    
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
        $mail->AddEmbeddedImage(''.$arrConfig['dir_site'].'/imjs/logos/logo.png', 'logo');
    
        $mail->isHTML(true);                                  
        $mail->Subject = 'Recuperação de Palavra-Passe';
        $mail->Body    = '
        <div>
            <img src="cid:logo" alt="Logo" width="57" height="57" ><br>
            Olá <b>'.$username.',</b><br><br>
            Recebeste um email de verificação para recuperar a tua palavra-passe.<br>
            Clica no Link para Alterar a palavra-passe: <br><b><a>http://localhost/mestre-educativo/admin/update-password.php?id_colaborador='.$id.'</a></b>
            <style>
        </div>
        ';
        $mail->AltBody = 'Clica no Link para Verificar: http://localhost/mestre-educativo/admin/update-password.php?id_colaborador='.$id.'';
        $mail->send();
        $msg = 'Email enviado com sucesso';
        header('Location: '.$arrConfig['url_login'].'/login.php?msg='.$msg.'&location=admin/login/login');
} 



 