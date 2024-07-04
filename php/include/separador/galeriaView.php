<style>
   
</style>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
?>
<div class="card mb-3 px-md-4 ps-0" style="background-color: white">
    <div id="galeriaView" class="divisao scrollable-gallery" style="display: none;">
        <div class="row row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3" style="padding: 20px;">
            <div class="col">
                <?php
                $accept = 'image/png, image/jpeg, image/*';
                $permitido = 'JPG e PNG';
                echo '<form id="imageForm" action="'.$arrConfig['url_trata'].'/trata_galeria.php" method="post" enctype="multipart/form-data">
                    <h3>Adicionar imagens</h3>
                    <div class="mb-3">
                        <label for="imageUpload" class="form-label">Clique abaixo para escolher imagens:</label>
                        <input type="file" id="imageUpload" hidden name="imageUpload[]" accept="' . $accept . '" multiple>
                    </div>
                    <div id="imagePreview"  class="mt-4">
                        <div class="picture" style=" height: 200px; 
        width: 200px; " onclick="document.getElementById(\'imageUpload\').click();">
                            <span>Adicionar imagens</span>
                        </div><br>
                    </div>
                    
            <input
                type="hidden"
                id="pagename"
                class="form-control"
                name="pagename"
                value="' . preg_replace("'&'","----", basename($current_page)) . '"
            />
            <input
                type="hidden"
                id="id_aluno"
                class="form-control"
                name="id_aluno"
                value="' . $id_unico_aluno . '"
            />
                    <button type="submit" class="btn btn-success">Adicionar</button>
                </form>';
                ?>
            </div>
            <?php
            $arrFotos= my_query('SELECT * from foto where foto.ativo= 1 and removed = 0 AND id_unico = '.$id_unico_aluno.' ORDER BY data DESC');
            foreach($arrFotos as $k =>$v){
                echo'<div class="col">
                <div class="card">
                    <img src="'.$arrConfig['url_fotos_upload'].'/galeria/'.$v['foto'].'" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Data: '.$v['data'].'</h5>
                       <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopRemove'.$v['id_foto'].'" title="Remover"><i class="bx bx-trash"></i>Remover</button>
                    </div>
                </div>
            </div>';
            echo '
    <div class="modal modal-mid fade" id="modalTopRemove'.$v['id_foto'].'" tabindex="-1">
    <div class="modal-dialog">
      <form class="modal-content">
        <div class="modal-header">
    <h5 class="modal-title" id="modalTopTitle">Tem a certeza que quer remover esta foto ';

    
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
    <a type="button" style = "color = white;" class="btn btn-danger" href="' . $arrConfig['url_trata'] . '/trata_forms.php?id= ' .$v['id_foto'] . '&tabela=foto&acao=apagar&pagename=' . preg_replace("'&'","----", basename($current_page)) . '" onclick="SwalSuccess()">Sim, quero remover</a>
  
    </div>
    </form>
  </div>
  </div>
 ';
            }
               
            ?>
            
            
       
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var imageUpload = document.getElementById('imageUpload');
        var imagePreview = document.getElementById('imagePreview');
        var pictureDiv = imagePreview.querySelector('.picture');

        imageUpload.addEventListener('change', function () {
            while (pictureDiv.firstChild) {
                pictureDiv.removeChild(pictureDiv.firstChild);
            }

            var files = this.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                if (file) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var img = document.createElement('img');
                        img.classList.add('picture__img');
                        img.src = e.target.result;
                        pictureDiv.appendChild(img);
                    }

                    reader.readAsDataURL(file);
                }
            }
        });
    });
</script>
