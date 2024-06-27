

<div class="container-xxl ">
  <?php
  $pagename = $_SERVER['PHP_SELF'];
  unicooperacao( 'nacionalidade');
  $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
  $especificacao = isset($_GET['especificacao']) ? $_GET['especificacao'] : '';
  $message_error = isset($_GET['message_error']) ? $_GET['message_error'] : '';
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $tabela = rtrim($tipo, "s");
  $id_aluno = $id;
  if ($tipo == 'colaborador' || $tipo == 'professor') {// esta verificação está a ser feita pois os professores estão inseridos na tabela colaborador, ou seja, é necessário igualar-los 
    
    $tabela = 'colaborador';// o $categoria vai ser uma variavel que vou usar para identificar a tabela que tenho de utilizar
    $tipo = "colaborador";
  } else {
    $tabela = rtrim($tipo, "s");
  }
  $tabela = rtrim($tipo, "s");
  if($especificacao == 'editar'){
    $sqlUnico = "SELECT unico, id_$tabela from $tabela where id_$tabela = $id";
    $arrisunico = my_query($sqlUnico);
    $id_unico = $arrisunico [0]['unico'];
  }

  $id_unico_aluno = $id_unico;
  
  include $_SERVER['DOCUMENT_ROOT'] . '/mestre-educativo/php/include/config.inc.php';

  
  include $arrConfig['dir_admin'] . '/ajax/recive-ajax.php';


  include $arrConfig['dir_admin'] . '/information/consultas.inc.php';

 
  include $arrConfig['dir_admin'] . '/forms_campos.php';
 
 

  include $arrConfig['dir_include'] . '/caminho.inc.php';// caminho de cada página
  if ( $especificacao == 'editar') {
    echo '
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
        <li class="nav-item">
          <a class="nav-link active" href="#personView"
            ><i class="bx bx-user me-1"></i> Aluno</a
          >
        </li>';
        if($tabela == 'aluno'){
          echo'
          <li class="nav-item">
            <a class="nav-link" href="#relacaoView"
              ><i class="bx bx-network-chart"></i> Relações</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#avaliacoesView"
              ><i class="bx bx-link-alt me-1"></i> Avaliações</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#horarioView"
              ><i class="bx bx-calendar"></i> Horário</a
            >
          </li>
  
           <li class="nav-item">
            <a class="nav-link" href="#pagamentosView"
              ><i class="bx bx-dollar"></i> Pagamentos</a
            >
          </li>';
        }
       
        echo'
          <li class="nav-item">
          <a class="nav-link" href="#historyView"
            ><i class="bx bx-history"></i> Histórico</a
          >
        </li>
        </ul>
        
          ';

  }

  if ($especificacao != 'editar') {
    $query = "SELECT * from $tabela where id_$tabela = $id";
  }
  ?>
  <form action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $pagename;
     echo "&id=$id&tabela=$tipo&acao=$especificacao" ?>" method="POST" enctype="multipart/form-data">
    <?php
    if ($especificacao == "editar") {
      // Definir a consulta SQL
      $consulta = $consultasForms[$tipo];
      //echo $query;
      $arrResultados = my_query($consulta);

    } else {

      $foto = '';
      include $arrConfig['dir_admin'] . '/fotos.inc.php';


    }

    if ($especificacao == "editar" && isset($arrResultados[$k]['foto_' . $tabela])) {

      foreach ($arrResultados as $k => $v) {
        $foto = isset($arrResultados[$k]['foto_' . $tabela]);

      }
      include $arrConfig['dir_admin'] . '/fotos.inc.php';

      if ($foto == '') {
        $buttonMsg = "Adicionar uma foto - $tabela";
      } else {
        $buttonMsg = "Alterar foto - $tabela";
      }
    } else {
      $foto = array();
      $buttonMsg = "Inserir foto - $tabela";

    }






    //imagem de cada pessoa
    
    echo '
          <div class="row">
            <div class="col-md-12 " >
            
              <div class="card mb-3 px-md-4 ps-0" style="background-color: white">
              <div id="personView" style="display: block;">';

   if(isset($arrResultados[$k]['foto_' . $tabela])) {echo gerar_upload($src, $buttonMsg, 'image');}





    ?>
    <div class="card-body">
      <div class="row">
        <?php
        $divisao1 = '';// variável que identifica a divisão do formulário
        
      
        // precorre os campos do formulário
        foreach ($campos as $campos) {

          $label = $campos['label'] ?? null;
          $id_campo = $campos['id'] ?? null;
          $name = $campos['name'] ?? null;
          $type = $campos['type'] ?? null;
          $size = $campos['size'] ?? null;
          $divisao = $campos['divisao'] ?? null;
          $object = $campos['object'] ?? null;
          $max = $campos['max'] ?? null;
          $min = $campos['min'] ?? null;
          $config = $campos['config'] ?? null;
          $placeholder = $campos['placeholder'] ?? null;
          $ajax = $campos['ajax'] ?? null;
          $maxlength = $campos['maxlength'] ?? null;



          if ($object == $tipo) {
            if ($divisao1 != $divisao) { // cria a divisória e dá um nome á divisão
              echo '   <hr class="my-0" />';
              echo ' <span style="font-size: 30px; margin-top: 10px">' . $divisao . '</span>';
              $divisao1 = $divisao;
            }
            ;


            echo '<div class="' . $size . '">
                <label for="' . $id_campo . '" class="form-label">' . $label . '</label>';


            if ($type == "combobox") {
              $table = ucfirst($id_campo); // nome da tabela das combobox
              if (isset($id_received)) {
                $sql_combobox = "SELECT * FROM $table WHERE ativo = 1 ";
              } else {
                $sql_combobox = "WITH RecentRecords AS (
    SELECT 
        *,
        ROW_NUMBER() OVER (PARTITION BY unico ORDER BY data DESC) as rn
    FROM $table
    WHERE ativo = 1
)
SELECT * 
FROM RecentRecords
WHERE rn = 1;";
              }

              $arrtable = my_query($sql_combobox);

              $onChange = '';
              if ($ajax != null) {
                $divName = $ajax['div'];
                $fileName = $ajax['file'];

                $onChange = 'onchange="ajax(this.value)"';
              }

              echo '<select ' . $onChange . ' required name="' . $name . '" id="' . $id_campo . '" class="select2 form-select">';


              if ($especificacao == 'editar') {
                $id_Selected = $arrResultados[0]['id_' . $id_campo];


              } else {
                $id_Selected = '';
                echo '<option value="">Selecione uma opção</option>';
              }

              foreach ($arrtable as $k => $v) {
                $selected = "";
                if ($id_Selected == $v['unico']) {
                  $selected = 'selected="selected" ';
                }
                echo '<option ' . $selected . ' value="' . $v['unico'] . '">' . $v[$id_campo] . ' '.$id_Selected.'</option>';
              }
              echo '</select>';

              if ($ajax != null) {// função para receber a variável que vai ser passada pelo ajax
                echo '<script>
                    function ajax(id_received) {
                     console.log(id_received);
                      $.ajax({
                          url: "' . $arrConfig['url_admin'] . '/ajax/recive-ajax.php",
                          type: "get",
                          data: {id_received: id_received},
                          success: function (data) {
                            console.log("sucesso");
                              $("#' . $divName . '").html(data);
                          }
                      });
                    }
                    </script>';
              }

            } else {
          
              echo '<input  '; if($id_campo == "ni"){}else{echo 'required';}; echo' type="' . $type . '" ' . $config . ' maxlength= "'.$maxlength.'" placeholder = "' . $placeholder . '" oninput="trata(this)"';
              if ($max != '' || $min != '') {
                echo "max='" . $max;
                echo "' min='$min'";
              }
              ;
              echo 'class="form-control" id="' . $id_campo . '" name="' . $name . '"';
              if ($especificacao == 'editar') {
                foreach ($arrResultados as $t => $k) {
                  echo 'value="' . $k[$name] . '"';
                }
              }
              ;
              echo '/>';
            }
            echo '</div>';
          }
          ;
        }



        ?>
      </div>
      <?php

      if ($especificacao == 'editar') {
        echo '<button type="submit" class="btn btn-primary me-2">Guardar Alterações</button></form>
         <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopremove' . $id . '"><i class="bx bx-trash"></i> Remover</button>';
      } else {
        echo '<button type="submit" class="btn btn-primary me-2">Criar</button></form>';
      }

      echo '
         <div class="modal modal-mid fade" id="modalTopDesative' . $id . '" tabindex="-1">
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
         <a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/verf-exist.php?id= ' . $id . '&tabela=' . $tabela . '&acao=desativar&pagename=' . $_SERVER['PHP_SELF'] . '" onclick="SwalSuccess()">Sim, quero desativar</a>
        
         </div>
         </form>
         </div>
         </div>
         ';
      echo '
    <div class="modal modal-mid fade" id="modalTopremove' . $id . '" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content">
        <div class="modal-header">
    <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer remover este ';
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
    <a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/verf-exist.php?id= ' . $id_unico . '&tabela=' . $tabela . '&acao=apagar&pagename=' . $_SERVER['PHP_SELF'] . '" onclick="SwalSuccess()">Sim, quero remover</a>
  
    </div>
    </form>
  </div>
  </div>
 ';




      ?>
    </div>
</div>




<?php

include 'separador/relacaoView.php';



include 'separador/avaliacoesView.php';


  include 'separador/horarioView.php';

  include 'separador/historyView.php';

  include 'separador/pagamentosView.php';
?>

</div>


<script>
  
  function validarNISS(niss) {
    
    //deve ter 11 dígitos
    if(niss.length != 11) {
       return false;
    } else {
        var FACTORS = [29, 23, 19, 17, 13, 11, 7, 5, 3, 2];
        var nissArray = [];
        for (var i = 0; i < niss.length; i++) {
            nissArray[i] = niss.charAt(i);
        }

        var sum=0;

        //faz a soma do digito [j] x o dígito [j] do array dos fatores
        for (var j = 0; j < FACTORS.length; j++) {
            sum += nissArray[j] * FACTORS[j];
        }

        //verifica se dá resto 0
        if (nissArray[nissArray.length - 1] == (9 - (sum % 10))) {
            return true;
        } else {
           return false;
        }
    }
  }
//função para validar o cartão de cidadão português
function validarCC(number) {
    let letter_value = { A: 10, B: 11, C: 12, D: 13, E: 14, F: 15, G: 16, H: 17, I: 18, J: 19, K: 20, L: 21, M: 22, N: 23, O: 24, P: 25, Q: 26, R: 27, S: 28, T: 29, U: 30, V: 31, W: 32, X: 33, Y: 34, Z: 35 };
      let cc_number = number.replace(/-|\s/g, ''); // remover space and -
      cc_number = cc_number.toUpperCase();
      cc_number = [...cc_number];
      cc_number = cc_number.reverse();
      cc_number[1] = letter_value[cc_number[1]];
      cc_number[2] = letter_value[cc_number[2]];
      let sum = 0;
      let dum = 0;
      jQuery.each(cc_number, function (k, v) {
        if (k % 2 == 0) {
          dum = parseInt(v);
        }
        else {
          dum = parseInt(v) * 2;
          if (dum >= 10)
            dum -= 9;
        }
        sum += dum;
        console.log('k : ' + k + ' | sum : ' + sum);
      });

      return (sum % 10 == 0) ? true : false;
  } 
 //validar NIF
  function validarNIF(contribuinte) {
   
var temErro=0;

if (
contribuinte.substr(0,1) != '1' && // pessoa singular
contribuinte.substr(0,1) != '2' && // pessoa singular
contribuinte.substr(0,1) != '3' && // pessoa singular
contribuinte.substr(0,2) != '45' && // pessoa singular não residente
contribuinte.substr(0,1) != '5' && // pessoa colectiva
contribuinte.substr(0,1) != '6' && // administração pública
contribuinte.substr(0,2) != '70' && // herança indivisa
contribuinte.substr(0,2) != '71' && // pessoa colectiva não residente
contribuinte.substr(0,2) != '72' && // fundos de investimento
contribuinte.substr(0,2) != '77' && // atribuição oficiosa
contribuinte.substr(0,2) != '79' && // regime excepcional
contribuinte.substr(0,1) != '8' && // empresário em nome individual (extinto)
contribuinte.substr(0,2) != '90' && // condominios e sociedades irregulares
contribuinte.substr(0,2) != '91' && // condominios e sociedades irregulares
contribuinte.substr(0,2) != '98' && // não residentes
contribuinte.substr(0,2) != '99' // sociedades civis

) { temErro=1;}
var check1 = contribuinte.substr(0,1)*9;
var check2 = contribuinte.substr(1,1)*8;
var check3 = contribuinte.substr(2,1)*7;
var check4 = contribuinte.substr(3,1)*6;
var check5 = contribuinte.substr(4,1)*5;
var check6 = contribuinte.substr(5,1)*4;
var check7 = contribuinte.substr(6,1)*3;
var check8 = contribuinte.substr(7,1)*2;

var total= check1 + check2 + check3 + check4 + check5 + check6 + check7 + check8;
var divisao= total / 11;
var modulo11=total - parseInt(divisao)*11;
if ( modulo11==1 || modulo11==0){ comparador=0; } // excepção
else { comparador= 11-modulo11;}


var ultimoDigito=contribuinte.substr(8,1)*1;
if ( ultimoDigito != comparador ){ temErro=1;}


    if (erro == 1) { return false; }else { return true; }

  }
    



  //tratar formulário
  //receber os dados do formulário
  function trata(element) {
    var inputName = element.id;
    var inputValue = element.value;
    console.log(`Input changed: Name = ${inputName}, Value = ${inputValue}`);
    //tratamento dos dados e aviso de erro
    if (inputName == 'telefone') {// se for telemovel
      if (inputValue.length < 6 || inputValue.length > 15) {// mundialmente o minimo de digitos é 6 e o máximo é 15 retirando o indicativo de país
        element.style.borderColor = 'red';
      } else {
        element.style.borderColor = 'green';
      }
    } else if (inputName == 'cc') {
      if (validarCC(inputValue)) {
        element.style.borderColor = 'green';
      } else {
        element.style.borderColor = 'red';
      };
    } else if (inputName == 'nif') {
      if (validarNIF(inputValue) &&  inputValue.length < 10) {
        element.style.borderColor = 'green';
      } else {
        element.style.borderColor = 'red';
      };
    }else if (inputName == 'sc') {
      if (validarNISS(inputValue)) {
        element.style.borderColor = 'green';
      } else {
        element.style.borderColor = 'red';
      };


    };

  }
  //altearar a imagem e reseta-la dos formulários
  document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
      const deactivateAcc = document.querySelector('#formAccountDeactivation');

      // Update/reset user image of account page
      let accountUserImage = document.getElementById('uploadedAvatar');
      const fileInput = document.querySelector('.account-file-input'),
        resetFileInput = document.querySelector('.account-image-reset');

      if (accountUserImage) {
        const resetImage = accountUserImage.src;
        fileInput.onchange = () => {
          if (fileInput.files[0]) {
            accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
          }
        };
        resetFileInput.onclick = () => {
          fileInput.value = '';
          accountUserImage.src = resetImage;
        };
      }
    });
  });

  // Função para alterar a viusalização das views
  function exibirView(nomeBotao) {
    var relacaoView = document.getElementById('relacaoView');
    var avaliacoesView = document.getElementById('avaliacoesView');
    var horarioView = document.getElementById('horarioView');
    var personView = document.getElementById('personView');
    var historyView = document.getElementById('historyView');
    var pagamentosView = document.getElementById('pagamentosView');
    console.log(nomeBotao);

    if (nomeBotao === 'personView') {
      personView.style.display = 'block';
      relacaoView.style.display = 'none';
      avaliacoesView.style.display = 'none';
      horarioView.style.display = 'none';
      historyView.style.display = 'none';
      pagamentosView.style.display = 'none';
    } else if (nomeBotao === 'relacaoView') {
      personView.style.display = 'none';
      relacaoView.style.display = 'block';
      avaliacoesView.style.display = 'none';
      horarioView.style.display = 'none';
      historyView.style.display = 'none';
      pagamentosView.style.display = 'none';
    } else if (nomeBotao === 'avaliacoesView') {
      personView.style.display = 'none';
      relacaoView.style.display = 'none';
      avaliacoesView.style.display = 'block';
      horarioView.style.display = 'none';
      historyView.style.display = 'none';
      pagamentosView.style.display = 'none';
    } else if (nomeBotao === 'horarioView') {
      personView.style.display = 'none';
      relacaoView.style.display = 'none';
      avaliacoesView.style.display = 'none';
      horarioView.style.display = 'block';
      historyView.style.display = 'none';
      pagamentosView.style.display = 'none';
    }
   else if (nomeBotao === 'historyView') {
      personView.style.display = 'none';
      relacaoView.style.display = 'none';
      avaliacoesView.style.display = 'none';
      horarioView.style.display = 'none';
      historyView.style.display = 'block';
      pagamentosView.style.display = 'none';
    }
    else if (nomeBotao === 'pagamentosView') {
      personView.style.display = 'none';
      relacaoView.style.display = 'none';
      avaliacoesView.style.display = 'none';
      horarioView.style.display = 'none';
      historyView.style.display = 'none';
      pagamentosView.style.display = 'block';
    }

  }

  document.addEventListener('DOMContentLoaded', function () {
    // Obtém os botões de navegação
    var botoes = document.querySelectorAll('.nav-link');

    // Itera sobre os botões
    botoes.forEach(function (botao) {
      // Adiciona um evento de clique para cada botão
      botao.addEventListener('click', function (event) {
        // Previne o comportamento padrão do link
        event.preventDefault();

        // Remove a classe 'active' de todos os botões
        botoes.forEach(function (b) {
          b.classList.remove('active');
        });

        // Adiciona a classe 'active' ao botão clicado
        botao.classList.add('active');

        // Obtém o nome do botão clicado
        var id = botao.getAttribute('href').substring(1);

        // Exibe a mensagem com o nome do botão
        exibirView(id);
      });
    });
  });




</script>