<?php
@session_start();
global $arrConfig;



if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    
}

error_reporting(-1);
ini_set( 'display_errors', 1 );

$arrConfig['servername'] = 'localhost';
$arrConfig['username'] = 'root';
$arrConfig['password'] = '';
$arrConfig['dbname'] = 'mestre_educativo';

// isLoginKey - alterar a chave de codificação para o Backoffice
$arrConfig['isLoginKey'] = 'lourenco1978';

// acessos FrontOffice
$arrConfig['url_site']='http://localhost/mestre-educativo';
$arrConfig['dir_site']=$_SERVER['DOCUMENT_ROOT'].'/mestre-educativo';


$folderAdmin = 'admin';
$arrConfig['url_admin']=$arrConfig['url_site'].'/'.$folderAdmin;
$arrConfig['dir_admin']=$arrConfig['dir_site'].'/'.$folderAdmin;
// login
$folderLogin = 'login';
$arrConfig['url_login']=$arrConfig['url_admin'].'/'.$folderLogin;
$arrConfig['dir_login']=$arrConfig['dir_admin'].'/'.$folderLogin;
// trata
$folderTrata = 'trata';
$arrConfig['url_trata']=$arrConfig['url_admin'].'/'.$folderTrata;
$arrConfig['dir_trata']=$arrConfig['dir_admin'].'/'.$folderTrata;

$folderJS = 'js';
$arrConfig['url_js']=$arrConfig['url_site'].'/'.$folderJS;
$arrConfig['dir_js']=$arrConfig['dir_site'].'/'.$folderJS;

$folderCalender = 'calender';
$arrConfig['url_calender']=$arrConfig['url_site'].'/'.$folderCalender;
$arrConfig['dir_calender']=$arrConfig['dir_site'].'/'.$folderCalender;

$folderVendor = 'assets/vendor';
$arrConfig['url_vendor']=$arrConfig['url_site'].'/'.$folderVendor;
$arrConfig['dir_vendor']=$arrConfig['dir_site'].'/'.$folderVendor;


$folderDataTables = 'DataTables';
$arrConfig['url_DataTables']=$arrConfig['url_site'].'/'.$folderDataTables;
$arrConfig['dir_DataTables']=$arrConfig['dir_site'].'/'.$folderDataTables;


$folderPHP = 'php';
$arrConfig['url_php']=$arrConfig['url_site'].'/'.$folderPHP;
$arrConfig['dir_php']=$arrConfig['dir_site'].'/'.$folderPHP;

$folderinclude = 'include';
$arrConfig['url_include']=$arrConfig['url_php'].'/'.$folderinclude;
$arrConfig['dir_include']=$arrConfig['dir_php'].'/'.$folderinclude;

$folderNavbar = 'navbar';
$arrConfig['url_navbar']=$arrConfig['url_include'].'/'.$folderNavbar;
$arrConfig['dir_navbar']=$arrConfig['dir_include'].'/'.$folderNavbar;

// caminhos Docs e/ou fotografias UPLOAD
$arrConfig['url_imjs_upload']=$arrConfig['url_admin'].'/upload/imjs';
$arrConfig['dir_imjs_upload']=$arrConfig['dir_admin'].'/upload/imjs';

$arrConfig['url_documents_upload']=$arrConfig['url_admin'].'/upload/documents';
$arrConfig['dir_documents_upload']=$arrConfig['url_admin'].'/upload/documents';

$arrConfig['url_fotos_upload']=$arrConfig['url_imjs_upload'].'/fotos';
$arrConfig['dir_fotos_upload']=$arrConfig['dir_imjs_upload'].'/fotos';

// caminhos Docs e/ou fotografias
$arrConfig['url_imjs']=$arrConfig['url_site'].'/imjs';
$arrConfig['dir_imjs']=$arrConfig['dir_site'].'/imjs';

$arrConfig['url_fotos']=$arrConfig['url_imjs'].'/fotos';
$arrConfig['dir_fotos']=$arrConfig['dir_imjs'].'/fotos';

$folderIcon = 'icons';
$arrConfig['url_icons_upload']=$arrConfig['url_imjs_upload'].'/'. $folderIcon;
$arrConfig['dir_icons_ipload']=$arrConfig['dir_imjs_upload'].'/'. $folderIcon;

$arrConfig['fotos_auth'] = array ('image/jpeg', 'image/jpg', 'image/png', 'image/gif');
$arrConfig['fotos_maxUpload'] = 3000000;

$arrConfig['foto_empresa']='admin/upload/imjs/logos/logo.png';
   


// chamada de outros include
include_once 'functions.inc.php'; 
include_once 'db.inc.php'; 
include_once $arrConfig['dir_admin'].'/permissoes/config_permition.php'; 
include_once $arrConfig['dir_admin'].'/displayConfig.php'; 

$arrConfig['anoLetivo']= my_query("SELECT * from anoletivo where ativo =1 ");
$arrConfig['anoLetivo']= $arrConfig['anoLetivo'][0]['anoletivo'];



