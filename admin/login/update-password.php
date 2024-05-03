<?php
include '../../php/include/config.inc.php';
$message_error_pass = $_GET['message_error_pass'] ?? '';
$pass = $_GET['pass'] ?? '';
$id_colaborador = $_GET['id_colaborador'] ?? '';
$pass_confirmation = $_GET['pass_confirmation'] ?? '';



?>
<?php
include $arrConfig['dir_admin'] . '/head.inc.php';
?>

<body>



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
                <span class="app-brand-text demo text-body fw-bolder">Mestre Educative - <br> Nova Palavra-passe</span>
              </a>
            </div>


            <form action="<?php echo $arrConfig['url_trata'];?>/trata_update-password.php" method="get" id="formAuthentication" class="mb-3">

              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Nova Palavra-passe</label>

                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="pass"
                    placeholder="Digite a sua nova palavra-passe 6 a 16 carateres" aria-describedby="password" required
                    value="<?php echo $pass; ?>" />
                  <span class="input-group-text cursor-pointer" onclick="togglePasswordVisibility('password')">
                    <i id="toggleIconPassword" class="bx bx-hide"></i>

                </div>



              </div>
              <input type="hidden" name="id_colaborador" value="<?php echo $id_colaborador; ?>">
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Condirme a Palavra-passe</label>

                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="confirmPassword" class="form-control" name="pass_confirmation"
                    placeholder="Confirme a sua palavra-passe" aria-describedby="password" required
                    value="<?php echo $pass_confirmation; ?>" />
                  <span class="input-group-text cursor-pointer" onclick="togglePasswordVisibility('confirmPassword')">
                    <i id="toggleIconConfirmPassword" class="bx bx-hide"></i>
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