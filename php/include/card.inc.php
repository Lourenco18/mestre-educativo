
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
      .item {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            margin-right: 10px;
        }
        .details {
            text-align: left;
        }
        .details .title {
            font-weight: bold;
        }
        .details .date {
            color: #777;
        }
</style>
<?php

include $arrConfig['dir_admin'] . '/information/consultas.inc.php';
$data = [
    'labels' => ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho','Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    'data' => [5, 10, 15, 11, 12]
];
$masc =0;
$fem = 0;
$alunos = $consultas['aluno'];
$alunos = my_query($alunos);

//géneros
foreach ($alunos as $k => $v) {
    if ($v['id_genero'] = 1) {
        $fem = $fem+1;
    }else{
        $masc = $masc+1;
    }
    $v['data_nascimento_aluno'];
}
//aniversários



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

$disciplinas = "
   WITH DisciplinaRecente AS (
    SELECT 
        disciplina.*,
        ROW_NUMBER() OVER (PARTITION BY disciplina.unico ORDER BY disciplina.data DESC) AS rn
    FROM 
        disciplina
    WHERE
        disciplina.ativo = 1
),
CicloRecente AS (
    SELECT 
        ciclo.*,
        ROW_NUMBER() OVER (PARTITION BY ciclo.unico ORDER BY ciclo.data DESC) AS rn
    FROM 
        ciclo
    WHERE
        ciclo.ativo = 1
)
SELECT 
    dr.*,
    cr.*
FROM 
    DisciplinaRecente dr
INNER JOIN 
    CicloRecente cr ON dr.id_ciclo = cr.unico AND cr.rn = 1
WHERE 
    dr.rn = 1;

";
$arrDisciplinas = my_query($disciplinas);
if ($page_name == "index.php") {
  echo '
      <div class="col">
          <div class="card h-100 ps-0 py-xl-3" style="border: 4px solid #000000; border-radius: 8px; background-color: white; transition: all 0.3s ease;" 
              onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #000000, 0 6px 20px 0 #000000\'; this.style.zIndex=\'1\';" 
              onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">
              <div class="card-body" style="text-align: center; height: 231.599258px; margin-left: 0px;">
                  <h5 class="card-title">Novas Inscrições</h5>

<canvas id="chart1" style="height: 200px;"></canvas>


              </div>
          </div>
      </div>';
      echo '
      <div class="col">
          <div class="card h-70 ps-0 py-xl-3" style="border: 4px solid #000000; border-radius: 8px; background-color: white; transition: all 0.3s ease;" 
              onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #000000, 0 6px 20px 0 #000000\'; this.style.zIndex=\'1\';" 
              onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">
              <div class="card-body" style="text-align: center; height: 231.599258px; margin-left: 0px;">
           

<canvas id="sexoChart" style="height: 200px;"></canvas>


              </div>
          </div>
      </div>';
    
     
      echo '
      <div class="col">
          <div class="card h-70 ps-0 py-xl-3" style="border: 4px solid #000000; border-radius: 8px; background-color: white; transition: all 0.3s ease;" 
              onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #000000, 0 6px 20px 0 #000000\'; this.style.zIndex=\'1\';" 
              onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">
              <div class="card-body" style="text-align: center; height: 231.599258px; margin-left: 0px;">
                 
                  <canvas id="faturacaoChart"></canvas>
              </div>
          </div>
      </div>';
      echo '
        
    <div class="col">
        <div class="card h-70 ps-0 py-xl-3">
            <div class="card-body">
                <h5 class="card-title">Aniversários</h5>
                <div class="scrollable">';
                    
                    // Dados de aniversários
                    $birthdays = [
                        ['date' => '2006-01-07', 'image' => 'data:image/png;base64,INSERT_BASE64_IMAGE_HERE_1', 'name' => 'Marta'],
                        ['date' => '2006-10-11', 'image' => 'data:image/svg+xml;base64,INSERT_BASE64_IMAGE_HERE_2', 'name' => 'Leonor'],
                        ['date' => '2006-07-12', 'image' => 'data:image/png;base64,INSERT_BASE64_IMAGE_HERE_3', 'name' => 'João Silva'],
                        ['date' => '2006-09-23', 'image' => 'data:image/png;base64,INSERT_BASE64_IMAGE_HERE_4', 'name' => 'Maria Oliveira'],
                        ['date' => '2006-10-07', 'image' => 'data:image/png;base64,INSERT_BASE64_IMAGE_HERE_5', 'name' => 'Carlos Souza']
                    ];

                    // Função para calcular os dias até o próximo aniversário
                    function days_until_birthday($birthday) {
                        $today = new DateTime();
                        $currentYear = $today->format('Y');
                        $nextBirthday = new DateTime($currentYear . '-' . date('m-d', strtotime($birthday)));
                        
                        if ($nextBirthday < $today) {
                            $nextBirthday->modify('+1 year');
                        }
                        
                        return $today->diff($nextBirthday)->days;
                    }

                    // Calcular dias até o próximo aniversário e ordenar
                    foreach ($birthdays as &$person) {
                        $person['days_until'] = days_until_birthday($person['date']);
                    }

                    usort($birthdays, function($a, $b) {
                        return $a['days_until'] - $b['days_until'];
                    });

                    // Limitar a 4 aniversários mais próximos
                    $birthdays = array_slice($birthdays, 0, 3);
                    foreach ($birthdays as $person) {
                        echo '<div class="item">';
                        echo '<img src="' . $person['image'] . '" alt="Icone" class="icon">';
                        echo '<div class="details">';
                        echo '<div class="title">' . htmlspecialchars($person['name']) . '</div>';
                        echo '<div class="date">' . date('d/m/Y', strtotime($person['date'])) . '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    
                echo'</div>
            </div>
        </div>
    </div>';
}

    $arrResultados = my_query('SELECT * FROM operacao WHERE ativo = 1 '. $cards.'  AND unico IN (' . $_SESSION['permissoes'] . ') ' );


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
              $v['particao'] == "disciplina" ||
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
                <div class="card h-70 ps-0 py-xl-3" style="border: 4px solid '.$cor.'; border-radius: 8px; background-color: white; transition: all 0.3s ease;" onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0' .$cor.', 0 6px 20px 0 '.$cor.'\'; this.style.zIndex=\'1\';" onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">    
                        <div class="card-body" style="  text-align: center;height: 231.599258px;  margin-left: 0px">
                            <h5 class="card-title">'.$v['display'].'</h5>
                            <img class="icons" src="'.$arrConfig['url_imjs_upload'].'/icons/'.$v['foto_operacao'].'" alt="" height="100">
                        </div>
                    </div>
                </a>
            </div>';
    };

?>
    <script>
    // Configuração do gráfico
    var ctx = document.getElementById('chart1').getContext('2d');
    var chart1 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($data['labels']); ?>,
            datasets: [{
                label: 'Quantidade',
                data: <?php echo json_encode($data['data']); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
    <script>
// Configuração do gráfico de pizza
var ctx = document.getElementById('sexoChart').getContext('2d');
var sexoChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Feminino', 'Masculino'],
        datasets: [{
            label: 'Sexo',
            data: [<?php echo $fem; ?>, <?php echo $masc; ?>],
            backgroundColor: ['#FFC0CB', '#87CEEB'],
            hoverOffset: 4
        }]
    },
    options: {
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        var dataset = sexoChart.data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percent = Math.round((currentValue / total) * 100);
                        return currentValue + ' (' + percent + '%)';
                    }
                }
            }
        }
    }
});

document.addEventListener('DOMContentLoaded', (event) => {
            const ctx = document.getElementById('faturacaoChart').getContext('2d');
            const faturacaoChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    datasets: [{
                        label: 'Faturação (Euros)',
                        data: [1200, 1500, 1800, 2000, 2200, 2500, 2700, 3000, 3200, 3500, 3700, 4000],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</script>

    