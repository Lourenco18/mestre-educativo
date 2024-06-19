<?php
 $id = isset($_GET['id']) ? $_GET['id'] : '';
 
 $id_modal = isset($_GET['id_modal']) ? $_GET['id_modal'] : '';

//  consultas SQL para cada categoria
global $consultas;
$consultas = [
    'aluno' => 'WITH AlunoRecente AS (
    SELECT 
        aluno.foto_aluno,
        aluno.id_aluno,
        aluno.aluno,
        aluno.unico,
        aluno.id_turma,
        aluno.id_escola,
        aluno.id_orientador,
        aluno.id_encarregadoeducacao,
        aluno.id_ciclo,
        aluno.data,
        aluno.ativo,
        ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
    FROM 
        aluno
    WHERE
        aluno.ativo = 1
),
TurmaRecente AS (
    SELECT 
        turma.*,
        ROW_NUMBER() OVER (PARTITION BY turma.unico ORDER BY turma.data DESC) AS rn
    FROM 
        turma
),
LocalidadeRecente AS (
    SELECT 
        localidade.*,
        ROW_NUMBER() OVER (PARTITION BY localidade.unico ORDER BY localidade.data DESC) AS rn
    FROM 
        localidade
),
NacionalidadeRecente AS (
    SELECT 
        nacionalidade.*,
        ROW_NUMBER() OVER (PARTITION BY nacionalidade.unico ORDER BY nacionalidade.data DESC) AS rn
    FROM 
        nacionalidade
),
CidadeRecente AS (
    SELECT 
        cidade.*,
        ROW_NUMBER() OVER (PARTITION BY cidade.unico ORDER BY cidade.data DESC) AS rn
    FROM 
        cidade
),
GeneroRecente AS (
    SELECT 
        genero.*,
        ROW_NUMBER() OVER (PARTITION BY genero.unico ORDER BY genero.data DESC) AS rn
    FROM 
        genero
),
EscolaRecente AS (
    SELECT 
        escola.*,
        ROW_NUMBER() OVER (PARTITION BY escola.unico ORDER BY escola.data DESC) AS rn
    FROM 
        escola
),
ColaboradorRecente AS (
    SELECT 
        colaborador.*,
        ROW_NUMBER() OVER (PARTITION BY colaborador.unico ORDER BY colaborador.data DESC) AS rn
    FROM 
        colaborador
),
EncarregadoEducacaoRecente AS (
    SELECT 
        encarregadoeducacao.*,
        ROW_NUMBER() OVER (PARTITION BY encarregadoeducacao.unico ORDER BY encarregadoeducacao.data DESC) AS rn
    FROM 
        encarregadoeducacao
),
RelacaoRecente AS (
    SELECT 
        relacao.*,
        ROW_NUMBER() OVER (PARTITION BY relacao.unico ORDER BY relacao.data DESC) AS rn
    FROM 
        relacao
),
CicloRecente AS (
    SELECT 
        ciclo.*,
        ROW_NUMBER() OVER (PARTITION BY ciclo.unico ORDER BY ciclo.data DESC) AS rn
    FROM 
        ciclo
)
SELECT 
    ar.foto_aluno,
    ar.id_aluno,
    ar.aluno,
    ar.unico,
    ar.id_turma,
    ar.id_escola,
    ar.id_orientador,
    ar.id_encarregadoeducacao,
    ar.id_ciclo,
    ar.data,
    ar.ativo,
    tr.*,
    er.*,
    cr.*,
    eer.*,
    rr.*,
    cir.*
FROM 
    AlunoRecente ar
INNER JOIN 
    TurmaRecente tr ON ar.id_turma = tr.unico AND tr.rn = 1
INNER JOIN 
    EscolaRecente er ON ar.id_escola = er.unico AND er.rn = 1
INNER JOIN 
    ColaboradorRecente cr ON ar.id_orientador = cr.unico AND cr.rn = 1
INNER JOIN 
    EncarregadoEducacaoRecente eer ON ar.id_encarregadoeducacao = eer.unico AND eer.rn = 1
INNER JOIN 
    RelacaoRecente rr ON eer.id_relacao = rr.unico AND rr.rn = 1
INNER JOIN 
    CicloRecente cir ON ar.id_ciclo = cir.unico AND cir.rn = 1
WHERE 
    ar.rn = 1;

',
    'myaluno' => 'WITH AlunoRecente AS (
    SELECT 
        aluno.foto_aluno,
        aluno.id_aluno,
        aluno.aluno,
        aluno.unico,
        aluno.id_turma,
        aluno.id_escola,
        aluno.id_orientador,
        aluno.id_encarregadoeducacao,
        aluno.data,
        aluno.ativo,
        ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
    FROM 
        aluno
    WHERE
        aluno.ativo = 1
),
TurmaRecente AS (
    SELECT 
        turma.*,
        ROW_NUMBER() OVER (PARTITION BY turma.unico ORDER BY turma.data DESC) AS rn
    FROM 
        turma
),
EscolaRecente AS (
    SELECT 
        escola.*,
        ROW_NUMBER() OVER (PARTITION BY escola.unico ORDER BY escola.data DESC) AS rn
    FROM 
        escola
),
ColaboradorRecente AS (
    SELECT 
        colaborador.*,
        ROW_NUMBER() OVER (PARTITION BY colaborador.unico ORDER BY colaborador.data DESC) AS rn
    FROM 
        colaborador
),
EncarregadoEducacaoRecente AS (
    SELECT 
        encarregadoeducacao.*,
        ROW_NUMBER() OVER (PARTITION BY encarregadoeducacao.unico ORDER BY encarregadoeducacao.data DESC) AS rn
    FROM 
        encarregadoeducacao
),
RelacaoRecente AS (
    SELECT 
        relacao.*,
        ROW_NUMBER() OVER (PARTITION BY relacao.unico ORDER BY relacao.data DESC) AS rn
    FROM 
        relacao
)
SELECT 
    ar.foto_aluno,
    ar.id_aluno,
    ar.aluno,
    ar.unico,
    ar.id_turma,
    ar.id_escola,
    ar.id_orientador,
    ar.id_encarregadoeducacao,
    ar.data,
    ar.ativo,
    tr.*,
    er.*,
    cr.*,
    eer.*,
    rr.*
FROM 
    AlunoRecente ar
INNER JOIN 
    TurmaRecente tr ON ar.id_turma = tr.unico AND tr.rn = 1
INNER JOIN 
    EscolaRecente er ON ar.id_escola = er.unico AND er.rn = 1
INNER JOIN 
    ColaboradorRecente cr ON ar.id_orientador = cr.unico AND cr.rn = 1
INNER JOIN 
    EncarregadoEducacaoRecente eer ON ar.id_encarregadoeducacao = eer.unico AND eer.rn = 1
INNER JOIN 
    RelacaoRecente rr ON eer.id_relacao = rr.unico AND rr.rn = 1
WHERE 
    ar.rn = 1
 and aluno.id_orientador = ' . $_SESSION['userID'] . '',
    'alunoinative' => 'WITH AlunoRecente AS (
      SELECT 
      aluno.foto_aluno,
      aluno.id_aluno,
        aluno.aluno,
          aluno.unico,
          aluno.id_turma,
          aluno.id_escola,
          aluno.id_orientador,
          aluno.id_encarregadoeducacao,
          aluno.data,
          aluno.ativo,
          ROW_NUMBER() OVER (PARTITION BY aluno.unico ORDER BY aluno.data DESC) AS rn
      FROM 
          aluno
      WHERE
          aluno.ativo = 0 and aluno.removed = 0
  )
  SELECT 
  ar.foto_aluno,
  ar.id_aluno,
  ar.aluno,
      ar.unico,
      ar.id_turma,
      ar.id_escola,
      ar.id_orientador,
      ar.id_encarregadoeducacao,
      ar.data,
      ar.ativo,
      turma.*,
      escola.*,
      colaborador.*,
      encarregadoeducacao.*,
      relacao.*
  FROM 
      AlunoRecente ar
  INNER JOIN 
      turma ON ar.id_turma = turma.unico
  INNER JOIN 
      escola ON ar.id_escola = escola.unico
  INNER JOIN 
      colaborador ON ar.id_orientador = colaborador.unico
  INNER JOIN 
      encarregadoeducacao ON ar.id_encarregadoeducacao = encarregadoeducacao.unico
  INNER JOIN 
      relacao ON encarregadoeducacao.id_relacao = relacao.unico
  WHERE 
      ar.rn = 1;',
    'alunoremoved' => 'SELECT * FROM aluno INNER JOIN turma on aluno.id_turma = turma.id_turma INNER JOIN escola on aluno.id_escola = escola.id_escola  INNER JOIN colaborador ON aluno.id_orientador = colaborador.id_colaborador INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.id_encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao WHERE  aluno.removed = 1',
    'encarregadoeducacao' => 'WITH EncarregadoEducacaoRecente AS (
        SELECT 
            encarregadoeducacao.*, 
            ROW_NUMBER() OVER (PARTITION BY encarregadoeducacao.unico ORDER BY encarregadoeducacao.data DESC) AS rn
        FROM 
            encarregadoeducacao
        WHERE  encarregadoeducacao.removed = 0 and
            encarregadoeducacao.ativo = 1
    )
    SELECT 
        eer.*, 
        relacao.*
    FROM 
        EncarregadoEducacaoRecente eer
    INNER JOIN 
        relacao ON eer.id_relacao = relacao.unico
    WHERE 
        eer.rn = 1;',
    'colaborador' => 'SELECT * FROM colaborador  INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE cargo.ativo = 1',
    'escola' => 'SELECT * FROM escola WHERE ativo = 1',
    'professor' => 'SELECT * FROM colaborador INNER JOIN especialidade ON colaborador.id_especialidade = especialidade.id_especialidade INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 3',
    'admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 2',
    'supra_admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.ativo = 1 AND colaborador.id_cargo = 1',
    'turma' => 'SELECT * FROM turma  INNER JOIN escola on turma.id_escola = escola.id_escola WHERE turma.ativo = 1',
    'operacao'=> 'SELECT * FROM operacao  WHERE operacao.ativo = 1 Order by ordem ASC',
    'transporte'=> 'SELECT * FROM transporte  WHERE transporte.ativo = 1 ',
    'permissao'=> 'SELECT * FROM permissao inner join operacao on permissao.id_operacao = operacao.id_operacao inner join cargo on permissao.id_cargo = cargo.id_cargo',
    
'pessoa'=> 'SELECT 
    pessoa.id_pessoa,
        pessoa.id_aluno, 
        pessoa.data,
        pessoa.pessoa, 
        pessoa.telefone_pessoa, 
        pessoa.unico AS unico_pessoa, 
        relacao.relacao 
    FROM 
        pessoa 
    INNER JOIN 
        relacao 
    ON 
        relacao.id_relacao = pessoa.id_relacao 
    WHERE 
        pessoa.ativo = 1 
        AND pessoa.removed = 0 
        AND pessoa.id_aluno = ' . $id_unico_aluno . ' 
        AND pessoa.data = (
            SELECT MAX(p2.data)
            FROM pessoa p2
            WHERE p2.unico = pessoa.unico
        )',
  ];


  



    
$consultasForms = [
    'aluno' => 'SELECT * 
    FROM aluno 
    INNER JOIN colaborador ON aluno.id_orientador = colaborador.unico
    INNER JOIN encarregadoeducacao ON aluno.id_encarregadoeducacao = encarregadoeducacao.unico
    INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.unico
    INNER JOIN genero ON Genero.unico = aluno.id_genero
    INNER JOIN localidade ON Localidade.unico = aluno.id_localidade
    INNER JOIN escola ON escola.unico = aluno.id_escola
    INNER JOIN nacionalidade ON nacionalidade.unico = aluno.id_nacionalidade
    INNER JOIN turma ON turma.unico = aluno.id_turma
    Where  aluno.id_aluno = ' . $id . '',
    'encarregadoeducacao' => 'SELECT * FROM encarregadoeducacao INNER JOIN relacao ON encarregadoeducacao.id_relacao = relacao.id_relacao  WHERE encarregadoeducacao.ativo = 1',
    'colaborador' => 'SELECT * FROM colaborador  INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE cargo.ativo = 1',
    'escola' => 'SELECT * FROM escola WHERE id_escola = ' . $id . ' ',
    'professor' => 'SELECT * FROM colaborador INNER JOIN especialidade ON colaborador.id_especialidade = especialidade.id_especialidade INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE colaborador.id_cargo = 3',
    'admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE  colaborador.id_cargo = 2',
    'supra_admin' => 'SELECT * FROM colaborador INNER JOIN cargo ON colaborador.id_cargo = cargo.id_cargo WHERE  colaborador.id_cargo = 1',
    'turma' => 'SELECT * FROM turma  INNER JOIN escola on turma.id_escola = escola.id_escola WHERE turma.id_turma = ' . $id . '',
    'operacao'=> 'SELECT * FROM operacao  WHERE operacao.id_operacao = ' . $id . ' ',
    'transporte'=> 'SELECT * FROM transporte  WHERE transporte.ativo = '.$id.' ',
    'permissao'=> 'SELECT * FROM permissao inner join operacao on permissao.id_operacao = operacao.id_operacao inner join cargo on permissao.id_cargo = cargo.id_cargo where permissao.id_cargo = '.$id.' ',
    'pessoa'=> 'SELECT * FROM pessoa  WHERE id_pessoa = '.$id_modal.' ',  
  ];
 