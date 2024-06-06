<?php
include $_SERVER['DOCUMENT_ROOT'] . '/mestre-educativo/php/include/config.inc.php';
include $arrConfig['dir_admin'].'/head.inc.php';
$id_ciclo = 1;
$arrDisciplinas = my_query("SELECT * from disciplina INNER JOIN ciclo on ciclo.id_ciclo = disciplina.id_ciclo WHERE disciplina.id_ciclo = $id_ciclo");

// Tabela alternativa
echo '

<table id="table"  class="table table-striped " style="  
border-collapse: collapse; width: 100%; table-layout: fixed; width: 100%;
border-collapse: collapse; ">
<thead>
  <tr>';
echo '<th> Periodos/semestres';
//disciplinas
echo '</th>';
echo '<th> português';
//disciplinas
echo '</th>';
echo '<th> português';
//disciplinas
echo '</th>';
echo '</tr>
</thead>
<tbody>';



echo '<tr>';
echo '<td> 1º';
//notas disciplinas
echo '</td>';

echo '</tr>';

echo '<tr>';
echo '<td> 2º';
//notas disciplinas
echo '</td>';

echo '</tr>';

echo '<tr>';
echo '<td> 3º';
//notas disciplinas
echo '</td>';

echo '</tr>';
echo ' <tr>';

  
echo '
  </tr>';




echo '</tbody>
</table>
';

?>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script>
   // Inicializar a tabela DataTable





   var table = $('#table').DataTable({
      columnDefs: [
         { targets: [0], width: '10%' },
         //{ targets: '_all', visible: false }
      ]
   });
</script>