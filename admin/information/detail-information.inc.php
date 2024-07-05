<?php
$information = array(
  "aluno" => array(
    "Encarregado de Educação" => "encarregadoeducacao",
    "Contacto EE" => "telefone_encarregadoeducacao",
    "Orientador(a)" => "colaborador",
    "Escola" => "escola",
    "Ano de escolaridade"=> "ano",

  ),
  "encarregadoeducacao" => array(
    "Relação" => "relacao",
    "Nome do(s) Educando(s)" => "aluno",
    "Contacto" => "telefone_encarregadoeducacao",
    "Email" => "email_encarregadoeducacao"
  ),
  "escola" => array(
    "Localização" => "morada_escola",
    "Telefone" => "telefone_escola",
    "Email" => "email_escola",
  ),
  "turma" => array(
    "Escola" => "escola",
  ),
  "colaborador" => array(
    "Contacto" => "telefone",
    "Cargo" => "cargo",
    "E-mail Pessoal" => "email_pessoal",
    "E-mail institucional" => "email_institucional",
  ),
  "professor" => array(
    "Contacto" => "telefone",
    
    "E-mail Pessoal" => "email_pessoal",
    "E-mail institucional" => "email_institucional",
    "Especialidade" => "especialidade",
  ),
  
  "supra_admin" => array(
    "Contacto" => "telefone",
    "E-mail Pessoal" => "email_pessoal",
    "E-mail institucional" => "email_institucional",
    
  ),
  "operacao" => array(
    "Display" => "display",
    "Pai" => "pai",
    "Particao" => "particao",
    "Tipo Form" => "tipo_form",
    
    "Ordem" => "ordem",
    
  ),
  "permissao" => array(
    "Cargo" => "cargo",
    "Operaçao" => "operacao",
   
    
  ),
  "pessoa" => array(
    "Nome" => "nome",
    "Contacto" => "telefone_pessoa",
    "Relação" => "relacao",
  
  ),
  "disciplina" => array(
    "Ciclo" => "ciclo",
   
  ),

  "transporte" => array(

    "Preço" => "preco",
   

  ),
  "servico" => array(
    
    "Data" => "data",
    "Valor" => "valor",
   

  ),
  "pagamento" => array(
    
    "Data" => "data",
    "Valor" => "valor",
   

  ),
  
);

