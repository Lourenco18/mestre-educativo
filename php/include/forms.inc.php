<div class="container-xxl ">
   <?php
     $id = isset($_GET['id']) ? $_GET['id'] : '';
     $id_aluno = $id;
    include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
      include $arrConfig['dir_admin'] . '/ajax/recive-ajax.php';
      include $arrConfig['dir_admin'] . '/information/consultas.inc.php';
      include $arrConfig['dir_admin'] . '/forms_campos.php'; 
      
      
      $pagename = $_SERVER['PHP_SELF'];
    
      $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
      $especificacao = isset($_GET['especificacao']) ? $_GET['especificacao'] : '';
      $message_error = isset($_GET['message_error']) ? $_GET['message_error'] : '';
      
      
      if ($tipo == 'colaborador' || $tipo == 'professores') {// esta verificação está a ser feita pois os professores estão inseridos na tabela colaborador, ou seja, é necessário igualar-los 
        $arrResultados = my_query('SELECT * FROM colaborador WHERE ativo = 1');
        $tabela = 'colaborador';// o $categoria vai ser uma variavel que vou usar para identificar a tabela que tenho de utilizar
        $tipo = "colaborador";
      } else {
        $tabela = rtrim($tipo, "s");
      }
      $tabela = rtrim($tipo, "s");
      include $arrConfig['dir_include'] . '/caminho.inc.php';// caminho de cada página
      if($tabela == 'aluno' && $especificacao == 'editar'){
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
                  echo '<input  "required type="' . $type . '" ' . $config . ' placeholder = "' . $placeholder . '" ';
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
         <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopremove'.$id.'"><i class="bx bx-trash"></i> Remover</button>';
         } else {
           echo '<button type="submit" class="btn btn-primary me-2">Criar</button></form>';
         }
   
         include $arrConfig['dir_admin'] . '/modal/modal-remove-remake.php';
         include $arrConfig['dir_admin'] . '/modal/modal-desative-ative.php';
         
         
         
         ?>
   </div>
</div>


<div id="relacaoView" class="divisao" style="display: none;">
<div class="row row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3" style="padding: 20px;">
      <div class="col">
      <a href="#" data-bs-toggle="modal" data-bs-target="#modalFormADD">
            <?php
            $especificacao = 'adicionar';
            $tipo = 'relacao' ;
            $tabela_modal = 'pessoa';
            ?>
                <div class="card h-70 ps-0 py-xl-3" style="background-color: white; transition: all 0.3s ease;" onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff\'; this.style.zIndex=\'1\';" onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">    
                        <div class="card-body" style="text-align: center;height: 231.599258px;  margin-left: 0px">
                            <h5 class="card-title">Adicionar Relação</h5>
                            <img class="icons" src="'.$arrConfig['url_imjs_upload'].'/icons/'.$v['foto_operacao'].'" alt="" height="100">
                        </div>
                    </div>
                </a>
        </div>
        <div class="modal modal-mid fade" id="modalFormADD" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $page_name; ?>&id=<?php echo $id_modal; ?>&tabela=<?php echo $tabela_modal; ?>&acao=adicionar" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle">Adicionar <?php echo $tipo; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="max-height: 800px; overflow-y: auto;">
        <?php
            
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
              echo '<input placeholder="' . $placeholder . '" ' . $config . ' required type="' . $type . '" max="' . $max . '" min="' . $min . '" class="form-control" id="' . $id_campo . '" name="' . $name . '" value="' . $value . '"/>';
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
  $arrRelacao = my_query('SELECT * FROM pessoa inner join relacao on relacao.id_relacao = pessoa.id_relacao Where pessoa.ativo = 1 and pessoa.removed = 0  and id_aluno = ' . $id . '');
  if (count($arrRelacao) == 0) {
    echo 'Não existem relações';
  } else {
  ?>
  
    
           
         
        <?php foreach ($arrRelacao as $v) {
   
          $tabela_modal = 'pessoa';
          $especificacao = 'editar';
          $id_modal = $v['id_pessoa'];
        ?>
          <div class="card h-70 ps-0 py-xl-3" style="background-color: white; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff'; this.style.zIndex='1';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
            <div class="card-body" style="text-align: center; height: 231.599258px; margin-left: 0px">
              <h5 class="card-title"><?php echo $v['pessoa']; ?></h5>
              <h7 class="card-title">Telefone: <?php echo $v['telefone_pessoa']; ?></h7><br>
              <h7 class="card-title">Relação: <?php echo $v['relacao']; ?></h7>
            </div>
            <?php if ($_SESSION['userCargo'] == 'admin' || $_SESSION['userCargo'] == 'supra_admin') { ?>
              <button style="margin: 3px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm<?php echo $id_modal; ?>"><i class="bx bx-pencil"></i> Editar</button>
              <?php if ($tabela != 'colaborador' || $v['cargo'] != 'supra_admin') { ?>
                <button style="margin: 3px;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopRemove<?php echo $id_modal; ?>"><i class="bx bx-trash"></i> Remover</button>
              <?php } ?>
            <?php } ?>
          </div>
          <!-- Modal for removal -->
         <?php
         echo '
         <div class="modal modal-mid fade" id="modalTopRemove'.$id_modal.'" tabindex="-1">
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
<div class="modal modal-mid fade" id="modalForm<?php echo $id_modal;?>" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="<?php echo $arrConfig['url_trata'] ?>/trata_forms.php?pagename=<?php echo $page_name; ?>&id=<?php echo $id_modal; ?>&tabela=<?php echo $tabela_modal; ?>&acao=editar" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTopTitle">Editar <?php echo $tabela_modal; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="max-height: 800px; overflow-y: auto;">
        <?php
            
      include $arrConfig['dir_admin'] . '/forms_campos.php'; //vai buscar a array dos campos do formulário
        $tipo = $tabela_modal;
 
        $arrResultados = my_query('SELECT * FROM ' . $tabela_modal . ' WHERE id_' . $tabela_modal . ' = ' . $id_modal);

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
              echo '<input placeholder="' . $placeholder . '" ' . $config . ' required type="' . $type . '" max="' . $max . '" min="' . $min . '" class="form-control" id="' . $id_campo . '" name="' . $name . '" value="' . $value . '"/>';
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
         
        <?php } ?>
      </div>
    </div>
  <?php
  }
  ?>
</div>

<?php
include 'separador/avaliacoesView.php'
?>
<?php
include 'separador/horarioView.php'
?>


</div>











<script>
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
   // Função para exibir uma mensagem com o nome do botão
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