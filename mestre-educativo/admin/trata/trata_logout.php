<?php
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';

unset($_SESSION['login']);
session_destroy();

//var_dump($_SESSION);
//die;

header('Location: '.$arrConfig['url_login'].'/login.php');
exit();