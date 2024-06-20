<?php
if(isset($_GET['pagina'])){
    $pagina = $_GET['pagina'];
  }else{
    $pagina = "";
  };

$pagina = strtolower($pagina);

if($page_name == 'index.php') {
    $pagina = "";
    $cards = "and pai = 1";
}else{
    $cards = "and particao = '$pagina'";

};

    $arrResultados = my_query('SELECT * FROM operacao WHERE ativo = 1 '. $cards.'  AND id_operacao IN (' . $_SESSION['permissoes'] . ') ' );


    foreach($arrResultados as $k => $v) {
      
       
    
 
        if(isset($pagina)){
          if( $page_name =='index.php'){
            $cor = $v['cor'];
            
          }else{
      ;
            if($v['particao'] == "turma" ){
              $particao = "escola";  
            }elseif($v['particao'] == "encarregadoeducacao"){
              $particao = "aluno";
            }elseif($v['particao'] == "professor" || $v['particao'] == "admin" || $v['particao'] == "supra_admin"){
              $particao = "colaborador";
            }elseif($v['particao'] == "motorista"){
              $particao = "transporte";
            }elseif(
              $v['particao'] == "disciplinas" ||
              $v['particao'] == "Anoletivo" ||
              $v['particao'] == "genero" ||
              $v['particao'] == "ano" ||
              $v['particao'] == "cargo" ||
              $v['particao'] == "ciclo" ||
              $v['particao'] == "cidade" ||
              $v['particao'] == "colaborador" ||
              $v['particao'] == "conjunto" ||
              $v['particao'] == "distrito" ||
              $v['particao'] == "especialidade" ||
              $v['particao'] == "evento" ||
              $v['particao'] == "formacao" ||
              $v['particao'] == "localidade" ||
              $v['particao'] == "log" ||
              $v['particao'] == "nacionalidade" ||
              $v['particao'] == "nota" ||
              $v['particao'] == "pessoa" ||
              $v['particao'] == "relação" ||
              $v['particao'] == "statu" || $v['particao'] == "operacao" 
          ){
              $particao = "backoffice";
            }
              else{
              $particao = $v['particao'];
            };
            $cor = my_query('SELECT cor from operacao WHERE pai = 1 AND operacao = "'.$particao.'" ');
            $cor = $cor[0]['cor'];
          }
        
        }
      
    
        echo '
            <div class="col"  >
            <a  style="" href="'.$v['link'].'?pagina='.$v['operacao'].'&especificacao='.$v['tipo_form'].'&display='.$v['display'].'&id='.$v['id_operacao'].'&tipo='.$v['particao'].'">
                <div class="card h-70 ps-0 py-xl-3" style="border: 2px solid '.$cor.'; border-radius: 8px; background-color: white; transition: all 0.3s ease;" onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0' .$cor.', 0 6px 20px 0 '.$cor.'\'; this.style.zIndex=\'1\';" onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">    
                        <div class="card-body" style="  text-align: center;height: 231.599258px;  margin-left: 0px">
                            <h5 class="card-title">'.$v['display'].'</h5>
                            <img class="icons" src="'.$arrConfig['url_imjs_upload'].'/icons/'.$v['foto_operacao'].'" alt="" height="100">
                        </div>
                    </div>
                </a>
            </div>';
    };


   