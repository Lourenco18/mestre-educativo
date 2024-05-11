<?php
if(isset($_GET['pagina'])){
    $pagina = $_GET['pagina'];
  }else{
    $pagina = "";
  };

$pagina = strtolower($pagina);

if($page_name == 'index.php') {
    $pagina = "";
    $cards = "";
}else{
    $cards = "and particao = '$pagina'";

};

    $arrResultados = my_query('SELECT * FROM operacao WHERE ativo = 1 '. $cards.'  AND id_operacao IN (' . $_SESSION['permissoes'] . ') ' );


    foreach($arrResultados as $k => $v) {

        echo '
            <div class="col" >
            <a href="'.$v['link'].'?pagina='.$v['operacao'].'&especificacao='.$v['tipo_form'].'&display='.$v['display'].'&id='.$v['id_operacao'].'&tipo='.$v['particao'].'">
                <div class="card h-70 ps-0 py-xl-3" style="background-color: white; transition: all 0.3s ease;" onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff\'; this.style.zIndex=\'1\';" onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">    
                        <div class="card-body" style="text-align: center;height: 231.599258px;  margin-left: 0px">
                            <h5 class="card-title">'.$v['display'].'</h5>
                            <img class="icons" src="'.$arrConfig['url_icons'].'/'.$v['foto_operacao'].'" alt="" height="100">
                        </div>
                    </div>
                </a>
            </div>';
    };


   