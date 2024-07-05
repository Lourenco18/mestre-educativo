<?php

if(isset($_GET['tipo'])){
  $backoffice = $_GET['tipo'];  }
// Convertendo o nome da página para minúsculas
$pagina = strtolower($pagina);

$tipo = $pagina;

// Definir a categoria removendo o último "s" da palavra
$tabela = rtrim($pagina, "s");

include $arrConfig['dir_admin'] . '/information/consultas.inc.php';
include $arrConfig['dir_admin'] . '/information/detail-information.inc.php';
// Verificar se a página está presente no array de consultas

if (array_key_exists($pagina, $consultas)) {
  // Definir a consulta SQL
 
  $consulta = $consultas[$pagina];
  $tipo = $pagina;

  // Definir a categoria removendo o último "s" da palavra
  $tabela = rtrim($pagina, "s");

  // Executar a consulta SQL
  $arrResultados = my_query($consulta);

  if ($tabela == 'alunoinative' || $tabela == 'myaluno' || $tabela == 'alunoremoved') {
    $tabela = 'aluno';

  } elseif ($tabela == 'professor' || $tabela == 'admin' || $tabela == 'supra_admin' || $tabela == 'motorista') {
    $tabela = 'colaborador';
  }
  if (strpos($tabela, "removed") !== false) {
    $tabela = preg_replace("'removed'", "", $tabela);
} else {
    
}
  // Mostrar os resultados
 
  foreach ($arrResultados as $k => $v) {
 
    $id = $v['id_' . $tabela];
    $id_unico = my_query('SELECT unico, id_' . $tabela . ' FROM ' . $tabela . ' WHERE id_' . $tabela . ' = ' . $id . '');
    if(isset($id_unico)) {
      $id_unico = $id_unico[0]['unico'];
    }
    
    if (count($arrResultados) == 0) {
      echo 'Não existem registos';


    } else {

   
      // Se a página for "Encarregados de Educação"
      if ($pagina == "encarregadoeducacao") {
        // Obter os educandos deste encarregado
        $arrEducandos = my_query('SELECT id_aluno, aluno FROM aluno WHERE id_encarregadoeducacao = ' . $v['id_encarregadoeducacao']);
        foreach ($arrEducandos as $s => $t) {
          // Inicializar um array para armazenar os id's de cada educando
          $arrOrientadores[$t['id_aluno']] = array();

          // Obter o orientador de cada educando
          $result = my_query('SELECT * FROM aluno INNER JOIN colaborador ON colaborador.id_colaborador = aluno.id_orientador WHERE id_aluno = ' . $t['id_aluno']);

          // Adicionar o orientador ao array de orientadores dos educandos
          foreach ($result as $orientador) {
            $arrOrientadores[$t['id_aluno']][] = $orientador;
          }
        }
      }

      // Exibir os resultados
      echo '
      <div class="col">';

      $id = $v['id_' . $tabela];

      echo '<a href="" class="card-link">';
      echo '<div class="card h-70 ps-0 py-xl-3" style=" background-color: white; transition: all 0.3s ease;" onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff\'; this.style.zIndex=\'1\';" onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">';
      echo '<div class="card-body" style="text-align: center; margin-left: 0px">';
      if($tabela == 'pagamento'){
        echo '<h5 class="card-title">' . $v['servicoaluno'] . '</h5><br>';
        
      }elseif($tabela == 'presenca'){
        $aluno000 = my_query('WITH AlunoRecente AS (
    SELECT 
        
        aluno.aluno,
        aluno.unico,
        
        ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
    FROM 
        aluno
    WHERE
        aluno.ativo = 1 
)    SELECT AlunoRecente.aluno as nome , AlunoRecente.unico FROM AlunoRecente WHERE AlunoRecente.unico = '.$v['id_aluno']);
        $aluno = $aluno000[0]['nome'];
        echo '<h5 class="card-title">' . $aluno . '</h5><br>';

      }else{
        echo '<h5 class="card-title">' . $v[$tabela] . '</h5><br>';

      }
      
     

      // Verificações específicas para cada categoria
      if (isset($information[$tabela])) {
        $info = $information[$tabela];
        foreach ($info as $titulo => $valor) {
          echo '<h6 class="card-title">' . $titulo . ': ';
          if ($valor == 'aluno') {
            $totalAlunos = count($arrEducandos);
            $count = 0;
            foreach ($arrEducandos as $s => $t) {
              $count++;
              echo $t[$valor];
              if ($count == $totalAlunos - 1) {
                echo ' e ';
              } elseif ($count < $totalAlunos) {
                echo ', ';
              }
            }
          } else {
            echo $v[$valor];
          }
          echo '</h6>';
        }
      }
      // se tem foto ou não 
      $verf_foto = false;
      if (isset($arrResultados[$k]['foto_' . $tabela])) {
        $verf_foto = true;


      }
      // Exibir a foto, se existir


      if ($verf_foto) {
        $foto = $arrResultados[$k]['foto_' . $tabela];
        include $arrConfig['dir_admin'] . '/fotos.inc.php';
        echo ' <td><img class="icons"  src="' . $src . ' height="100" width="100"></td>';
      } else {
        $foto = '';
      }
      




      // Botões de ação
      echo '<div class="d-grid gap-1 mt-3">';
      if ($_SESSION['userCargo'] == 'admin' || $_SESSION['userCargo'] == 'supra_admin') {
    
      
        if ($tabela !== 'pagamento' && $pagina !== 'alunoremoved' && $pagina !== 'alunoinative' && strpos($pagina, "removed") == false) {
          echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=' . $tipo . '&especificacao=editar" class="btn btn-primary"><i class="bx bx-pencil"></i> Editar</a>';
        } else {

        }
        if (strpos($pagina, 'removed') !== false|| $tabela == 'colaborador' && $v['cargo'] == 'supra_admin') {

        } else {
          if($tabela == 'pagamento'){

          }else{
            echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopRemove' . $v['id_' . $tabela] . '"><i class="bx bx-trash"></i> Remover</button>';
          }
          
        }
        if (strpos($pagina, 'removed') !== false){
          echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopNullRemove3"><i class="bx bx-x-circle"></i> Desfazer remoção</button>';
        }

        if ($pagina == 'alunoinative') {
          echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;"data-bs-toggle="modal" data-bs-target="#modalTopAtive' . $v['id_' . $tabela] . '"><i class="bx bx-block"></i> Ativar</button>';
        } elseif ($pagina == 'aluno') {
          
          echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;"data-bs-toggle="modal" data-bs-target="#modalTopDesative' . $v['id_' . $tabela] . '"><i class="bx bx-block"></i> Desativar</button>';
          if ($pagina == 'operacao' || $tabela == 'turma') {

          } else {
            echo '<button class="btn btn-primary" type="button" style="background-color: #0083FF; border-color: #0083FF"; data-bs-toggle="modal" data-bs-target="#modalTopADDservice' . $v['id_' . $tabela] . '"><i class="bx bx-file-blank"></i> Adicionar Serviço</button>';
          }
          if ($tabela == 'aluno' || $tabela == 'colaborador' || $tabela == 'encarregadoeducacao' || $tabela == 'escola') {
            
          }
        }

      }elseif($pagina == "myaluno"){
        date_default_timezone_set('Europe/Lisbon');
        $hj = new DateTime();
        $hoje = $hj->format('Y-m-d');
        $arrpresenca = my_query('SELECT * FROM presenca WHERE id_aluno = '.$v['unico'].' AND data = "'.$hoje.'"');  
     
        if(!empty($arrpresenca) ){

        }else{
          echo '<a href="'.$arrConfig['url_trata'].'/trata-presenca.php?id=' . $v['unico_aluno'] . '&data='.$hoje.'&tabela=presenca&acao=marcar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" class="btn " style="color: #ffff;background-color: #3D8F42; border-color: #3D8F42;">  <i class="bx bx-check"></i>Marcar presença dia<br> '.$hoje.'</a>';
        }
          
        
      }
      echo '</div>';



      echo '</div>';
      echo '</div>';


      echo '</a>';
      echo '</div>';
   

    }
    include $arrConfig['dir_admin'] . '/modal/modal-remove-remake.php';
    include $arrConfig['dir_admin'] . '/modal/modal-desative-ative.php';
    include $arrConfig['dir_admin'] . '/modal/modal-service.php';
   



  }



} else {
  // Se a página não for encontrada no array de consultas
  echo "Página não encontrada!";
}




echo '</div>';
echo '</div>';


// Tabela alternativa
if(strpos($pagina, "removed") == false && $backoffice !== 'backoffice' && strpos($pagina, "inative") == false){
  echo '
    <div id="tableView" style="display: none; ">';
}


    echo'
<table id="table"  class="table table-striped " style=" padding:24px; width:100%">
<thead>
  <tr>';
  echo '<th>'.$display.'</th>';
if ($verf_foto) {
  echo '<th class="fp_box">Foto</th>';
}

// Verificações específicas para cada categoria
if (isset($information[$tabela])) {
  $info = $information[$tabela];
  foreach ($info as $titulo => $valor) {
    echo '<th>' . $titulo . '</th>';
  }
}

echo '<th>Ações</th>
  </tr>
</thead>
<tbody>';


foreach ($arrResultados as $k => $v) {
  $id = $v['id_' . $tabela];
  $id_unico = $v['unico'];
  echo ' <tr>
   ';
   echo '<td>'.$v[$tabela].'</td>';
  // Exibir a foto, se existir

  if ($verf_foto) {
    $foto = $arrResultados[$k]['foto_' . $tabela];
    include $arrConfig['dir_admin'] . '/fotos.inc.php';
    echo ' <td><img class="icons"  src="' . $src . ' height="100" width="100"></td>';
  }
  ;


  if (isset($information[$tabela])) {
    $info = $information[$tabela];
    $count = 0;
   
    foreach ($info as $titulo => $valor) {

      if ($valor == 'aluno') {
        echo '<td style= "white-space: nowrap;">';
        $totalAlunos = count($arrEducandos);
        foreach ($arrEducandos as $s => $t) {
          $count++;

          echo $t[$valor];
          if ($count == $totalAlunos - 1) {
            echo ' e ';
          } elseif ($count < $totalAlunos) {
            echo ', ';
          }
        }
        echo '</td>';
      } else {
        echo '<td style= "white-space: nowrap;">' . $v[$valor] . '</td>';
      }
    }
  }


  echo '
    <td>
   ';
  echo '<div class="d-grid gap-1 mt-3">';
  if ($_SESSION['userCargo'] == 'admin' || $_SESSION['userCargo'] == 'supra_admin') {
    echo '<div class="btn-group">';



    $id = $v['id_'.$tabela].'a';
   
    if ($tabela !== 'pagamento' && $pagina !== 'alunoremoved' && $pagina !== 'alunoinative' && strpos($pagina, "removed") == false) {
      echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=' . $tipo . '&especificacao=editar" class="btn btn-primary" title="Editar"><i class="bx bx-pencil"></i></a>';
    } else {

    }
    if (strpos($pagina, 'removed') !== false|| $tabela == 'colaborador' && $v['cargo'] == 'supra_admin') {

    } else {
      if($tabela == 'pagamento'){} else {
      echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopRemove' . $v['id_' . $tabela] . 'a" title="Remover"><i class="bx bx-trash"></i></button>';
      }
    }
    if (strpos($pagina, 'removed') !== false){
      echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopNullRemove' . $v['id_' . $tabela] . 'a"><i class="bx bx-x-circle"></i> Desfazer remoção</button>';
    }

    if ($pagina == 'alunoinative') {
      echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;" data-bs-toggle="modal" data-bs-target="#modalTopAtive' . $v['id_' . $tabela] . 'a" title="Ativar"><i class="bx bx-check"></i> Ativar</button>';
    } elseif ($pagina == 'aluno') {
      
      echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;" data-bs-toggle="modal" data-bs-target="#modalTopDesative' . $v['id_' . $tabela] . 'a" title="Desativar"><i class="bx bx-block"></i></button>';
      if ($pagina == 'operacao' || $tabela == 'turma') {

      } else {
        echo '<button class="btn btn-primary" type="button" style="background-color: #0083FF; border-color: #0083FF" data-bs-toggle="modal" data-bs-target="#modalTopADDservice' . $v['id_'.$tabela] . 'a" title="Adicionar Serviço"><i class="bx bx-file-blank"></i></button>';
      }
      if ($tabela == 'aluno' || $tabela == 'colaborador' || $tabela == 'encarregadoeducacao' || $tabela == 'escola') {
       
      }
    }




    echo '</div>';
  
  }elseif($pagina == "myaluno"){
    date_default_timezone_set('Europe/Lisbon');
    $hj = new DateTime();
    $hoje = $hj->format('Y-m-d');
    $arrpresenca = my_query('SELECT * FROM presenca WHERE id_aluno = '.$v['unico'].' AND data = "'.$hoje.'"');  
  
    if(!empty($arrpresenca) ){

    }else{
      echo '<a href="'.$arrConfig['url_trata'].'/trata-presenca.php?id=' . $v['unico'] . '&data='.$hoje.'&tabela=presenca&acao=marcar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" class="btn " style="color: #ffff;background-color: #3D8F42; border-color: #3D8F42;">  <i class="bx bx-check"></i>Marcar presença dia<br> '.$hoje.'</a>';
    }
      
    
  }


  echo '</td>
  </tr>';
 

}

echo '</tbody>
</table>
</div>';


foreach ($arrResultados as $k => $v) {
  
echo '
<div class="modal modal-mid fade" id="modalTopRemove'.$v['id_' .$tabela].'a" tabindex="-1">
<div class="modal-dialog">
  <form class="modal-content">
    <div class="modal-header">
<h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer remover este ';
echo $tabela ;

echo '?</h5>
<button
  type="button"
  class="btn-close"
  data-bs-dismiss="modal"
  aria-label="Close"
></button>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
  Cancelar
</button>
<a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id= ' . $v['unico']+1 . '&tabela=' . $tabela . '&acao=apagar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" onclick="SwalSuccess()">Sim, quero remover</a>

</div>
</form>
</div>
</div>
';
echo '
<div class="modal modal-mid fade" id="modalTopNullRemove'.$v['id_' .$tabela].'a" tabindex="-1">
<div class="modal-dialog">
  <form class="modal-content">
    <div class="modal-header">
<h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer desfazer a remoção este ';
echo $tabela;

echo '?</h5>
<button
  type="button"
  class="btn-close"
  data-bs-dismiss="modal"
  aria-label="Close"
></button>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
  Cancelar
</button>
<a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id= ' . $v['id_' .$tabela] . '&tabela=' . $tabela . '&acao=ativar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" onclick="SwalSuccess()">Sim, quero desfazer a remoção</a>

</div>
</form>
</div>
</div>
';


if(isset($v['id_servicoaluno'])){
echo '
<div class="modal modal-mid fade" id="modalTopRemove'.$v['id_servicoaluno'].'a" tabindex="-1">
<div class="modal-dialog">
<form class="modal-content">
  <div class="modal-header">
<h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer remover este serviço ao aluno';


echo '?</h5>
<button
type="button"
class="btn-close"
data-bs-dismiss="modal"
aria-label="Close"
></button>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
Cancelar
</button>
<a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id= ' . $v['id_servicoaluno'] . '&tabela=servicoaluno&acao=apagar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" onclick="SwalSuccess()">Sim, quero remover</a>

</div>
</form>
</div>
</div>
';
}

 echo '
 <div class="modal modal-mid fade" id="modalTopDesative' . $v['id_' . $tabela] . 'a" tabindex="-1">
 <div class="modal-dialog">
   <form class="modal-content">
     <div class="modal-header">
 <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer desativar este ';
 echo $tabela;
 echo '?</h5>
 <button
   type="button"
   class="btn-close"
   data-bs-dismiss="modal"
   aria-label="Close"
 ></button>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
   Cancelar
 </button>
 <a type="button" style = "color = white;  background-color: orange;" class="btn btn-primary" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id= ' . $v['id_' .$tabela] . '&tabela=' . $tabela . '&acao=desativar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" onclick="SwalSuccess()">Sim, quero desativar</a>

 </div>
 </form>
 </div>
 </div>
 ';
 echo '
 <div class="modal modal-mid fade" id="modalTopAtive' . $v['id_' . $tabela] . 'a" tabindex="-1">
 <div class="modal-dialog">
   <form class="modal-content">
     <div class="modal-header">
 <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer Ativar este ';
 echo $tabela  ;

 echo '?</h5>
 <button
   type="button"
   class="btn-close"
   data-bs-dismiss="modal"
   aria-label="Close"
 ></button>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
   Cancelar
 </button>
 <a type="button" style = "color = white; background-color: orange" class="btn btn-primary" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id= ' . $v['id_' .$tabela] . '&tabela=' . $tabela . '&pagename=' . preg_replace("'&'","----", basename($current_page)) . '&acao=ativar" onclick="SwalSuccess()">Sim, quero Ativar</a>
 </div>
 </form>
 </div>
 </div>
 ';
}
if($tabela == 'aluno'){echo '
  <div class="modal modal-mid fade" id="modalTopADDservice' . $v['id_'.$tabela] . 'a" tabindex="-1">
  <div class="modal-dialog">'; $id_unicoa= $id_unico -1; echo'
    <form class="modal-content" action="' . $arrConfig['url_trata'] . '/trata-servico.php?id= ' . $id_unicoa . '&tabela=servico&acao=adicionar&pagename=' . preg_replace("'&'","----", basename($current_page)). '" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
  <h5 class="modal-title" id="modalTopTitle">Adicionar serviço</h5>
  <div class="modal-body" style="max-height: 800px; overflow-y: auto;">';




$servicos = my_query($consultas['servico']);

// Fetch services already assigned to the student
$arrServicos = my_query("SELECT id_servico FROM servicoaluno WHERE id_aluno = $id_unicoa AND removed = 0");

// Extract ids of assigned services
$assignedServiceIds = array_map(function($servico) {
    return $servico['id_servico'];
}, $arrServicos);

// Iterate over all services and display only those not assigned to the student
foreach ($servicos as $servico):
    if (!in_array($servico['id_servico'], $assignedServiceIds)): ?>
        <input type="checkbox" id="servico_<?php echo $servico['id_servico']; ?>" name="servico_ids[]" value="<?php echo $servico['id_servico']; ?>">
        <label for="servico_<?php echo $servico['id_servico']; ?>">
            <?php echo $servico['servico']; ?> - <?php echo $servico['valor']; ?>
        </label><br>
    <?php endif;
endforeach;



echo '</div>
 <button
   type="button"
   class="btn-close"
   data-bs-dismiss="modal"
   aria-label="Close"
 ></button>
 </div>

 <div class="modal-footer">
 <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
   Cancelar
 </button>
 <button type="submit" class="btn btn-primary me-2">Adicionar</button>

 </div>
 </form>
 </div>
 </div>
 ';
}
?>


<!-- Incluir CSS e JavaScript necessários para a tabela -->


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script>
  // Inicializar a tabela DataTable
  new DataTable('#table');
</script>