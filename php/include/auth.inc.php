<?php

//var_dump($_SESSION);
//die("auth.inc.php");

if(!isset($_SESSION['login'])){
    if($_SESSION['login'] <> 1){
        header('Location: '.$arrConfig['url_login'].'/login.php');      
        exit;
    }
}

//  $_SESSION['userCargo']
