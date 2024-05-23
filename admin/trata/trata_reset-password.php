<?php
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
include '../mail.php';

$email =$_POST['email'];
$pass = '';
$message_error_email = '';
$message_error_pass = '';
$location = 'forgot-password.php';
verfemail_general($email, $location, $pass, $message_error_pass, $message_error_email);
$user_dados = my_query("SELECT id_colaborador, nome, email_institucional FROM colaborador WHERE email_institucional = '$email'");
$username = $user_dados[0]['colaborador'];
$email = $user_dados[0]['email_institucional'];
$id = $user_dados[0]['id_colaborador'];
sendMail($username,  $email, $id);