<?php
// Recolher os horários
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';

$id_turma = '';
$turma = '';
$escola = '';
$horario = '';

if ($especificacao == 'editar') {
    if ($tabela == "aluno") {
        $id_turma_query = my_query('SELECT MAX(turma.id_turma) as idturma, turma.turma as turma, aluno.id_turma, aluno.id_escola, escola.escola as escola from aluno inner join turma on turma.unico = aluno.id_turma inner join escola on escola.unico = aluno.id_escola where id_aluno = ' . $id);
        if (!empty($id_turma_query)) {
            $turma = $id_turma_query[0]['turma'];
            $escola = $id_turma_query[0]['escola'];
            $id_turma = $id_turma_query[0]['idturma'];
        
        }
    } else {
        $id_turma = $id;
        $arrResultados = my_query('SELECT escola.id_escola as id_escola, turma.turma, turma.id_turma from turma inner join escola on escola.id_escola = turma.id_escola where id_turma = ' . $id_turma);
        if (!empty($arrResultados)) {
            $id_escola = $arrResultados[0]['id_escola'];
            $arrescola = my_query('SELECT escola, id_escola from escola where escola.id_escola = ' . $id_escola);
            if (!empty($arrescola)) {
                $escola = $arrescola[0]['escola'];
            }
            $turma = $arrResultados[0]['turma'];
        }
    }

    $horario_query = my_query('SELECT horario from turma where id_turma = ' . $id_turma);
    if (!empty($horario_query)) {
        $horario = $horario_query[0]['horario'];
    }

    $src = $arrConfig['url_fotos_upload'] . '/horario/' . $horario;
} else {
    $id_turma_query = my_query('SELECT MAX(id_turma) as id_turma from turma');
    if (!empty($id_turma_query)) {
        $id_turma = $id_turma_query[0]['id_turma'];
    }
}

$buttonMsg = isset($horario) ? 'Alterar horário' : 'Adicionar horário';
?>
<style>
    #picture__input {
        display: none;
    }

    .picture {
        width: 800px;
        height: 450px; /* Maintain 16:9 aspect ratio */
        background: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        border: 2px dashed currentcolor;
        cursor: pointer;
        font-family: sans-serif;
        transition: color 300ms ease-in-out, background 300ms ease-in-out;
        outline: none;
        overflow: hidden;
    }

    .picture:hover {
        color: #777;
        background: #ccc;
    }

    .picture:active {
        border-color: turquoise;
        color: turquoise;
        background: #eee;
    }

    .picture:focus {
        color: #777;
        background: #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .picture__img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
</style>
<div class="card mb-3 px-md-4 ps-0" style="background-color: white">
    <div id="horarioView" class="divisao" style="display: <?php echo $tabela == 'turma' ? 'block' : 'none'; ?>;">
        <div class="row row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3" style="padding: 20px;">
            <?php
            $accept = 'image/png, image/jpeg, image/*';
            $permitido = 'JPG e PNG';

            if ($turma == '0') {
                echo '<h5>O aluno não tem nenhuma turma associada, para inserir/ver o horário, associe uma turma ao aluno</h5>';
            } else {
                echo '
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center gap-4">
                        <form id="imageForm" action="' . $arrConfig['url_trata'] . '/trata_horario.php" method="post" enctype="multipart/form-data">
                            <h3>Horário </h3>
                            <h6>Escola: ' . $escola . ' </h6>
                            <h6>Turma: ' . $turma . ' </h6>
                            <div class="mb-3">
                                <label for="imageUpload" class="form-label">Clique abaixo para escolher uma imagem:</label>
                                <input type="file" id="imageUpload" name="imageUpload" accept="' . $accept . '">
                            </div>
                            <div id="imagePreview" class="mt-4">
                                <div class="picture" onclick="document.getElementById(\'imageUpload\').click();">';
                                    if (!empty($horario)) {
                                        echo '<img src="' . $src . '" alt="Horário" class="picture__img">';
                                    } else {
                                        echo '<span>Adicionar imagem</span>';
                                    }
                                echo '</div>
                            </div>
                            <p class="text-muted mb-0">Permitido ' . $permitido . '.</p>
                            <input type="hidden" id="pagename" name="pagename" value="' . $page_name . '">
                            <input type="hidden" id="id_turma" name="id_turma" value="' . $id_turma . '">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var imageUpload = document.getElementById('imageUpload');
        var imagePreview = document.getElementById('imagePreview');

        imageUpload.addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    while (imagePreview.firstChild) {
                        imagePreview.removeChild(imagePreview.firstChild);
                    }
                    var img = document.createElement('img');
                    img.classList.add('picture__img');
                    img.src = e.target.result;
                    imagePreview.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        });
    });
</script>
