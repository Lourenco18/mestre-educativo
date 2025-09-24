<?php 
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
$pass = $_GET['pass'];
$pass_confirmation = $_GET['pass_confirmation'] ?? '';
$id_colaborador= $_GET['id_colaborador'] ?? '';

$minCaracteres = 6;
$maxCaracteres = 16;

if(verfpass($pass, $minCaracteres, $maxCaracteres) && $pass == $pass_confirmation ) {
   
$new_pass = "UPDATE colaborador
   SET password = md5($pass)
   WHERE id_colaborador = $id_colaborador";
my_query($new_pass);
header('Location: '.$arrConfig['url_login'].'/login.php');

   
    
} else {
     $message_error_pass = "As palavras-passes não cumprem os requisitos";
     header('Location: update-password.php?message_error_pass='.$message_error_pass . '&name=' . $name . '&email=' . $email . '&pass=' . $pass. '&id_colaborador=' . $id_colaborador . '&pass_confirmation=' . $pass_confirmation);  

   
 }

