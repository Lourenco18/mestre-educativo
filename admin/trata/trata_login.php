<?php

include '../../php/include/config.inc.php';
$minCaracteres = 6;
$maxCaracteres = 16;
$email =$_GET['email'];
$pass = $_GET['pass'];
$message_error_email = '';
$message_error_pass = '';

$location = $arrConfig['url_login'].'/login.php';
verfemail_general($email, $location, $pass, $message_error_pass, $message_error_email);

$query ="SELECT * FROM colaborador A inner join cargo B on A.id_cargo = B.id_cargo WHERE A.ativo = 1 AND A.email_institucional = '$email' ";
$arrResultados = my_query($query);
if(count($arrResultados) > 0) {
   $password_hash = $arrResultados[0]['password'];

    if(verfpass($pass, $minCaracteres, $maxCaracteres) && md5($pass) == $password_hash) {
      
        $_SESSION['login']= 1;
        $_SESSION['userID'] = $arrResultados[0]['id_colaborador'];
        $_SESSION['userNome'] = $arrResultados[0]['nome'];
        $_SESSION['userCargo'] = $arrResultados[0]['cargo'];
        $_SESSION['userCargoID'] = $arrResultados[0]['id_cargo'];
        $_SESSION['userfoto'] = $arrResultados[0]['foto'];
        $arrPermissoes = my_query('SELECT * FROM permissao WHERE id_cargo = '.$_SESSION['userCargoID']);
        foreach($arrPermissoes as $k => $v) {
          
            $_SESSION['permissoes'] = implode(',', array_column($arrPermissoes, 'id_operacao'));
        }
     
        header('Location: '.$arrConfig['url_site'].'/index.php');
        logs();
  
    } else {
        $message_error_pass = "A palavra-passe está errada";
        header('Location: '.$arrConfig['url_login'].'/login.php?message_error_email='.$message_error_email . '&message_error_pass=' .$message_error_pass. '&email=' . $email . '&pass=' . $pass);  

        exit();
    }
}





