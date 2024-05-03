<?php

include '../../php/include/config.inc.php';
$message_error_email = $_GET['message_error_email'] ?? '';
$message_error_pass = $_GET['message_error_pass'] ?? '';
$email = $_GET['email'] ?? '';
$pass = $_GET['pass'] ?? '';


?>
<?php
include 'head.inc.php';
?>
  <body>

    
    <div class="container-xxl justify-content-center">
      <div class="authentication-wrapper justify-content-center authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card justify-content-center " style = "padding-left: 10px; padding-rigth: 10px; background-color: #ffffff;">
            <div class="card-body " style= "margin-left: 0">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="php/index.php" class="">
                  <span class="app-brand-logo demo">
                  
                      
                     <!-- logo-->
                    
                  </span>
              <h2 style="margin-bottom: 0px;">Turbo-Trust - Esqueceu-se da palavra-passe</h2>
                </a>
              </div>
              <!-- /Logo -->
              <form action="<?php echo $arrConfig['url_trata'];?>/trata_reset-password.php" method="post" id="formAuthentication" class="mb-3">
                <div class="mb-3">
                  <label for="email" class="form-label">Email </label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Digite o seu Email"
                    value="<?php echo $email; ?>"
                  />
                  <small style="color: red;"><?php echo  $message_error_email; ?></small>
                    
                </div>
                
               
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Enviar código</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
  </body>
</html>


