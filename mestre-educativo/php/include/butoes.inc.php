<?php
if ($page_name == 'aluno.php')

    echo '
<a href="editar.php?id=' . $v['id'] . '" class="btn btn-primary" role="button">
<i class="bx bx-pencil"></i> Editar
</a>';