<div id="relacaoView" class="divisao" style="display: none;">
<?php
$arrRelacao = my_query('SELECT * FROM pessoa inner join relacao on relacao.id_relacao = pessoa.id_relacao Where id_aluno = ' . $id . '');
if(count($arrRelacao) == 0){
  echo 'Não existem relações';
}else{
 

    echo'
    <div class="row  row-cols-sm-2  row-cols-lg-4 row-cols-xl-5 row-cols-md-3 g-4 mb-2 ps-lg-4 pe-lg-3 " style="padding: 20px;">
    <div class="col" >';
    foreach ($arrRelacao as $k => $v) {
      $tabela_modal= 'pessoa';
      $tabela= 'pessoa';
      $tipo_modal= 'pessoa';
      $especificacao= 'editar';
     
    echo'
           
                  <div class="card h-70 ps-0 py-xl-3" style="  background-color: white; transition: all 0.3s ease;" onmouseover="this.style.transform=\'scale(1.05)\'; this.style.boxShadow=\'0 4px 8px 0 #696cff, 0 6px 20px 0 #696cff\'; this.style.zIndex=\'1\';" onmouseout="this.style.transform=\'scale(1)\'; this.style.boxShadow=\'none\';">    
                          <div class="card-body" style="text-align: center;height: 231.599258px;  margin-left: 0px">
                              <h5 class="card-title">'.$v['pessoa'].'</h5>
                              <h6 class="card-title">'.$v['telefone_pessoa'].'</h6> 
                              <h6 class="card-title">'.$v['relacao'].'</h6>
                            
                          </div>';
                          if ($_SESSION['userCargo'] == 'admin' || $_SESSION['userCargo'] == 'supra_admin') {
                            echo '<button style= "margin: 3px;"type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm"><i class="bx bx-pencil"></i> Editar</button>';
                            if ($tabela == 'colaborador' && $v['cargo'] == 'supra_admin') {
                             
                            } else {
                              $id_modal = $v['id_pessoa'];
                              echo '<button style= "margin: 3px; type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTopremove"><i class="bx bx-trash"></i> Remover</button>';
                            }
                           
                          }
                          echo'
                          
                    </div>
                  
              </div>';
            }
            echo' </div>';
 
}

            ?>
</div>