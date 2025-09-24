<?php
echo '
<div id="tableView" style="display: none; text-align: center; padding-left: 262px;">
<table id="table"  class="table table-striped " style="  width: 100%; table-layout: fixed; ">
<thead>
  <tr>';
  if($verf_foto){
    echo '<th>Foto</th>';
  }
  
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
$id = $v['id_' . $tabela];
  echo ' <tr>
   ';
      // Exibir a foto, se existir
     
      if($verf_foto){
        $foto = $arrResultados[$k]['foto_' . $tabela];
        include $arrConfig['dir_admin'] . '/fotos.inc.php';
        echo ' <td><img class="icons"  src="'.$src.' height="100" width="100"></td>';
      };
  

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
    echo '<a href="../pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=' . $tipo . '&especificacao=editar" class="btn btn-primary" title="Editar"><i class="bx bx-pencil"></i></a>';
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
        echo '<a href="../pagina-formulario.php?id=' . $v['id_' . $tabela] . '&tipo=email&especificacao=sendemail" class="btn" style="background-color: #3D8F42; border-color: #3D8F42;" title="Enviar E-mail"><i class="bx bx-envelope"></i></a>';
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