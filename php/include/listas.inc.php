
<?php

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
 
  } elseif ($tabela == 'professor' || $tabela == 'admin' || $tabela == 'supra_admin') {
    $tabela = 'colaborador';
  }
  // Mostrar os resultados

  foreach ($arrResultados as $k => $v) {
$id= $v['id_'.$tabela];
$id_unico =my_query('SELECT unico, id_'.$tabela.' FROM '.$tabela.' WHERE id_'.$tabela.' = '.$id.'');
$id_unico = $id_unico[0]['unico'];
    if (count($arrResultados) == 0) {
      echo 'Não existem registos';


    } else {

      echo '<div id="cardView">';
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
      echo '<h5 class="card-title">' . $v[$tabela] . '</h5><br>';

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

       mostrarFoto($verf_foto, $arrResultados,$k, $tabela);




      // Botões de ação
      echo '<div class="d-grid gap-1 mt-3">';
      if ( $_SESSION['userCargo'] == 'admin' || $_SESSION['userCargo'] == 'supra_admin') {
       
        if($pagina !== 'alunoremoved' && $pagina !== 'alunoinative' ){
          echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=' . $tipo . '&especificacao=editar" class="btn btn-primary"><i class="bx bx-pencil"></i> Editar</a>';
        }else{
        
        }
        if ($tabela == 'colaborador' && $v['cargo'] == 'supra_admin' ) {
         
        } else {
          echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopRemove'.$v['id_'.$tabela].'"><i class="bx bx-trash"></i> Remover</button>';
        }
       
     
        if ($pagina == 'alunoinative') {
          echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;"data-bs-toggle="modal" data-bs-target="#modalTopAtive'.$v['id_'.$tabela].'"><i class="bx bx-block"></i> Ativar</button>';
        } elseif($pagina == 'aluno') {
          echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;"data-bs-toggle="modal" data-bs-target="#modalTopDesative'.$v['id_'.$tabela].'"><i class="bx bx-block"></i> Desativar</button>';
          if ($pagina == 'operacao' || $tabela == 'turma') {

          } else {
            echo '<button class="btn btn-primary" type="button" style="background-color: #0083FF; border-color: #0083FF"><i class="bx bx-file-blank"></i> Adicionar Serviço</button>';
          }
          if ($tabela == 'aluno' || $tabela == 'colaborador' || $tabela == 'encarregadoeducacao' || $tabela == 'escola') {
            echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=email&especificacao=sendemail" class="btn " style="color: #ffff;background-color: #3D8F42; border-color: #3D8F42;">  <i class="bx bx-envelope"></i> Envair E-mail</a>';
          }
        }
     
      }
      echo '</div>';


  
      echo '</div>';
      echo '</div>';
  

      echo '</a>';
      echo '</div>';
      echo '</div>';

    }
   include $arrConfig['dir_admin'] . '/modal/modal-remove-remake.php';
   include $arrConfig['dir_admin'] . '/modal/modal-desative-ative.php';

  }



} else {
  // Se a página não for encontrada no array de consultas
  echo "Página não encontrada!";
}
echo '</div>';






// Tabela alternativa
echo '
<div id="tableView" style="display: none; text-align: center; padding-left: 0px;">
<table id="table"  class="table table-striped " style="  
border-collapse: collapse; width: 100%; table-layout: fixed; width: 100%;
border-collapse: collapse; ">
<thead>
  <tr>';
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
  echo ' <tr>
   ';
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
    echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=' . $tipo . '&especificacao=editar" class="btn btn-primary" title="Editar"><i class="bx bx-pencil"></i></a>';
    if ($tabela == 'colaborador' && $v['cargo'] == 'supra_admin') {
    } else {
      echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopremove'.$v['id_'.$tabela].'" title="Remover"><i class="bx bx-trash"></i></button>';
    }

    if ($display == 'Alunos Inativos') {
      echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;" data-bs-toggle="modal" data-bs-target="#modalTopAtive'.$v['id_'.$tabela].'" title="Ativar"><i class="bx bx-block"></i></button>';
    } else {
      echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;" data-bs-toggle="modal" data-bs-target="#modalTopDesative'.$v['id_'.$tabela].'" title="Desativar"><i class="bx bx-block"></i></button>';

      if ($pagina != 'operacao' && $tabela != 'turma') {
        echo '<button class="btn btn-primary" type="button" style="background-color: #0083FF; border-color: #0083FF" title="Adicionar Serviço"><i class="bx bx-file-blank"></i></button>';
      }

      if ($tabela == 'aluno' || $tabela == 'colaborador' || $tabela == 'encarregadoeducacao' || $tabela == 'escola') {
        echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=email&especificacao=sendemail" class="btn" style="background-color: #3D8F42; border-color: #3D8F42;" title="Enviar E-mail"><i class="bx bx-envelope"></i></a>';
      }
    }
    echo '</div>';
  }

  echo '</td>
  </tr>';
  include $arrConfig['dir_admin'] . '/modal/modal-remove-remake.php';
  include $arrConfig['dir_admin'] . '/modal/modal-desative-ative.php';
}


echo '</tbody>
</table>
</div>';



?>

<!-- Incluir CSS e JavaScript necessários para a tabela -->


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script>
  // Inicializar a tabela DataTable
  




    var table = $('#table').DataTable( {
    columnDefs: [
        { targets: [0],  width: '10%'},
        //{ targets: '_all', visible: false }
    ]
} );
</script>