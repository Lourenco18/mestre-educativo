<div class="container-xxl ">
  <?php
  include 'config.inc.php';
  include $arrConfig['dir_admin'] . '/ajax/recive-ajax.php';
  include $arrConfig['dir_admin'] . '/information/consultas.inc.php';
  include $arrConfig['dir_admin'] . '/forms_campos.php'; //vai buscar a array dos campos do formulário
  
  $pagename = $_SERVER['PHP_SELF'];
  $id = isset($_GET['id']) ? $_GET['id'] : '';
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
      if(isset($arrResultados[$k]['foto_' . $tabela])){
        $foto= '';
        include $arrConfig['dir_admin'] . '/fotos.inc.php';
      }
   
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
      $foto = '';
     
      $buttonMsg = "Inserir foto - $tabela";
    
    }
    
        
     
      

  
    //imagem de cada pessoa
    
    echo '
          <div class="row">
            <div class="col-md-12 " >
              <div class="card mb-3 px-md-4 ps-0" style="background-color: white">';
             
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
              echo '<input placeholder = "' . $placeholder . '" ' . $config . ' "required type="' . $type . '" ';
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
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTop">
                          <i class="bx bx-trash"></i> Remover
                      </button>';
      } else {
        echo '<button type="submit" class="btn btn-primary me-2">Criar</button></form>';
      }

      include $arrConfig['dir_admin'] . '/modal.inc.php';


      ?>

    </div>

</div>
</div>
</div>

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
    })();
  });

</script>