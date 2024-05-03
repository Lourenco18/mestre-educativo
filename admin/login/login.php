<?php
include '../../php/include/config.inc.php';
$message_error_email = $_GET['message_error_email'] ?? '';
$message_error_pass = $_GET['message_error_pass'] ?? '';
$email = $_GET['email'] ?? '';
$pass = $_GET['pass'] ?? '';



?>
<?php
include $arrConfig['dir_admin'] . '/head.inc.php';
?>

<body>

  <?php

  if (isset($_GET['erro'])) {
    switch ($_GET['erro']) {
      case 1:
        echo 'Não foi possível realizar o seu login, tente novamente ou contacto o administrador!';
        break;

    }
  }
  ?>

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">

        <div class="card" style="background-color: #ffffff;">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="#" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">




                </span>
                <span class="app-brand-text demo text-body fw-bolder">Mestre Educative - Login</span>
              </a>
            </div>


            <form action="<?php echo $arrConfig['url_trata']; ?>/trata_login.php" method="get" id="formAuthentication" class="mb-3">
              <div class="mb-3">
                <label for="email" class="form-label">Email </label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Digite o seu Email"
                  value="<?php echo $email; ?>" />
                <small style="color: red;"><?php echo $message_error_email; ?></small>


              </div>

              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Palavra-Passe</label>
                  <a href="forgot-password.php">
                    <small>Esqueceu-se da sua palavra-passe?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="pass"
                    placeholder="Digite a sua palavra-passe" aria-describedby="password" />

                  <span class=" input-group-text cursor-pointer"
                    onclick="togglePasswordVisibility('password', 'toggleIconPassword')">
                    <i id="toggleIconPassword" class="bx bx-hide"></i>
                  </span>
                </div>
                <script>
                  function togglePasswordVisibility(inputId, iconId) {
                    var input = document.getElementById(inputId);
                    var icon = document.getElementById(iconId);

                    if (input.type === "password") {
                      input.type = "text";
                      icon.className = "bx bx-show";
                    } else {
                      input.type = "password";
                      icon.className = "bx bx-hide";
                    }
                  }

                </script>
                <small style="color: red;"><?php echo $message_error_pass; ?></small>

              </div>

              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Entrar</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>

</html>