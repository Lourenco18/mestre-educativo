

<div class="container-xxl ">
  <?php
  $pagename = $_SERVER['PHP_SELF'];

  $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
  $especificacao = isset($_GET['especificacao']) ? $_GET['especificacao'] : '';
  $message_error = isset($_GET['message_error']) ? $_GET['message_error'] : '';
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $tabela = rtrim($tipo, "s");
  $id_aluno = $id;
  $id_unico = my_query('SELECT unico, id_' . $tabela . ' FROM ' . $tabela . ' WHERE id_' . $tabela . ' = ' . $id . '');
  $id_unico = $id_unico[0]['unico'];
  $id_unico_aluno = $id_unico;
  include $_SERVER['DOCUMENT_ROOT'] . '/mestre-educativo/php/include/config.inc.php';

 
  include $arrConfig['dir_admin'] . '/ajax/recive-ajax.php';

 
  include $arrConfig['dir_admin'] . '/information/consultas.inc.php';

 
  include $arrConfig['dir_admin'] . '/forms_campos.php';

 

  if ($tipo == 'colaborador' || $tipo == 'professores') {// esta verificação está a ser feita pois os professores estão inseridos na tabela colaborador, ou seja, é necessário igualar-los 
    $arrResultados = my_query('SELECT * FROM colaborador WHERE ativo = 1');
    $tabela = 'colaborador';// o $categoria vai ser uma variavel que vou usar para identificar a tabela que tenho de utilizar
    $tipo = "colaborador";
  } else {
    $tabela = rtrim($tipo, "s");
  }
  $tabela = rtrim($tipo, "s");
  include $arrConfig['dir_include'] . '/caminho.inc.php';// caminho de cada página
  if ($tabela == 'aluno' && $especificacao == 'editar') {
    echo '
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
        <li class="nav-item">
          <a class="nav-link active" href="#personView"
            ><i class="bx bx-user me-1"></i> Aluno</a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#relacaoView"
            ><i class="bx bx-bell me-1"></i> Relações</a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#avaliacoesView"
            ><i class="bx bx-link-alt me-1"></i> Avaliações</a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#horarioView"
            ><i class="bx bx-link-alt me-1"></i> Horário</a
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

    if ($especificacao == "editar") {

      foreach ($arrResultados as $k => $v) {
        $foto = $arrResultados[$k]['foto_' . $tabela];

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

    echo gerar_upload($src, $buttonMsg, 'image');





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
                $sql_combobox = "SELECT * FROM $table WHERE ativo = 1";
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
                if ($id_Selected == $v['id_' . $id_campo]) {
                  $selected = 'selected="selected" ';
                }
                echo '<option ' . $selected . ' value="' . $v['id_' . $id_campo] . '">' . $v[$id_campo] . '</option>';
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
          
              echo '<input  '; if($id_campo == "ni"){}else{echo 'required';}; echo' type="' . $type . '" ' . $config . ' placeholder = "' . $placeholder . '" oninput="trata(this)"';
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
    <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer apagar este ';
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


<div id="relacaoView" class="divisao" style="display: none;">
  <div class="row row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3"
    style="padding: 20px;">
    <div class="col">
      <a href="#" data-bs-toggle="modal" data-bs-target="#modalFormADD">
        <?php
        $especificacao = 'adicionar';
        $tipo = 'relacao';
        $tabela_modal = 'pessoa';
        ?>
        <div class="card h-70 ps-0 py-xl-3" style="background-color: white; transition: all 0.3s ease;"
          onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff\'; this.style.zIndex=\'1\';"
          onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\'">
          <div class="card-body" style="text-align: center;height: 231.599258px;  margin-left: 0px">
            <h5 class="card-title">Adicionar Relação</h5>
            <img class="icons" src="'.$arrConfig['url_imjs_upload'].'/icons/'.$v['foto_operacao'].'" alt=""
              height="100">
          </div>
        </div>
      </a>
    </div>
    <div class="modal modal-mid fade" id="modalFormADD" tabindex="-1">
      <div class="modal-dialog">
        <form class="modal-content"
          action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $page_name; ?>&id=<?php echo $id_modal; ?>&tabela=<?php echo $tabela_modal; ?>&acao=adicionar"
          method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTopTitle">Adicionar <?php echo $tipo; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="max-height: 800px; overflow-y: auto;">
            <?php
            $id_unico_pessoa = my_query("SELECT MAX(unico) FROM pessoa");
            $id_unico_pessoa = $id_unico_pessoa[0]['MAX(unico)'] + 1;
            include $arrConfig['dir_admin'] . '/forms_campos.php'; //vai buscar a array dos campos do formulário
            


            $tipo = $tabela_modal;
            foreach ($campos as $campo) {
              if ($campo['object'] == $tipo) {
                $label = $campo['label'] ?? '';
                $id_campo = $campo['id'] ?? '';
                $name = $campo['name'] ?? '';
                $type = $campo['type'] ?? '';
                $size = $campo['size'] ?? '';
                $max = $campo['max'] ?? '';
                $min = $campo['min'] ?? '';
                $config = $campo['config'] ?? '';
                $placeholder = $campo['placeholder'] ?? '';
                $ajax = $campo['ajax'] ?? null;

                echo '<div class="' . $size . '">';
                echo '<label for="' . $id_campo . '" class="form-label">' . $label . '</label>';

                if ($type == "combobox") {
                  $table = ucfirst($id_campo);
                  $sql_combobox = "SELECT * FROM $table WHERE ativo = 1";
                  $arrtable = my_query($sql_combobox);

                  $onChange = $ajax ? 'onchange="ajax(this.value)"' : '';
                  echo '<select ' . $onChange . ' required name="' . $name . '" id="' . $id_campo . '" class="select2 form-select">';

                  if ($especificacao == 'editar') {
                    $id_Selected = $arrResultados[0]['id_' . $id_campo];
                  } else {
                    echo '<option value="">Selecione uma opção</option>';
                    $id_Selected = '';
                  }

                  foreach ($arrtable as $v) {
                    $selected = ($id_Selected == $v['id_' . $id_campo]) ? 'selected="selected"' : '';
                    echo '<option ' . $selected . ' value="' . $v['id_' . $id_campo] . '">' . $v[$id_campo] . '</option>';
                  }

                  echo '</select>';
                } else {
                  $value = $especificacao == 'editar' ? $arrResultados[0][$name] : '';
                  echo '<input placeholder="' . $placeholder . '" ' . $config . ' required type="' . $type . '" max="' . $max . '" min="' . $min . '" class="form-control" id="' . $id_campo . '" name="' . $name . '" value="' . $value . '" oninput ="trata(this)"/>';
                }
                echo '</div>';
              }
            }
            ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary me-2">Adicionar <?php $tipo ?></button>
          </div>
        </form>
      </div>
    </div>
    <?php
   
   $arrRelacao = my_query('
    SELECT 
        pessoa.id_aluno, 
        pessoa.data,
        pessoa.pessoa, 
        pessoa.telefone_pessoa, 
        pessoa.unico AS unico_pessoa, 
        relacao.relacao 
    FROM 
        pessoa 
    INNER JOIN 
        relacao 
    ON 
        relacao.id_relacao = pessoa.id_relacao 
    WHERE 
        pessoa.ativo = 1 
        AND pessoa.removed = 0 
        AND pessoa.id_aluno = ' . $id_unico_aluno . ' 
        AND pessoa.data = (
            SELECT MAX(p2.data)
            FROM pessoa p2
            WHERE p2.unico = pessoa.unico
        )
');

    if (count($arrRelacao) == 0) {
      echo 'Não existem relações';
    } else {
      ?>
      <?php foreach ($arrRelacao as $v) {


        $tabela_modal = 'pessoa';
        $especificacao = 'editar';
        $id_modal = $v['unico_pessoa'];
        $id_unico_pessoa = $v['unico_pessoa'];
      
        
        include $arrConfig['dir_admin'] . '/forms_campos.php';
    
        ?>
        <div class="card h-70 ps-0 py-xl-3" style="background-color: white; transition: all 0.3s ease;"
          onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff'; this.style.zIndex='1';"
          onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
          <div class="card-body" style="text-align: center; height: 231.599258px; margin-left: 0px">
            <h5 class="card-title"><?php echo $v['pessoa']; ?></h5>
            <h7 class="card-title">Telefone: <?php echo $v['telefone_pessoa']; ?></h7><br>
            <h7 class="card-title">Relação: <?php echo $v['relacao']; ?></h7>
          </div>
          <?php if ($_SESSION['userCargo'] == 'admin' || $_SESSION['userCargo'] == 'supra_admin') { ?>
            <button style="margin: 3px;" type="button" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#modalForm<?php echo $id_modal; ?>"><i class="bx bx-pencil"></i> Editar</button>
            <?php if ($tabela != 'colaborador' || $v['cargo'] != 'supra_admin') { ?>
              <button style="margin: 3px;" type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#modalTopRemove<?php echo $id_modal; ?>"><i class="bx bx-trash"></i> Remover</button>
            <?php } ?>
          <?php } ?>
        </div>
        
        
        
        <!-- Modal for removal -->
        <?php
        echo '
         <div class="modal modal-mid fade" id="modalTopRemove' . $id_modal . '" tabindex="-1">
         <div class="modal-dialog">
           <form class="modal-content">
             <div class="modal-header">
         <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer apagar este ';
        echo $tabela_modal;

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
         <a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/verf-exist.php?id= ' . $id_modal . '&tabela=' . $tabela_modal . '&acao=apagar&pagename=' . $_SERVER['PHP_SELF'] . '" onclick="SwalSuccess()">Sim, quero remover</a>
       
         </div>
         </form>
       </div>
       </div>
       </div>  ';
        //modal form
        ?>
        
        <div class="modal modal-mid fade" id="modalForm<?php echo $id_modal; ?>" tabindex="-1">
          <div class="modal-dialog">
            <form class="modal-content"
              action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $page_name; ?>&id=<?php echo $id_modal; ?>&tabela=<?php echo $tabela_modal; ?>&acao=editar"
              method="POST" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTopTitle">Editar <?php echo $tabela_modal; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="max-height: 800px; overflow-y: auto;">
                <?php

                include $arrConfig['dir_admin'] . '/forms_campos.php'; //vai buscar a array dos campos do formulário
                $tipo = $tabela_modal;

                $arrResultados = my_query('SELECT * FROM ' . $tabela_modal . ' WHERE unico = ' . $id_modal);

                foreach ($campos as $campo) {
                  if ($campo['object'] == $tipo) {
                    $label = $campo['label'] ?? '';
                    $id_campo = $campo['id'] ?? '';
                    $name = $campo['name'] ?? '';
                    $type = $campo['type'] ?? '';
                    $size = $campo['size'] ?? '';
                    $max = $campo['max'] ?? '';
                    $min = $campo['min'] ?? '';
                    $config = $campo['config'] ?? '';
                    $placeholder = $campo['placeholder'] ?? '';
                    $ajax = $campo['ajax'] ?? null;

                    echo '<div class="' . $size . '">';
                    echo '<label for="' . $id_campo . '" class="form-label">' . $label . '</label>';

                    if ($type == "combobox") {
                      $table = ucfirst($id_campo);
                      $sql_combobox = "SELECT * FROM $table WHERE ativo = 1";
                      $arrtable = my_query($sql_combobox);

                      $onChange = $ajax ? 'onchange="ajax(this.value, \'' . $name . '\')"' : '';
                      echo '<select ' . $onChange . ' required name="' . $name . '" id="' . $id_campo . '" class="select2 form-select" onchange="handleChange(this)">';

                      if ($especificacao == 'editar') {
                        $id_Selected = $arrResultados[0]['id_' . $id_campo];
                      } else {
                        echo '<option value="">Selecione uma opção</option>';
                        $id_Selected = '';
                      }

                      foreach ($arrtable as $v) {
                        $selected = ($id_Selected == $v['id_' . $id_campo]) ? 'selected="selected"' : '';
                        echo '<option ' . $selected . ' value="' . $v['id_' . $id_campo] . '">' . $v[$id_campo] . '</option>';
                      }

                      echo '</select>';
                    } else {
                      $value = $especificacao == 'editar' ? $arrResultados[0][$name] : '';
                      echo '<input placeholder="' . $placeholder . '" ' . $config . ' required type="' . $type . '" max="' . $max . '" min="' . $min . '" class="form-control" id="' . $id_campo . '" name="' . $name . '" value="' . $value . '" oninput="trata(this)"/>';
                    }
                    echo '</div>';
                  }
                }
                ?>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary me-2">Guardar Alterações</button>
              </div>
            </form>
          </div>
        </div>
        </div>
     
      <?php } ?>
     
    </div>
  </div>
  <?php
    }
    ?>
</div>



</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script src="<?php echo $arrConfig['dir_site'].'/js/functions.js'; ?>"></script>
<script>
  // Inicializar a tabela DataTable
  var table = $('#table').DataTable({
    columnDefs: [
      { targets: [0], width: '10%' },
      //{ targets: '_all', visible: false }
    ]
  });
</script>

<?php
  include 'separador/horarioView.php'
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
    var erro = 0;
    if (
      contribuinte.substr(0, 1) != '1' && // pessoa singular
      contribuinte.substr(0, 1) != '2' && // pessoa singular
      contribuinte.substr(0, 1) != '3' && // pessoa singular
      contribuinte.substr(0, 2) != '45' && // pessoa singular não residente
      contribuinte.substr(0, 1) != '5' && // pessoa colectiva
      contribuinte.substr(0, 1) != '6' && // administração pública
      contribuinte.substr(0, 2) != '70' && // herança indivisa
      contribuinte.substr(0, 2) != '71' && // pessoa colectiva não residente
      contribuinte.substr(0, 2) != '72' && // fundos de investimento
      contribuinte.substr(0, 2) != '77' && // atribuição oficiosa
      contribuinte.substr(0, 2) != '79' && // regime excepcional
      contribuinte.substr(0, 1) != '8' && // empresário em nome individual (extinto)
      contribuinte.substr(0, 2) != '90' && // condominios e sociedades irregulares
      contribuinte.substr(0, 2) != '91' && // condominios e sociedades irregulares
      contribuinte.substr(0, 2) != '98' && // não residentes
      contribuinte.substr(0, 2) != '99' // sociedades civis

    ) { erro = 1; }
    var verf1 = contribuinte.substr(0, 1) * 9;
    var verf2 = contribuinte.substr(1, 1) * 8;
    var verf3 = contribuinte.substr(2, 1) * 7;
    var verf4 = contribuinte.substr(3, 1) * 6;
    var verf5 = contribuinte.substr(4, 1) * 5;
    var verf6 = contribuinte.substr(5, 1) * 4;
    var verf7 = contribuinte.substr(6, 1) * 3;
    var verf8 = contribuinte.substr(7, 1) * 2;

    var total = verf1 + verf2 + verf3 + verf4 + verf5 + verf6 + verf7 + verf8;
    var divisao = total / 11;
    var modulo11 = total - parseInt(divisao) * 11;
    if (modulo11 == 1 || modulo11 == 0) { comparador = 0; } // excepção
    else { comparador = 11 - modulo11; }


    var ultimoDigito = contribuinte.substr(8, 1) * 1;
    if (ultimoDigito != comparador) { erro = 1; }

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
      if (validarNIF(inputValue)) {
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
    console.log(nomeBotao);

    if (nomeBotao === 'personView') {
      personView.style.display = 'block';
      relacaoView.style.display = 'none';
      avaliacoesView.style.display = 'none';
      horarioView.style.display = 'none';
    } else if (nomeBotao === 'relacaoView') {
      personView.style.display = 'none';
      relacaoView.style.display = 'block';
      avaliacoesView.style.display = 'none';
      horarioView.style.display = 'none';
    } else if (nomeBotao === 'avaliacoesView') {
      personView.style.display = 'none';
      relacaoView.style.display = 'none';
      avaliacoesView.style.display = 'block';
      horarioView.style.display = 'none';
    } else if (nomeBotao === 'horarioView') {
      personView.style.display = 'none';
      relacaoView.style.display = 'none';
      avaliacoesView.style.display = 'none';
      horarioView.style.display = 'block';
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