<?php
 $id = isset($_GET['id']) ? $_GET['id'] : '';
//  consultas SQL para cada categoria
global $consultas;
$consultas = [
    'aluno' => 'SELECT * FROM aluno INNER JOIN turma on aluno.id_turma = turma.id_turma INNER JOIN escola on aluno.id_escola = escola.id_escola INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao WHERE colaborador.orientador = 1 AND colaborador.ativo = 1 AND aluno.ativo = 1 AND encarregadoeducacao.ativo = 1',
    'myaluno' => 'SELECT * FROM aluno INNER JOIN turma on aluno.id_turma = turma.id_turma INNER JOIN escola on aluno.id_escola = escola.id_escola INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao WHERE colaborador.orientador = 1 AND colaborador.ativo = 1 AND aluno.ativo = 1 AND encarregadoeducacao.ativo = 1 and aluno.id_orientador = ' . $_SESSION['userID'] . '',
    'alunoinative' => 'SELECT * FROM aluno INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao WHERE colaborador.orientador = 1 AND colaborador.ativo = 1 AND aluno.ativo = 0 AND encarregadoeducacao.ativo = 1',
    'encarregadoeducacao' => 'SELECT * FROM encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao  WHERE encarregadoeducacao.ativo = 1',
    'colaborador' => 'SELECT * FROM colaborador  INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE cargo.ativo = 1',
    'escola' => 'SELECT * FROM escola WHERE ativo = 1',
    'professor' => 'SELECT * FROM colaborador INNER JOIN especialidade ON colaborador.id_especialidade = especialidade.id_especialidade INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 3',
    'admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 2',
    'supra_admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 1',
    'turma' => 'SELECT * FROM turma  INNER JOIN escola on turma.id_escola = escola.id_escola WHERE turma.ativo = 1',
    'operacao'=> 'SELECT * FROM operacao  WHERE operacao.ativo = 1 Order by ordem ASC',
    'transporte'=> 'SELECT * FROM transporte  WHERE transporte.ativo = 1 ',

  ];
$consultasForms = [
    'aluno' => 'SELECT * 
    FROM aluno 
    INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador
    INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao
    INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao
    INNER JOIN genero ON Genero.id_genero = aluno.id_genero
    INNER JOIN localidade ON Localidade.id_localidade = aluno.id_localidade
    INNER JOIN escola ON escola.id_escola = aluno.id_escola
    INNER JOIN turma ON turma.id_turma = aluno.id_turma
    WHERE colaborador.orientador = 1 
    AND colaborador.ativo = 1 
    AND aluno.ativo = 1 
    AND encarregadoeducacao.ativo =  1
    AND aluno.id_aluno = ' . $id . '',
    'alunoinative' => 'SELECT * FROM aluno INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao WHERE colaborador.orientador = 1 AND colaborador.ativo = 1 AND aluno.ativo = 0 AND encarregadoeducacao.ativo = 1',
    'encarregadoeducacao' => 'SELECT * FROM encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao  WHERE encarregadoeducacao.ativo = 1',
    'colaborador' => 'SELECT * FROM colaborador  INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE cargo.ativo = 1',
    'escola' => 'SELECT * FROM escola WHERE ativo = 1',
    'professor' => 'SELECT * FROM colaborador INNER JOIN especialidade ON colaborador.id_especialidade = especialidade.id_especialidade INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 3',
    'admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 2',
    'supra_admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 1',
    'turma' => 'SELECT * FROM turma  INNER JOIN escola on turma.id_escola = escola.id_escola WHERE turma.ativo = 1',
    'operacao'=> 'SELECT * FROM operacao  WHERE operacao.ativo = 1 Order by ordem ASC',
    'transporte'=> 'SELECT * FROM transporte  WHERE transporte.ativo = '.$id.' ',

  ];
 