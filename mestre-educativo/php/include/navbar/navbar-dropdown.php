<?php





// Início da tag <ul>
echo '<ul class="dropdown-menu dropdown-menu-end">';

// Loop através dos dados

    echo '<li>
            <a class="dropdown-item" href="#">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                            <img src="' .  $_SESSION['userfoto']. '" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <span class="fw-semibold d-block">' . $_SESSION['userNome'] . '</span>
                        <small class="text-muted">' . $_SESSION['userCargo']. '</small>
                    </div>
                </div>
            </a>
          </li>';
    echo '<li><div class="dropdown-divider"></div></li>';



echo '<li>
        <a class="dropdown-item" href="http://localhost/mestre-educativo/pagina-formulario.php?id='.$_SESSION['userID'].'&tipo=colaborador&especificacao=editar">
            <i class="bx bx-user me-2"></i>
            <span class="align-middle">O meu Perfil</span>
        </a>
      </li>';

echo '<li>
        <a class="dropdown-item" href="admin/trata/trata_logout.php">
            <i class="bx bx-power-off me-2"></i>
            <span class="align-middle">Log Out</span>
        </a>
      </li>';
      echo '<li>
      <a class="dropdown-item" href="'.$arrConfig['url_site'].'/pagina-sobre.php" target="_blank"" >
          <i class="bx bx-info-circle me-2"></i>
          <span class="align-middle">Sobre</span>
      </a>
    </li>';

// Fim da tag </ul>
echo '</ul>';

