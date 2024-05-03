<?php

// Convertendo o nome da página para minúsculas
$pagina = strtolower($pagina);

// Incluindo informações de cada categoria
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

  if ($tabela == 'alunoinative' || $tabela == 'myaluno') {
    $tabela = 'aluno';
    $pagina = 'aluno';
  } elseif ($tabela == 'professor' || $tabela == 'admin' || $tabela == 'supra_admin') {
    $tabela = 'colaborador';
  }
  // Mostrar os resultados
  foreach ($arrResultados as $k => $v) {
   
     
 
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

      echo '<a href="vis_' . str_replace("s", '', $pagina) . '.php?id=' . $v['id_' . $tabela] . '" class="card-link">';
      echo '<div class="card h-70 ps-0 py-xl-3" style=" background-color: white; transition: all 0.3s ease;" onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff\'; this.style.zIndex=\'1\';" onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">';
      echo '<div class="card-body" style="text-align: center; margin-left: 0px">';
      echo '<h5 class="card-title">' . $v[$tabela] . '</h5><br>';


      // Verificações específicas para cada categoria
      if (isset($information[$pagina])) {
        $info = $information[$pagina];
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
    
          // Exibir a foto, se existir
     
      if(isset($arrResultados[$k]['foto_' . $tabela])){
        $foto = $arrResultados[$k]['foto_' . $tabela];
        include $arrConfig['dir_admin'] . '/fotos.inc.php';
        echo '<img class="icons"  src="'.$src.' height="100" width="100">';
      }else{
        $foto = '';  
      }
     
      
      
  

      // Botões de ação
      echo '<div class="d-grid gap-1 mt-3">';
      if ($_SESSION['userCargo'] == 'admin' || $_SESSION['userCargo'] == 'supra_admin') {
        echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=' . $tipo . '&especificacao=editar" class="btn btn-primary">  <i class="bx bx-pencil"></i> Editar</a>';
        if ($tabela == 'colaborador' && $v['cargo'] == 'supra_admin') {
          // Nada aqui, pois supra_admin não pode ser removido
        } else {
          echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopremove"><i class="bx bx-trash"></i> Remover</button>';
        }
        $id = $v['id_' . $tabela];
        if ($display == 'Alunos Inativos') {
          echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;"data-bs-toggle="modal" data-bs-target="#modalTopAtive"><i class="bx bx-block"></i> Ativar</button>';
        } else {
          echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;"data-bs-toggle="modal" data-bs-target="#modalTopDesative"><i class="bx bx-block"></i> Desativar</button>';
          if ($pagina == 'operacao' || $tabela == 'turma') {

          } else {
            echo '<button class="btn btn-primary" type="button" style="background-color: #0083FF; border-color: #0083FF"><i class="bx bx-file-blank"></i> Adicionar Serviço</button>';
          }
          if ($tabela == 'aluno' || $tabela == 'colaborador' || $tabela == 'encarregadoeducacao' || $tabela == 'escola') {
            echo '<a href="pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=email&especificacao=sendemail" class="btn " style="background-color: #3D8F42; border-color: #3D8F42;">  <i class="bx bx-envelope"></i> Envair E-mail</a>';
          }
        }
      }



      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</a>';

    }

  }


  include $arrConfig['dir_admin'] . '/modal.inc.php';
} else {
  // Se a página não for encontrada no array de consultas
  echo "Página não encontrada!";
}
echo '</div>';


// Tabela alternativa
echo '
<div id="tableView" style="display: none; text-align: center; padding-left: 262px;">
<table id="table"  class="table table-striped " style="  width: 100%; table-layout: fixed; ">
<thead>
  <tr>
    <th>Foto</th>';
// Verificações específicas para cada categoria
if (isset($information[$pagina])) {
  $info = $information[$pagina];
  foreach ($info as $titulo => $valor) {
    echo '<th>' . $titulo . '</th>';
  }
}

echo '<th>Ações</th>
  </tr>
</thead>
<tbody>';


foreach ($arrResultados as $k => $v) {

  echo ' <tr>
    <td>';
      // Exibir a foto, se existir
     
      if(isset($arrResultados[$k]['foto_' . $tabela])){
        
        $foto = $arrResultados[$k]['foto_' . $tabela];
        include $arrConfig['dir_admin'] . '/fotos.inc.php';
        echo '<img class="icons"  src="'.$src.' height="100" width="100">';
      }else{
        $foto = '';  
      } 
  
  echo '</td>';
  if (isset($information[$pagina])) {
    $info = $information[$pagina];
    $count = 0;
    foreach ($info as $titulo => $valor) {
     
        if ($valor == 'aluno') {
            echo '<td>';
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
            echo '<td>' . $v[$valor] . '</td>';
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
      echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopremove" title="Remover"><i class="bx bx-trash"></i></button>';
    }

    if ($display == 'Alunos Inativos') {
      echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;" data-bs-toggle="modal" data-bs-target="#modalTopAtive" title="Ativar"><i class="bx bx-block"></i></button>';
    } else {
      echo '<button class="btn btn-danger" type="button" style="background-color: orange; border-color: orange;" data-bs-toggle="modal" data-bs-target="#modalTopDesative" title="Desativar"><i class="bx bx-block"></i></button>';

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
}


echo '</tbody>
</table>
</div>';



?>

<!-- Incluir CSS e JavaScript necessários para a tabela -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script>
  // Inicializar a tabela DataTable
  new DataTable('#table');
</script>