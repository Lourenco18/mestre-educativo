<?php

if ($foto != ''  ) {
    
    if ($tipo == 'operacao') {
        $src=  $arrConfig['url_icons_upload'] . '/' . $foto . '" alt="' .$tabela. ': ' . $v[$tabela] . '"';

    }else{
        $src = $arrConfig['url_fotos_upload'] . '/' . $tabela . '/' . $foto . '" alt="' . $tabela . ': ' . $v[$tabela] . '"';
    }

    
  } else{
    

    $arricons = my_query('SELECT operacao, foto_operacao FROM operacao WHERE ativo = 1 AND removed = 0 and operacao = "'.$tabela.' "');
  
    $icon = $arricons[0]['foto_operacao'];
 
    $src=  $arrConfig['url_icons_upload'] . '/' . $icon . ' "';
   
  }