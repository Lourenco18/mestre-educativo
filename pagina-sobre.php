<?php
include $_SERVER['DOCUMENT_ROOT'].'/mestre-educativo/php/include/config.inc.php';
include $arrConfig['dir_include'].'/auth.inc.php';
  
include $arrConfig['dir_admin'].'/head.inc.php';
?>
<body>
<style>
    .card-header {
        cursor: pointer;
    }
    .icon {
        font-size: 24px;
        margin-right: 10px;
    }
    .logo {
        width: 100px;
        height: auto;
    }
    .container {
        width: 50%;
        margin: 50px auto;
    }
</style>
<div class="container card">
    <div class="card-body">
        <!-- Logotipo e Nome da Aplicação -->
        <div class="text-center mb-5">
            <img src="<?php echo $arrConfig['url_imjs_upload']; ?>/logos/logo.png" alt="Mestre Educative" class="logo">
            <h1>Mestre Educative</h1>
            <p>Bem-vindo ao Mestre Educative, a solução completa para gestão escolar. Nossa aplicação oferece ferramentas eficientes para gerenciamento de alunos, escolas, testes e transporte escolar, garantindo uma administração escolar mais organizada e eficaz.</p>
        </div>

        <!-- Seção de Privacidade e Segurança -->
        <div>
            <h2>Privacidade e Segurança</h2>
            <div class="accordion" id="accordionExample">
                <!-- Privacidade -->
                <div class="card">
                    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <h5 class="mb-0">
                            <i class="bx bx-shield icon"></i>
                            Privacidade
                            <span class="arrow"></span>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            Garantimos a confidencialidade dos dados pessoais dos nossos utilizadores. Tomamos todas as medidas necessárias para proteger as informações contra acesso não autorizado.
                        </div>
                    </div>
                </div>
                <!-- Segurança -->
                <div class="card">
                    <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h5 class="mb-0">
                            <i class="bx bx-lock icon"></i>
                            Segurança
                            <span class="arrow"></span>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Na prespetiva de segurança, o nosso sistema guarda informações pessoais apenas para uso visual e tratamento interno, não sendo utilizados noutros sistemas.
                        </div>
                    </div>
                </div>
                <!-- Tratamento de Dados -->
                <div class="card">
                    <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h5 class="mb-0">
                            <i class="bx bx-data icon"></i>
                            Tratamento de Dados
                            <span class="arrow"></span>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            Os dados são processados de acordo com as leis de proteção de dados em vigor. Respeitamos a privacidade e os direitos dos nossos utilizadores em todas as etapas de processamento.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Botões -->
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary mr-2">Voltar para à página inicial</a>
            <a  id="contactarBtn"  herf="mailto:mestreeducative@gmail.com" class="btn">Contacte-nos em caso de dúvida</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript para enviar email -->
<script>
    // Aguarda o carregamento completo da página
    document.addEventListener('DOMContentLoaded', function() {
        // Seleciona todos os cabeçalhos dos cartões
        var cardHeaders = document.querySelectorAll('.card-header');
        
        // Itera sobre cada cabeçalho
        cardHeaders.forEach(function(cardHeader) {
            // Adiciona um ouvinte de evento de clique para alternar a classe da seta
            cardHeader.addEventListener('click', function() {
                var arrow = this.querySelector('.arrow');
                
                // Alterna a classe 'expanded' na seta para girá-la
                arrow.classList.toggle('expanded');
            });
        });
    });
    
    // Ouve o evento de clique no botão de contato para enviar um email
    document.getElementById('contactarBtn').addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = 'mailto:mestreeducative@gmail.com';
    });
</script>

<?php
include $arrConfig['dir_admin'].'/end.inc.php';
?>